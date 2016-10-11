<?php
/**
 * Created by PhpStorm.
 * User: milobluebell
 * Date: 16-8-30
 * Time: 上午9:16
 */
require("../../connectDB.php");
require("../../all.php");
?><?php

$timing = $_GET["timing"];

$a = new interfaceResponse();
$status = 0;
$reminder = "";

if($timing){

    $EchoResult = array();

    $sql = "SELECT topic_id,title,topic_desc,readtimes FROM topics ORDER BY regtime DESC LIMIT 4";
    $qry = $db->query($sql);
    $row_all = mysqli_num_rows($qry);
    if($row_all >= 1){

        while($row = $qry->fetch_assoc()){

            $result_topic_id = $row["topic_id"];
            $result_title = $row["title"];
            $result_subtitle = $row["subtitle"];
            $result_readtimes = $row["readtimes"];

            $dataArr = array('topic_id'=>$result_topic_id,'title'=>$result_title,'subtitle'=>$result_subtitle,'readtimes'=>$result_readtimes);
            foreach ( $dataArr as $key => $value ) {
                $dataArr[$key] = urlencode ($value);
            }

            array_push($EchoResult,$dataArr);

        }

    }else{

        $status = 0;
        $reminder = "没有获取到符合条件的话题，请联系管理员";
        echo $a->normalrespond($status,$reminder);

    }

}else{

    $status = 0;
    $reminder = "缺少关键参数，无法进行查询";
    echo $a->normalrespond($status,$reminder);

}