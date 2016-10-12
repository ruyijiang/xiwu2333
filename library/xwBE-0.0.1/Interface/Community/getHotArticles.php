<?php
/**
 * Created by PhpStorm.
 * User: milobluebell
 * Date: 16-8-30
 * Time: 上午9:14
 */
require("../../connectDB.php");
require("../../all.php");
?><?php

@$timing = $_GET["timing"];

$a = new interfaceResponse();
$status = 0;
$reminder = "";

if($timing){

    $sql = "SELECT aid,title,subtitle,abstract,cover_img FROM articles WHERE length(content) > 400 ORDER BY read_times DESC LIMIT 3 ";
    $qry = $db->query($sql);

    if($qry){

        $EchoResult = array();

        while($row = $qry->fetch_assoc()){
            $result_aid = $row["aid"];
            $result_title = $row["title"];
            $result_subtitle = $row["subtitle"];
            $result_abstract = $row["abstract"];
            $result_cover_img = $row["cover_img"];

            $dataArr = array ('aid'=>$result_aid,'title'=>$result_title,'subtitle'=>$result_subtitle,'abstract'=>$result_abstract,'cover_img'=>$result_cover_img);
            foreach ( $dataArr as $key => $value ) {
                $dataArr[$key] = urlencode ($value);
            }

            array_push($EchoResult,$dataArr);

        }

        $EchoResult = urldecode ( json_encode ( $EchoResult ));
        echo $EchoResult;

    }else{

        $status = 0;
        $reminder = "搜索热门文章失败，请联系管理员";
        echo $a->normalrespond($status,$reminder);

    }

}else{

    $status = 0;
    $reminder = "缺少关键参数，无法进行查询";
    echo $a->normalrespond($status,$reminder);

}