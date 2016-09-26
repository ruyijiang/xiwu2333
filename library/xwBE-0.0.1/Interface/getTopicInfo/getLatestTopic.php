<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/9/23
 * Time: 14:42
 */
require("../../connectDB.php");
require("../../all.php");
?><?php
//header('Content-type: application/json');

@$uid = $_SESSION["uid"];//uid

@$tnow = $_GET["tnow"];

$a = new _environment();
$tnow = $a->getTime();//当前datetime - iso时间
$tnow_stamp = time();//当前datetime - UNIX时间

$status = 0;
$reminder = "";
$a = new interfaceResponse();


if($tnow){
    //如果$tnow不为空，则针对tnow进行latestTopic检索//输出5个
    $sql = "SELECT * FROM 'topics' WHERE regtime <= '$tnow' ORDER BY regtime DESC LIMIT 5 ";
    $qry = $db->query($sql);
    $row_all = mysqli_num_rows($qry);
    if($row_all > 0){
        $arrTemp = array();

        while ($row = $qry->fetch_assoc()){
            $arrTemp["topic_id"] = $row["topic_id"];
            $arrTemp["customed_url"] = $row["customed_url"];
            $arrTemp["title"] = $row["title"];
            $arrTemp["topic_desc"] = $row["topic_desc"];
        }

        echo (json_encode($arrTemp));
    }else{
        //------------------------------------------------------------------------------------>没有搜索到结果
        $status = 0;
        $reminder = "没有搜索到任何话题";
        echo $a->normalrespond($status,$reminder);
    }

}else{
    //如果$tnow为空，则针对全表进行latestTopic检索//输出5个
    $sql = "SELECT * FROM 'topics' ORDER BY regtime DESC LIMIT 5 ";
    $qry = $db->query($sql);
    $row_all = mysqli_num_rows($qry);
    if($row_all > 0){
        $arrTemp = array();

        while ($row = $qry->fetch_assoc()){
            $arrTemp["topic_id"] = $row["topic_id"];
            $arrTemp["customed_url"] = $row["customed_url"];
            $arrTemp["title"] = $row["title"];
            $arrTemp["topic_desc"] = $row["topic_desc"];
        }

        echo (json_encode($arrTemp));

    }else{
        //------------------------------------------------------------------------------------>没有搜索到结果
        $status = 0;
        $reminder = "没有搜索到任何话题";
        echo $a->normalrespond($status,$reminder);
    }
}