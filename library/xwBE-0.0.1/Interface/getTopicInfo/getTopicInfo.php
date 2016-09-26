<?php
/**
 * Created by PhpStorm.
 * User: milobluebell
 * Date: 16-9-14
 * Time: 下午1:51
 */
require("../../connectDB.php");
require("../../all.php");
?><?php
//header('Content-type: application/json');

@$uid = $_SESSION["uid"];//uid

$content = $_GET["content"];

$a = new _environment();
$tnow = $a->getTime();//当前datetime - iso时间
$tnow_stamp = time();//当前datetime - UNIX时间

$status = 0;
$reminder = "";
$a = new interfaceResponse();


if($content){

    $sql = "SELECT * FROM topics WHERE topic_id = '$content' OR customed_url = '$content' ";
    $qry = $db->query($sql);
    $row_all = mysqli_num_rows($qry);
    if($row_all > 0){
        $arrTemp = array();
        //-------------------------------------------------------------------------------->找到了对应的话题
        $row = $qry->fetch_assoc();

        $arrTemp["topic_id"] = $row["topic_id"];
        $arrTemp["customed_url"] = $row["customed_url"];
        $arrTemp["title"] = $row["title"];
        $arrTemp["topic_desc"] = $row["topic_desc"];
        $arrTemp["cate"] = $row["cate"];
        $arrTemp["regtime"] = $row["regtime"];

        $arrTemp["uid"] = $result_uid =  $row["uid"];
        $sql1 = "SELECT * FROM users WHERE uid = '$result_uid' ";
        $qry1 = $db->query($sql1);
        $row1 = $qry1->fetch_assoc();
        $arrTemp["user_avatar"] = $row1["avatar"];
        $arrTemp["user_name"] = $row1["name"];

        $arrTemp["tags"] = $result_tags = $row["tags"];
        $result_tags = explode(";",$result_tags);
        $arrTemp2 = array();
        foreach ($result_tags as $temp){
            $arrTemp3 = array();

            $sql2 = "SELECT topic_id,customed_url,title,topic_desc FROM topics WHERE tags LIKE '%$temp%' ORDER BY regtime DESC LIMIT 5 ";
            $qry2 = $db->query($sql2);
            while ($row2 = $qry2->fetch_assoc()){

                $arrTemp3["topic_id"] = $row2["topic_id"];
                $arrTemp3["customed_url"] = $row2["customed_url"];
                $arrTemp3["title"] = $row2["title"];
                $arrTemp3["topic_desc"] = $row2["topic_desc"];

                array_push($arrTemp2,$arrTemp3);
            }
        }

        $arrTemp["related_topics"] = $arrTemp2;

        echo (json_encode($arrTemp));

    }else{
        //-------------------------------------------------------------------------------->没有找到对应的话题
        $status = 0;
        $reminder = "没有找到话题".$content;
        echo $a->normalrespond($status,$reminder);
    }


}else{
    //------------------------------------------------------------------------------------>缺少关键参数
    $status = 0;
    $reminder = "缺少关键参数，无法为您查询";
    echo $a->normalrespond($status,$reminder);
}