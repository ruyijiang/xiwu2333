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

$content = $_GET["content"];

$a = new _environment();
$tnow = $a->getTime();//当前datetime - iso时间
$tnow_stamp = time();//当前datetime - UNIX时间

$status = 0;
$reminder = "";
$a = new interfaceResponse();

if($content){

    $sql = "SELECT * FROM topics WHERE topic_id = '$content' OR customed_url = '$content' ";
    $qry = $db->query($sql);
    $row_all = mysqli_num_rows($qry);
    if($row_all > 0){

    }else{
        //-------------------------------------------------------------------------------->没有找到对应的话题
    }


}else{
    //------------------------------------------------------------------------------------>缺少关键参数
    $status = 0;
    $reminder = "缺少关键参数，无法为您查询";
    echo $a->normalrespond($status,$reminder);
}