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

    $sql = "SELECT topic_id,title,topic_desc,par_times,customed_url FROM `topics` ORDER BY par_times DESC LIMIT 5";
    $qry = $db->query($sql);
    $row_all = mysqli_num_rows($qry);
    if($row_all >= 1){

        while($row = $qry->fetch_assoc()){

            $result_topic_id = $row["topic_id"];
            $result_customed_url = $row["customed_url"];
            $result_title = $row["title"];
            $result_topic_desc = $row["topic_desc"];
            $result_par_times = $row["par_times"];

            $dataArr = array('topic_id'=>$result_topic_id,'title'=>$result_title,'subtitle'=>$result_topic_desc,'customed_url'=>$result_customed_url,'readtimes'=>$result_par_times);
            foreach ( $dataArr as $key => $value ) {
                $dataArr[$key] = urlencode ($value);
            }

            array_push($EchoResult,$dataArr);

        }

        $EchoResult = urldecode ( json_encode ( $EchoResult ));
        echo $EchoResult;

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