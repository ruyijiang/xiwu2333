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

    $sql = "SELECT * FROM `covers` WHERE post_time <= '$tnow_stamp' AND unpost_time > '$tnow_stamp' ORDER BY regtime DESC LIMIT 4";
    @$qry = $db->query($sql);
    @$row_all = mysqli_num_rows($qry);
    if($row_all >= 1){

        while($row = $qry->fetch_assoc()){

            $result_cover_id = $row["cover_id"];
            $result_title = $row["title"];
            $result_subtitle = $row["subtitle"];
            $result_abstract = $row["abstract"];
            $result_cover_img = $row["cover_img"];
            $result_bg_color = $row["bg_color"];
            $result_btn_content = $row["btn_content"];

            $dataArr = array('cover_id'=>$result_cover_id,'title'=>$result_title,'subtitle'=>$result_subtitle,'abstract'=>$result_abstract,'cover_img'=>$result_cover_img,'bg_color'=>$result_bg_color,'btn_content'=>$result_btn_content);
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