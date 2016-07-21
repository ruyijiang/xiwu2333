<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/5/25
 * Time: 9:42
 */
require("connectDB.php");
require("all.php");
?>
<?php

    $mm = new Dota2Api\Mappers\MatchesMapperWeb(121995119);
    $match = $mm->load();
    var_dump($match);







    $status = $reminder = "";
    @$RequestUid = $_GET["uid"];

    $SessionStatus = false;
    if(!isset($RequestUid) || empty($RequestUid)){//请求的是自己
        if(!empty($_SESSION["uid"])){
            $SessionStatus = true;
            $RequestUid = $_SESSION["uid"];
        }else $SessionStatus = false;
    }//否则请求的是别人


    $sql = "SELECT * FROM users WHERE uid = '$RequestUid' ";
    $qry = $db->query($sql);
    $row = $qry->fetch_assoc();
    if($row){
        /**
         * 用户基础信息******************************
         */
        $result_avatar = $row["avatar"];//头像
        $result_name = $row["name"];//用户名
        $result_gender = $row["gender"];//性别
        $result_slogan = $row["slogan"];//签名
        $result_calling_card_id = $row["calling_card_id"];
        $result_calling_card = "";//认证信息
        $sql2 = "SELECT content FROM callingcard WHERE ccid = '$result_calling_card_id' ";
        $qry2 = $db->query($sql2);
        $row2 = $qry2->fetch_assoc();
        if($row2["content"]){
            $result_calling_card = $row2["content"];
        }else{
            $result_calling_card = "";
        }
        $result_uid = $row["uid"];//国家
        $result_country = $row["country"];//国家
        $result_province = $row["province"];//省份
        $result_city = $row["city"];//城市
        $result_ladderscore = $row["ladderscore"];//天梯
        $result_score = $row["score"];//评分
        $result_server = $row["server"];//服务器
        $result_server_bigarea = $row["server_bigarea"];
        $result_liveplain = $row["liveplain"];//直播平台
        $result_qq = $row["qq"];//qq
        $result_weixin = $row["weixin"];//微信
        $result_weibo = $row["weibo"];//微博
        $result_page_num = $row["page_num"];//微博

        /*$sql3 = "SELECT name,bg_img FROM rooms WHERE creator = $RequestUid ";
        $qry3 = $db->query($sql3);
        $row3 = $qry3->fetch_assoc();
        $result_roomimg = $row3["bg_img"];//房间背景图
        $result_roomname = $row3["name"];//房间名称*/


        /**
         * 输出
         */
        $dataArr = array ('uid'=>$result_uid,'name'=>$result_name,'gender'=>$result_gender,'slogan'=>$result_slogan,'callingcard_content'=>$result_calling_card,'country'=>$result_country,'province'=>$result_province,'city'=>$result_city,'server'=>$result_server,'server_bigarea'=>$result_server_bigarea,'qq'=>$result_qq,'weixin'=>$result_weixin,'weibo'=>$result_weibo,'liveplain'=>$result_liveplain,'ladderscore'=>$result_ladderscore,'score'=>$result_score,'avatar'=>$result_avatar,'page_num'=>$result_page_num);

        foreach ( $dataArr as $key => $value ) {
            $dataArr[$key] = urlencode ($value);
        }

        $dataArr = urldecode ( json_encode ( $dataArr ));
        echo $dataArr;


    }else{

        //------------------------------------------------------------------------------------------------------------->出口1，查询失败
    }






?>
