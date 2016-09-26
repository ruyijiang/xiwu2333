<?php
/**
 * Created by PhpStorm.
 * User: milobluebell
 * Date: 16-9-26
 * Time: 下午4:03
 */
require("../../connectDB.php");
require("../../all.php");
?><?php
header('Content-type: application/json');

@$uid = $_SESSION["uid"];//uid

$topic_id = $_GET["topic_id"];

$a = new _environment();
$tnow = $a->getTime();//当前datetime - iso时间
$tnow_stamp = time();//当前datetime - UNIX时间

$status = 0;
$reminder = "";
$a = new interfaceResponse();


if($topic_id){

    $sql = "SELECT `choices` FROM comments WHERE `topic_id` = '$topic_id' ";
    $qry = $db->query($sql);
    if($row_all = mysqli_num_rows($qry) > 0){
        $row = $qry->fetch_assoc();
        $result_choices = $row["choices"];

        $result_choices = explode(";",$result_choices);



    }else{
        //------------------------------------------------------------------------------------>没有搜索到结果
        $status = 0;
        $reminder = "没有搜索到任何结果";
        echo $a->normalrespond($status,$reminder);
    }

}else{
    //------------------------------------------------------------------------------------>缺少关键参数
    $status = 0;
    $reminder = "缺少关键参数，无法获取话题".$content."的结果";
    echo $a->normalrespond($status,$reminder);
}