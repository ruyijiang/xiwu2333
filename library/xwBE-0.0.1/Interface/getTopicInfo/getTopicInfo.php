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
        $arrTemp["regtime"] = date("Y/m/d H:i",$row["regtime"]);
        $arrTemp["topic_classification"] = $row["classification"];
        $arrTemp["topic_choices"] = $row["choices"];

        $arrTemp["topic_choices"] = explode(";",$arrTemp["topic_choices"]);
        foreach ($arrTemp["topic_choices"] as $key => $value){
            if(!empty($value)){
                $arrTemp4["content"] = $value;
                $arrTemp["topic_choices"][$key] = $arrTemp4;
            }
        }

        $arrTemp["uid"] = $result_uid =  $row["uid"];
        $sql1 = "SELECT * FROM users WHERE uid = '$result_uid' ";
        $qry1 = $db->query($sql1);
        $row1 = $qry1->fetch_assoc();
        $arrTemp["user_avatar"] = $row1["avatar"];
        $arrTemp["user_name"] = $row1["name"];

        $arrTemp["tags"] = $result_tags = explode(";",$row["tags"]);
        $arrTemp2 = array();
        $arrTemp2_topics = array();
        foreach ($result_tags as $temp){
            $arrTemp3 = array();

            $sql2 = "SELECT topic_id,customed_url,title,topic_desc FROM topics WHERE tags LIKE '%$temp%' ORDER BY regtime DESC LIMIT 5 ";
            $qry2 = $db->query($sql2);
            while ($row2 = $qry2->fetch_assoc()){
                
                if(count($arrTemp2_topics) > 0){

                    foreach ($arrTemp2_topics as $key => $value){
                        $AddFlag = true;

                        if(!empty($value) && ($value == $row2["topic_id"] && $value == $arrTemp["topic_id"]) ){
                            $AddFlag = false;
                        }

                    }

                    if($AddFlag == true){

                        //该临时数组里没有这个topic_id,说明这个topic还没有成为相关话题
                        $arrTemp3["topic_id"] = $row2["topic_id"];
                        $arrTemp3["customed_url"] = $row2["customed_url"];
                        $arrTemp3["title"] = $row2["title"];
                        $arrTemp3["topic_desc"] = $row2["topic_desc"];

                        array_push($arrTemp2,$arrTemp3);
                        array_push($arrTemp2_topics,$row2["topic_id"]);

                    }

                }else{

                    $arrTemp3["topic_id"] = $row2["topic_id"];
                    $arrTemp3["customed_url"] = $row2["customed_url"];
                    $arrTemp3["title"] = $row2["title"];
                    $arrTemp3["topic_desc"] = $row2["topic_desc"];

                    array_push($arrTemp2,$arrTemp3);
                    array_push($arrTemp2_topics,$row2["topic_id"]);

                }

            }

        }

        $min = 0;$max = count($arrTemp2) - 1;
        $numbers = range ($min,$max);
        shuffle ($numbers);
        $arrTemp2_temp = array();

        for($i=0;$i<5;$i++){
            array_push($arrTemp2_temp,$arrTemp2[$numbers[$i]]);
        }

        $arrTemp["related_topics"] = $arrTemp2_temp;

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