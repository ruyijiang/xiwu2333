<?php
/**
 * Created by PhpStorm.
 * User: milobluebell
 * Date: 16-9-18
 * Time: 下午3:11
 */
require("../../connectDB.php");
require("../../all.php");
?>
<?
@$uid = $_SESSION["uid"];//uid
@$content = $_GET["content"];//检索内容

$a = new _environment();
$tnow = $a->getTime();//当前datetime - iso时间
$tnow_stamp = time();//当前datetime - UNIX时间

$status = 0;
$reminder = "";
$a = new interfaceResponse();

if($content){

    $sql = "SELECT topic_id FROM topics WHERE customed_url = '$content' ";
    $qry = $db->query($sql);
    $row_all = mysqli_num_rows($qry);

    if($row_all > 0){

        $status = 0;
        $reminder = "已存在相同的自定义URL链接";
        echo $a->normalrespond($status,$reminder);

    }else{

        $sql1 = "SELECT id FROM topics WHERE topic_id = '$content' ";
        $qry1 = $db->query($sql1);
        if(mysqli_num_rows($qry1) > 0){

            $status = 0;
            $reminder = "该URL不符合要求，请再换一个";
            echo $a->normalrespond($status,$reminder);

        }else{

            $status = 1;
            $reminder = "该URL可以使用";
            echo $a->normalrespond($status,$reminder);

        }

    }

}else{

    $status = 0;
    $reminder = "缺少关键参数，无法进行查询";
    echo $a->normalrespond($status,$reminder);

}