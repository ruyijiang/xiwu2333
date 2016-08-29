<?php
/**
 * Created by PhpStorm.
 * User: milobluebell
 * Date: 16-8-29
 * Time: 上午8:55
 */
require("../../connectDB.php");
require("../../all.php");
?><?php
//header('Content-type: application/json');
$uid = $_GET["uid"];//uid
$cate = $_GET["cate"];//索取类别
$targetid = $_GET["target_id"];//目标id

$cate = "article";
$targetid = "ART_1543371634";

$status = 0;
$reminder = "";
$a = new interfaceResponse();

if(!$targetid || !$cate){
    //-------------------------------------------------------------------------------------->缺少关键参数
    $status = 0;
    $reminder = "缺少关键参数，无法查询";
    echo $a->normalrespond($status,$reminder);
    return false;
}else{

    if($cate == "article"){

        $sql = "SELECT aid FROM `articles` WHERE aid = '$target_id' ";
        $qry = $db->query($sql);
        $row = $qry->fetch_assoc();
        if(!$row){
            //----------------------------------------------------------------------------->不存在该文章
            $status = 0;
            $reminder = "指定文章并不存在，无法查询";
            echo $a->normalrespond($status,$reminder);
            return false;
        }else{
            $EchoResult = array();

            $sql = "SELECT comment_id,content,regtime,from_uid FROM `comments` WHERE topic_id = '$target_id' ";
            $qry = $db->query($sql);
            while($row = $qry->fetch_assoc()){

                $arrTemp = array();

                $result_comment_id = $row["comment_id"];
                $result_content = $row["content"];
                $result_regtime = $row["regtime"];
                $result_from_uid = $row["from_uid"];

                $arrTemp["comment_id"] = $result_comment_id;
                $arrTemp["content"] = $result_content;
                $arrTemp["regtime"] = $result_regtime;
                $arrTemp["from_uid"] = $result_from_uid;

                array_push($EchoResult,$arrTemp);
            }

            var_dump($EchoResult);

        }

    }else if($cate == "match"){

    }else{
        //--------------------------------------------------------------------------------->参数无法解析
        $status = 0;
        $reminder = "参数无法正确解析，无法查询";
        echo $a->normalrespond($status,$reminder);
        return false;
    }


}


