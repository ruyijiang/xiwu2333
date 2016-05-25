<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/5/25
 * Time: 9:42
 */
require("../connectDB.php");
require("../all.php");
?>
<?php

    $status = $reminder = "";

    $RequestCate = $_POST["drequest"];
    @$RequestUid = $_POST["uid"];

    if(!isset($RequestUid) || empty($RequestUid)){//请求的是自己
        $RequestUid = $_SESSION["uid"];
    }//否则请求的是别人
    $sql = "SELECT * FROM users WHERE uid='$RequestUid' ";
    $qry = $db->query($sql);
    $row = $qry->fetch_assoc();
    if($qry){
        /*用户基础数据*/
        $result_name = $row["name"];//用户名
        $result_name = $row["name"];//用户签名
        $result_name = $row["name"];//用户认证信息***
        $result_name = $row["name"];//用户uid
        $result_name = $row["name"];//地区
        $result_name = $row["name"];//天梯
        $result_name = $row["name"];//评分
        $result_name = $row["name"];//服务器
        $result_name = $row["name"];//qq
        $result_name = $row["name"];//用户签名微信
        $result_name = $row["name"];//房间***
        $result_name = $row["name"];//用户签名
        if($RequestCate == "pulse"){
            /*用户pulse数据*/

            $result_name = $row["name"];//liveness
            $result_name = $row["name"];//commit

        }else if($RequestCate == "article"){
            /*用户article数据*/

            $result_name = $row["name"];//articles

        }else if($RequestCate == "comment"){
            /*用户comment数据*/

            $result_name = $row["name"];//用户comments数据
        }else{

        }




    }else{
        //------------------------------------------------------------------------------------------------------------->出口1，查询失败
    }






?>
