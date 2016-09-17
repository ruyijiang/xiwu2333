<?php
/**
 * Created by PhpStorm.
 * User: milobluebell
 * Date: 16-9-14
 * Time: 下午1:51
 */
require("../../connectDB.php");
require("../../all.php");
?><?php
//header('Content-type: application/json');

@$uid = $_SESSION["uid"];//uid

@$customUrl = $_POST["customUrl"];
$topic_title = $_POST["topic_title"];
$topic_desc = $_POST["topic_desc"];
$topic_cate = $_POST["topic_cate"];
@$topic_tags = $_POST["topic_tags"];

$a = new _environment();
$tnow = $a->getTime();//当前datetime - iso时间
$tnow_stamp = time();//当前datetime - UNIX时间

$status = 0;
$reminder = "";
$a = new interfaceResponse();


if(!$topic_title || !$topic_desc || !$topic_cate){
    //-------------------------------------------------------------------------------------->缺少关键参数
    $status = 0;
    $reminder = "缺少关键参数，无法查询";
    echo $a->normalrespond($status,$reminder);
}else{
    $sql = "INSERT INTO topics('topic_id','customed_url','uid','title','desc','cate','tags','regtime') VALUES ('','$customUrl','$uid','$topic_title','$topic_desc','$topic_cate','$topic_tags','$tnow_stamp') ";
    $qry = $db->query($sql);

    if($qry){
        //-------------------------------------------------------------------------------------->
        $status = 1;
        $reminder = "话题发表成功";
        echo $a->normalrespond($status,$reminder);
    }else{
        //-------------------------------------------------------------------------------------->
        $status = 0;
        $reminder = "";
        echo $a->normalrespond($status,$reminder);
    }

}