<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/6/14
 * Time: 9:33
 */
require("../connectDB.php");
require("../all.php");
?>
<?php
    $uid = $_SESSION["uid"];
    $a = new interfaceResponse();
    $status = $reminder = 0;


    $type = array("jpg","bmp","jpeg","png");
    $uploaddir = "../../../img/user_img/avatar/".$uid."/";
    if($_FILES['avatar']['name']){
        if(in_array(strtolower(getFileCate($_FILES['avatar']['name'])),$type)){
            $filename=explode(".",$_FILES['avatar']['name']);//$filename = ['201606141106','jpg']
            do{
                $filename[0]=randomName(10);//$filename = ['ahg4342asA','jpg']
                $name=implode(".",$filename);//$name = 'ahg4342asA.jpg'
                $uploadfile=$uploaddir.$name;//$uploadfile = './img/user_img/avatar/'.$uid.'/ahg4342asA.jpg'
            }while(file_exists($uploadfile));

            if(!file_exists(dirname($uploadfile))){
                //不存在这个目录，则创建一个目录
                mkdir(dirname($uploadfile),0777);//则创建一个目录，并赋予0777模式权限
                $b = true;
            }

            if (move_uploaded_file($_FILES['avatar']['tmp_name'],$uploadfile)){

                    $sql = "UPDATE users SET avatar='$uploadfile' WHERE uid = '$uid' ";
                    $qry = $db->query($sql);
                    $status = 1;
                    $reminder = "上传成功";
                    $a->normalrespond($status,$reminder);
                    //----------------------------------------------------------------------------------------------------->出口5，上传成功

            }else{
                $status = 0;
                $reminder = "临时文件转移失败";
                echo $a->normalrespond($status,$reminder);
                //--------------------------------------------------------------------------------------------------------->出口3，临时文件转移失败
            }
        }else{
            $status = 0;
            $reminder = "文件格式不正确，应该是jpg、png或bmp格式的图片文件";
            echo $a->normalrespond($status,$reminder);
            //------------------------------------------------------------------------------------------------------------->出口2，文件格式不正确
        }
    }else{
        $status = 0;
        $reminder = "不明原因导致的上传失败";
        echo $a->normalrespond($status,$reminder);
        //------------------------------------------------------------------------------------------------------------->出口6，没有接收到任何上传文件
    }


    /**获取文件格式类型**/
    function getFileCate($filename){
        return substr(strrchr($filename, '.'), 1);
    }

    /**获取文件格式类型**/
    function randomName($length){
        $abc = date("YmdHis");
        $hash = $abc.'-';
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
        $max = strlen($chars) - 1;
        mt_srand((double)microtime() * 1000000);
        for($i = 0; $i < $length; $i++){
            $hash .= $chars[mt_rand(0, $max)];
        }
        return $hash;
    }
?>