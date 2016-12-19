<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/11/9
 * Time: 22:15
 */
require("../../connectDB.php");
require("../../all.php");
?>
<?php
@$uid = $_SESSION["uid"];
$imgname = $_GET["imgname"];//imgname在前台进行控制的
$imgCate = $_GET["imgCate"];//imgname在前台进行控制的
$a = new interfaceResponse();
$status = $reminder = 0;

if($imgname){

    if($imgCate == "cover"){
        $uploaddir = "../../../../img/cover_img/";
    }else{
        $uploaddir = "../../../../img/article_img/";
    }
    $type = array("jpg","bmp","jpeg","png","gif");

    $isExist = false;
    foreach ($type as $key => $value){
        $filename = $uid."cover".$imgname.".".$value;
        $imgFile=$uploaddir.$filename;

        if(file_exists($imgFile)){
            $isExist = true;
            $tempFileName = $imgFile;
        }
    }

    if($isExist === true){
        $status = $tempFileName;
        if($imgCate == "cover"){
            $reminder = "存在对应的cover封面";
        }else{
            $reminder = "存在对应的article封面";
        }
        echo $a->normalrespond($status,$reminder);
        //--------------------------------------------------------------------------------------------------------->出口1，存在对应的cover封面
    }else{
        $status = 0;
        if($imgCate == "cover"){
            $reminder = "不存在对应的cover封面";
        }else{
            $reminder = "不存在对应的article封面";
        }
        echo $a->normalrespond($status,$reminder);
        //--------------------------------------------------------------------------------------------------------->出口2，不存在对应的cover封面
    }
    
}else{
    $status = 0;
    $reminder = "缺少关键参数，无法正确执行";
    echo $a->normalrespond($status,$reminder);
    //--------------------------------------------------------------------------------------------------------->出口3，临时文件转移失败
}