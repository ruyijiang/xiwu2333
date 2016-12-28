<?php
/**
 * Created by PhpStorm.
 * User: milobluebell
 * Date: 16-12-28
 * Time: 上午10:01
 */
require("../../connectDB.php");
require("../../all.php");
?><?php

@$timing = $_GET["timing"];


$a = new interfaceResponse();
$status = 0;
$reminder = "";


if($timing){

    $sql = "SELECT aid,title,abstract,article_img FROM `articles` WHERE length(content) > 80 ORDER BY time DESC LIMIT 3";
    $qry = $db->query($sql);

    if($qry){
        $EchoResult = array();

        while($row = $qry->fetch_assoc()){
            //文章数据，可直接获取
            $result_aid = $row["aid"];
            $result_title = $row["title"];
            $result_abstract = $row["abstract"];
            $result_article_img = $row["article_img"];

            //文章作者数据，需再去user表读取
            $result_author_uid = $row["uid"];
            $sql1 = "SELECT name,avatar FROM `users` WHERE uid = '$result_author_uid'";
            $qry1 = $db->query($sql1);
            $row1 = $qry1->fetch_assoc();
            $result_auth_name = $row1["name"];
            $result_auth_avatar = $row1["avatar"];

            $dataArr = array ('aid'=>$result_aid,'title'=>$result_title,'abstract'=>$result_abstract,'article_img'=>$result_article_img,'uid'=>$result_author_uid,'auth_name'=>$result_auth_name,'auth_avatar'=>$result_auth_avatar);
            foreach ( $dataArr as $key => $value ) {
                $dataArr[$key] = urlencode ($value);
            }

            array_push($EchoResult,$dataArr);

        }

        $EchoResult = urldecode ( json_encode ( $EchoResult ));
        echo $EchoResult;

    }else{

        $status = 0;
        $reminder = "搜索最新文章失败，请联系管理员";
        echo $a->normalrespond($status,$reminder);

    }

}else{

    $status = 0;
    $reminder = "缺少关键参数，无法进行查询";
    echo $a->normalrespond($status,$reminder);

}