<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/6/28
 * Time: 15:46
 */
require("../../connectDB.php");
require("../../all.php");
?><?php

    @$timing = $_GET["timing"];
    @$cate = $_GET["cate"];
    @$CateContent = $_GET["content"];

    $a = new interfaceResponse();
    $status = $reminder = "";

    if($timing){

        if($cate&&$CateContent){
            //对随机用户加以限制
            if($cate == "gender"&&($CateContent=="male"||$CateContent=="female"||$CateContent=="man"||$CateContent=="woman")){
                //限制条件是：性别
                $sql = "SELECT uid FROM users WHERE gender = '$CateContent' AND name !== '' AND score !== '0' AND server_bigarea != '' ORDER BY rand() LIMIT 1";
            }else{
                $sql = "SELECT uid FROM users WHERE gender = '$CateContent' AND name !== '' AND score !== '0' AND server_bigarea != '' ORDER BY rand() LIMIT 1";
            }
        }else{
            //未对随机用户加限制
            $sql = "SELECT uid FROM users WHERE name != '' AND server_bigarea != '' ORDER BY rand() LIMIT 1";//AND score != '0'
        }

        $qry = $db->query($sql);
        $row = $qry->fetch_assoc();
        $result_uid = $row["uid"];

        echo $result_uid;

    }else{

        $status = 0;
        $reminder = "缺少关键参数，无法进行查询";
        echo $a->normalrespond($status,$reminder);

    }
