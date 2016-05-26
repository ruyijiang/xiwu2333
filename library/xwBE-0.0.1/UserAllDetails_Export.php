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
        /**
         * 用户基础信息******************************
         */
        $result_avatar = $row["avatar"];//头像
        $result_name = $row["name"];//用户名
        $result_gender = $row["gender"];//性别
        $result_slogan = $row["slogan"];//签名
        $result_calling_card_id = $row["calling_card_id"];
        $result_calling_card = "";//认证信息
        $sql2 = "SELECT content FROM callingcard WHERE id = '$result_calling_card_id' ";
        $qry2 = $db->query($sql2);
        $row2 = $qry2->fetch_assoc();
        if($row2["content"]){
            $result_calling_card = $row2["content"];
        }else{
            $result_calling_card = "";
        }
        $result_country = $row["country"];//国家
        $result_province = $row["province"];//省份
        $result_city = $row["city"];//城市
        $result_ladderscore = $row["ladderscore"];//天梯
        $result_score = $row["score"];//评分
        $result_server = $row["server"];//服务器
        $result_liveplain = $row["liveplain"];//直播平台
        $result_qq = $row["qq"];//qq
        $result_weixin = $row["weixin"];//微信
        $result_weibo = $row["weibo"];//微博

        $sql3 = "SELECT bg_img FROM rooms WHERE creator = '$RequestUid' ";
        $qry3 = $db->query($sql3);
        $row3 = $qry3->fetch_assoc();
        $result_roomimg = $row3["bg_img"];//房间背景图


        /**
         * 用户特殊信息******************************
         */
        if($RequestCate == "pulse"){
            /*用户pulse数据*/

            $result_name = $row["name"];//liveness
            $result_name = $row["name"];//commit

        }else if($RequestCate == "article"){
            /*用户article数据*/

            $result_name = $row["name"];//articles
            $sql4 = "SELECT * FROM articles WHERE uid = '$RequestUid' ";
            $qry4 = $db->query($sql4);
            while($row4 = $qry4->fetch_assoc()){
                $result_title = $row4["title"];
                $result_time = $row4["time"];
                $restult_aid = $row4["aid"];
                //通过aid进行文章的远程调取
                //一方面这样做为了减轻数据库的压力，另一方面方便逐行读取，而不用一口气把所有文字全部拿下来

            }

        }else if($RequestCate == "comment"){
            /*用户comment数据*/

            $result_name = $row["name"];//用户comments数据
        }else{

        }


        /**
         * 输出
         */
        $dataArr = array ('uid'=>$RequestUid,'name'=>$result_name,'gender'=>$result_gender,'slogan'=>$result_slogan,'callingcard_content'=>$result_calling_card,'country'=>$result_country,'province'=>$result_province,'city'=>$result_city,'server'=>$result_server,'qq'=>$result_qq,'weixin'=>$result_weixin,'weibo'=>$result_weibo,'liveplain'=>$result_liveplain,'ladderscore'=>$result_ladderscore,'score'=>$result_score,'avatar'=>$result_avatar,'room_bg_img'=>$result_roomimg);

        foreach ( $dataArr as $key => $value ) {
            $dataArr[$key] = urlencode ($value);
        }

        $dataArr = urldecode ( json_encode ( $dataArr ));
        echo $dataArr;


    }else{
        //------------------------------------------------------------------------------------------------------------->出口1，查询失败
    }






?>
