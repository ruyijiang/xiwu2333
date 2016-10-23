<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/10/22
 * Time: 0:59
 */
require("../../connectDB.php");
require("../../all.php");
?>
<?

@$uid = $_SESSION["uid"];//uid

$topic_id = $_GET["topic_id"];

$a = new _environment();
$tnow = $a->getTime();//当前datetime - iso时间
$tnow_stamp = time();//当前datetime - UNIX时间

$status = 0;
$reminder = "";
$a = new interfaceResponse();

if($topic_id){

    $sql = "SELECT topic_id FROM `topics` WHERE topic_id = '$topic_id' ";
    $qry = $db->query($sql);

    $sql2 = "SELECT topic_id FROM `comments` WHERE from_uid = '$uid' AND topic_id = '$topic_id' ";


}else{
    //------------------------------------------------------------------------------------>缺少关键参数，无法正确执行
    $status = 0;
    $reminder = "缺少关键参数，无法正确执行";
    echo $a->normalrespond($status,$reminder);
}