<?php
/**
 * Created by PhpStorm.
 * User: milobluebell
 * Date: 16-8-31
 * Time: 下午1:54
 */
require("../../connectDB.php");
require("../../all.php");
?><?php

@$timing = $_GET["timing"];

$a = new interfaceResponse();
$status = 0;
$reminder = "";

$b = new _environment();
$tnow = $b->getTime();//当年的ISO时间
$tnow_stamp = strtotime($tnow);//当前的UNIX时间
$todayStart = mktime(0,0,0,date("m"),date("d"),date("Y"));  //今天0点UNIX时间
$todayEnd = $todayStart + 24*60*60-1;                       //今天23:59的UNIX时间

if($timing){

    $EchoResult = array();

    $sql = "SELECT cover_id,title,subtitle,img FROM covers WHERE post_time > '$todayStart' AND post_time >= '$tnow_stamp' + duration ORDER BY time DESC LIMIT 4";
    $qry = $db->query($sql);
    $row_all = mysqli_num_rows($qry);
    if($row_all >= 1){

        while($row = $qry->fetch_assoc()){

            $result_topic_id = $row["cover_id"];
            $result_title = $row["title"];
            $result_subtitle = $row["subtitle"];
            $result_img = $row["img"];

            $dataArr = array('topic_id'=>$result_topic_id,'title'=>$result_title,'subtitle'=>$result_subtitle,'img'=>$result_img);
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