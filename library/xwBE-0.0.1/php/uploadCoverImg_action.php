<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/11/3
 * Time: 15:06
 */
require("../connectDB.php");
require("../all.php");
?>
<?php
    @$uid = $_SESSION["uid"];
    $imgname = $_POST["imgname"];//imgname在前台进行控制，我们默认约定是此刻UNIX时间戳
    $atype = $_POST["atype"];//imgname在前台进行控制，我们默认约定是此刻UNIX时间戳
    $a = new interfaceResponse();
    $status = $reminder = 0;

    if($uid && $imgname){

        $type = array("jpg","bmp","jpeg","png","gif");
        if($atype == "cover"){
            $uploaddir = "../../../img/cover_img/";
            $filename_mid = "cover";
        }else{
            $uploaddir = "../../../img/article_img/";
            $filename_mid = "article";
        }

        if($_FILES['coverImg']['name']){
            if(in_array(strtolower(getFileCate($_FILES['coverImg']['name'])),$type)){
                $filename=explode(".",$_FILES['coverImg']['name']);//$filename = ['201606141106','jpg']
                do{
                    $doctype = $filename[1];//jpg
                    $filename = $uid.$filename_mid.$imgname.".".$doctype;
                    $uploadfile=$uploaddir.$filename;
                }while(file_exists($uploadfile));

                if(!file_exists(dirname($uploadfile))){
                    //不存在这个目录，则创建一个目录
                    mkdir(dirname($uploadfile),0777);//则创建一个目录，并赋予0777模式权限
                }

                if (move_uploaded_file($_FILES['coverImg']['tmp_name'],$uploadfile)){
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

    }else{
        $status = 0;
        $reminder = "缺少关键参数，无法正确执行";
        echo $a->normalrespond($status,$reminder);
        //--------------------------------------------------------------------------------------------------------->出口3，临时文件转移失败
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