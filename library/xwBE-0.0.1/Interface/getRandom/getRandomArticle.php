<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/6/29
 * Time: 11:38
 */
require("../../connectDB.php");
require("../../all.php");
?><?php

$timing = $_GET["timing"];
@$cate = $_GET["cate"];
@$CateContent = $_GET["content"];

$a = new interfaceResponse();
$status = $reminder = "";

if($timing){

    if($cate&&$CateContent){
        //对随机文章加以限制
        $sql = "SELECT * FROM articles WHERE uid = '$CateContent' ORDER BY rand() LIMIT 1";
    }else{
        //未对随机用户加限制
        $sql = "SELECT * FROM articles ORDER BY rand() LIMIT 1";
    }

    $qry = $db->query($sql);
    $row = $qry->fetch_assoc();
    $result_aid = $row["aid"];
    $result_uid = $row["uid"];
    $result_content = $row["content"];
    @$result_abstract = $row["abstract"];


    $dataArr = array ('aid'=>$result_aid,'uid'=>$result_uid,'content'=>$result_content,'abstract'=>$result_abstract);
    foreach ( $dataArr as $key => $value ) {
        $dataArr[$key] = urlencode ($value) ;
    }
    $dataArr = urldecode ( json_encode ( $dataArr ));
    echo $dataArr;

}else{
    $status = 0;
    $reminder = "缺少关键参数";
    echo $a->normalrespond($status,$reminder);
}


?>
