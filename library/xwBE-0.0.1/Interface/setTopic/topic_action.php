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

        $sql = "SELECT topic_id,par_times FROM `topics` WHERE topic_id = '$topic_id' ";
        $qry = $db->query($sql);
        if(mysqli_num_rows($qry) > 0){

            //更新comments表
            if($classification == "radio" || $classification == "checkbox"){
                //选择题类型的话题，回答是ballot

                $reminder1 = false;
                if(is_array($choices)){

                    foreach ($choices as $key => $value ){
                        if($value == "true"){
                            $reminder1 = true;
                        }
                    }

                }

                if(count($choices) < 1 || !$reminder1){
                    //没有填写答案

                    //------------------------------------------------------------------------------------>没有投票
                    $status = 0;
                    $reminder = "没有投票";
                    echo $a->normalrespond($status,$reminder);
                    return false;

                }else{

                    if($classification == "radio"){
                        $choices_str = $choices[0];
                    }else if($classification == "checkbox"){
                        $choices_str = "[";

                        foreach ($choices as $key => $value){
                            if($value == "true"){
                                $choices_str .= $key.":".$value.",";
                            }
                        }

                        $choices_str .= "]";
                    }

                    $sql2 = "INSERT INTO `ballots`(ballot_id,classification,result,from_uid,to_topicid,regtime) VALUES ('','$classification','$choices_str','$uid','$topic_id','$tnow_stamp') ";

                }
            }else if($classification == "text"){
                //问答类型的话题，回答即是comment

                if(empty($content)){
                    //没有填写答案

                    //------------------------------------------------------------------------------------>没有投票
                    $status = 0;
                    $reminder = "没有填写答案";
                    echo $a->normalrespond($status,$reminder);
                    return false;

                }else{

                    $sql2 = "INSERT INTO `comments`(comment_id,content,choices,from_uid,to_id,regtime) VALUES ('','$content','$choices','$uid','','$topic_id','$tnow_stamp') ";

                }

            }else{
                //------------------------------------------------------------------------------------>没有找到符合要求的话题类型
                $status = 1;
                $reminder = "没有找到符合要求的话题类型";
                echo $a->normalrespond($status,$reminder);
                return false;
            }

            if($qry2 = $db->query($sql2)){
                $row = $qry->fetch_assoc();
                $participation = (int)$row["par_times"] + 1;

                //更新topics表
                $sql3 = "UPDATE `topics` SET par_times = '$participation' WHERE topic_id = '$topic_id' ";

                if($qry3 = $db->query($sql3)){
                    //------------------------------------------------------------------------------------>话题参与成功---@@@
                    $status = 1;
                    $reminder = "提交成功";
                    echo $a->normalrespond($status,$reminder);
                }else{
                    //------------------------------------------------------------------------------------>不明原因导致的话题参与次数更新失败，但是参与内容已经提交成功
                    $status = 0;
                    $reminder = "不明原因导致的话题参与次数更新失败，但是参与内容已经提交成功";
                    echo $a->normalrespond($status,$reminder);
                }
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
