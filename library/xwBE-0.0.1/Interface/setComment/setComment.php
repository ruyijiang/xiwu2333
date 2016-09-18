<?php
/**
 * Created by PhpStorm.
 * User: milobluebell
 * Date: 16-8-29
 * Time: 上午9:16
 */
require("../../connectDB.php");
require("../../all.php");
?><?php
//header('Content-type: application/json');

@$uid = $_SESSION["uid"];//uid
@$cate = $_POST["cate"];//索取类别
@$targetid = $_POST["to_id"];//目标id
@$topic_id = $_POST["topic_id"];//主题id
@$content = $_POST["content"];//评论正文内容

$a = new _environment();
$tnow = $a->getTime();//当前datetime - iso时间
$tnow_stamp = time();//当前datetime - UNIX时间

$status = 0;
$reminder = "";
$a = new interfaceResponse();



if(!$cate || !$content || !$topic_id){
    //-------------------------------------------------------------------------------------->缺少关键参数
    $status = 0;
    $reminder = "缺少关键参数，无法查询";
    echo $a->normalrespond($status,$reminder);
}else{
    if($cate == "article"){
        //是针对文章的评论
        $sql = "SELECT comment_id FROM comments WHERE from_uid = '$uid' AND regtime = '$tnow_stamp' ";
        $qry = $db->query($sql);
        $row_all = mysqli_num_rows($qry);
        @$row = $qry->fetch_assoc();
        if($row_all >= 1){
            //---------------------------------------------------------------------------------->同一时间提交了两次评论，高度疑似为机器人提交。
            $status = 0;
            $reminder = "您在同一时间提交了两次评论，导致评论失败，请重新提交评论";
            echo $a->normalrespond($status,$reminder);
        }else{
            $sql = "SELECT regtime FROM comments WHERE from_uid = '$uid' ORDER BY regtime DESC LIMIT 1 ";
            $qry = $db->query($sql);
            $row = $qry->fetch_assoc();
            if($row){
                $result_lasttime = $row["regtime"];
                if($tnow_stamp - (int)$result_lasttime <= 6){
                    //------------------------------------------------------------------------------>太短时间内提交了两次评论。
                    $status = 0;
                    $reminder = "您提交过于频繁，请稍后再试";
                    echo $a->normalrespond($status,$reminder);
                }else{
                    if($targetid == $uid){
                        //------------------------------------------------------------------------------>不允许评论自己。
                        $status = 0;
                        $reminder = "不允许评论自己";
                        echo $a->normalrespond($status,$reminder);
                    }else{
                        //这里的to_id有可能为空，但是topic_id一定不会为空
                        $sql = "INSERT INTO comments(comment_id,content,from_uid,to_id,topic_id,regtime) VALUES ('','$content','$uid','$targetid','$topic_id','$tnow_stamp') ";
                        $qry = $db->query($sql);
                        if($qry){
                            //------------------------------------------------------------------------------>提交成功
                            $status = 1;
                            $reminder = "提交成功";
                            echo $a->normalrespond($status,$reminder);
                        }else{
                            //------------------------------------------------------------------------------>提交失败
                            $status = 0;
                            $reminder = "提交失败，请联系管理员";
                            echo $a->normalrespond($status,$reminder);
                        }

                    }

                }
            }else{
                //这里的to_id有可能为空，但是topic_id一定不会为空
                $sql = "INSERT INTO comments(comment_id,content,from_uid,to_id,topic_id,regtime) VALUES ('','$content','$uid','$targetid','$topic_id','$tnow_stamp') ";
                $qry = $db->query($sql);
                if($qry){
                    //------------------------------------------------------------------------------>提交成功
                    $status = 1;
                    $reminder = "提交成功";
                    echo $a->normalrespond($status,$reminder);
                }else{
                    //------------------------------------------------------------------------------>提交失败
                    $status = 0;
                    $reminder = "提交失败，请联系管理员";
                    echo $a->normalrespond($status,$reminder);
                }

            }

        }

    }

}