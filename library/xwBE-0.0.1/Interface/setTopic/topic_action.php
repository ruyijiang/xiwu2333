<?php
/**
 * Created by PhpStorm.
 * User: milobluebell
 * Date: 16-9-26
 * Time: 上午11:31
 */
//用户参与话题时的提交（用户自定义话题的接口是setTopic.php）
require("../../connectDB.php");
require("../../all.php");
?><?php
//header('Content-type: application/json');

@$uid = $_SESSION["uid"];//uid

$classification = $_POST["classification"];
$topic_id = $_POST["topic_id"];
@$choices = $_POST["choices"];
@$content = $_POST["content"];

$a = new _environment();
$tnow = $a->getTime();//当前datetime - iso时间
$tnow_stamp = time();//当前datetime - UNIX时间

$status = 0;
$reminder = "";
$a = new interfaceResponse();


if($classification && $topic_id){
    //classification只能有三种情况：单选、多选、填空
    if($classification == "radio" || $classification == "checkbox" || $classification == "text"){

        $sql = "SELECT id,answer FROM 'topics' WHERE topic_id = '$topic_id' ";
        $qry = $db->query($sql);
        if(mysqli_num_rows($qry) > 0){
            $row = $qry->fetch_assoc();
            $participation = (int)$row["participation_times"] + 1;

            //更新topics表
            $sql1 = "UPDATE topics SET participation_times = '$participation' WHERE topic_id = '$topic_id' ";

            //更新comments表
            if($classification == "radio" || $classification == "checkbox"){
                //选择题类型的话题，回答是ballot
                $sql2 = "INSERT INTO ballots(ballot_id,content,from_uid,to_topicid,regtime) VALUES ('','$content','$uid','$topic_id','$tnow_stamp') ";
            }else if($classification == "text"){
                //问答类型的话题，回答即是comment
                $sql2 = "INSERT INTO comments(comment_id,content,choices,from_uid,to_id,regtime) VALUES ('','$content','$choices','$uid','','$topic_id','$tnow_stamp') ";
            }else{
                //------------------------------------------------------------------------------------>没有找到符合要求的话题类型
                $status = 1;
                $reminder = "没有找到符合要求的话题类型";
                echo $a->normalrespond($status,$reminder);
                return false;
            }

            if($qry1 = $db->query($sql1) && $qry2 = $db->query($sql2)){
                //------------------------------------------------------------------------------------>话题参与成功---@@@
                $status = 1;
                $reminder = "提交成功";
                echo $a->normalrespond($status,$reminder);
            }else{
                //------------------------------------------------------------------------------------>不明原因导致的话题参与失败
                $status = 0;
                $reminder = "不明原因导致的提交失败，请联系管理员";
                echo $a->normalrespond($status,$reminder);
            }

        }else{
            //------------------------------------------------------------------------------------>没有找到对应topic_id的话题
            $status = 0;
            $reminder = "没有找到对应话题";
            echo $a->normalrespond($status,$reminder);
        }

    }else{
        //------------------------------------------------------------------------------------>classification在三种情况之外
        $status = 0;
        $reminder = "无法正确解析话题类型classification，请联系管理员";
        echo $a->normalrespond($status,$reminder);
    }
}else{
    //------------------------------------------------------------------------------------>缺少关键参数，无法正确执行
    $status = 0;
    $reminder = "无法正确执行程序，请确认填写了话题内容";
    echo $a->normalrespond($status,$reminder);
}
