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
@$uid = $_SESSION["uid"];//uid
$cate = $_GET["cate"];//索取类别
$target_id = $_GET["target_id"];//目标id
@$now_page = $_GET["now_page"];//当前页数
@$num_onepage = $_GET["num_onepage"];

if(!$now_page) $now_page = 0;

$now_page - 1<0?$now_page=1:$now_page;
$num_start = ($now_page - 1)*$num_onepage;

$status = 0;
$reminder = "";
$a = new interfaceResponse();

if(!$target_id || !$cate){
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

            $sql1 = "SELECT comment_id,content,regtime,from_uid,to_id FROM comments WHERE topic_id = '$target_id' ORDER BY regtime desc LIMIT $num_start,$num_onepage";

            $qry1 = $db->query($sql1);
            while($row = $qry1->fetch_assoc()){

                $arrTemp = array();
                $result_comment_id = $row["comment_id"];
                $result_content = $row["content"];
                $result_regtime = $row["regtime"];
                $result_from_uid = $row["from_uid"];
                $result_to_id = $row["to_id"];

                if($result_to_id && $result_to_id !== 1){
                    $sql = "SELECT uid,name,avatar FROM users WHERE uid = '$result_to_id' ";
                    $qry = $db->query($sql);
                    $row = $qry->fetch_assoc();
                    $result_to_name = $row["name"];
                }else{
                    $result_to_id = $result_to_name = null;
                }

                if($result_from_uid && $result_from_uid !== 1){
                    $sql = "SELECT uid,name,avatar FROM users WHERE uid = '$result_from_uid' ";
                    $qry = $db->query($sql);
                    $row = $qry->fetch_assoc();
                    $result_from_name = $row["name"];
                    $result_from_avatar = $row["avatar"];
                }

                $arrTemp["comment_id"] = $result_comment_id;
                $arrTemp["content"] = $result_content;
                $arrTemp["regtime"] = date("Y/m/d H:i:s", $result_regtime);
                $arrTemp["from_uid"] = $result_from_uid;
                $arrTemp["from_name"] = $result_from_name;
                $arrTemp["from_avatar"] = $result_from_avatar;
                $arrTemp["to_id"] = $result_to_id;
                $arrTemp["to_name"] = $result_to_name;

                array_push($EchoResult,$arrTemp);

            }

            echo (json_encode($EchoResult));

        }

    }else if($cate == "topic"){

    }else{
        //--------------------------------------------------------------------------------->参数无法解析
        $status = 0;
        $reminder = "参数无法正确解析，无法查询";
        echo $a->normalrespond($status,$reminder);
        return false;
    }


}


