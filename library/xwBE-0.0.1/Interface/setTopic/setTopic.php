<?php
/**
 * Created by PhpStorm.
 * User: milobluebell
 * Date: 16-9-14
 * Time: 下午1:51
 */
require("../../connectDB.php");
require("../../all.php");
require("../../algorithm/RandTopicId.php");
require("../../algorithm/Liveness.php");
?><?php
//header('Content-type: application/json');

@$uid = $_SESSION["uid"];//uid

@$customUrl = $_POST["customUrl"];
$topic_title = $_POST["topic_title"];
$topic_desc = $_POST["topic_desc"];
$topic_cate = $_POST["topic_cate"];
@$topic_tags = $_POST["topic_tags"];

$a = new _environment();
$tnow = $a->getTime();//当前datetime - iso时间
$tnow_stamp = time();//当前datetime - UNIX时间

$status = 0;
$reminder = "";
$a = new interfaceResponse();
if(empty($_SESSION["uid"]) || !isset($_SESSION["uid"])){
    $status = 0;
    $reminder = "发表失败。请登录后再发表话题";
    echo $b->normalrespond($status,$reminder);
    return false;
}else{

    if(!$topic_title || !$topic_desc || !$topic_cate){
        //------------------------------------------------------------------------------------------------------------->缺少关键参数
        $status = 0;
        $reminder = "缺少关键参数，无法查询";
        echo $a->normalrespond($status,$reminder);
    }else{
        $sql = "SELECT topic_id FROM topics WHERE customed_url = '$customUrl' ";
        $qry = $db->query($sql);
        $row_all = mysqli_num_rows($qry);

        if($row_all > 0){
            //--------------------------------------------------------------------------------------------------------->相同的自定义URL已经存在了
            $status = 0;
            $reminder = "自定义的URL链接已经有对应的话题了";
            echo $a->normalrespond($status,$reminder);
        }else{
            $sql = "SELECT topic_id FROM topics WHERE title = '$topic_title' OR topic_desc = '$topic_desc' ";
            $qry = $db->query($sql);
            $row_all = mysqli_num_rows($qry);
            if($row_all > 0){
                //----------------------------------------------------------------------------------------------------->有相同标题或相同描述的话题了
                $status = 0;
                $reminder = "有相同标题或相同描述的话题了";
                echo $a->normalrespond($status,$reminder);
            }else{

                $abc = create_TopicId();
                $sql = "INSERT INTO topics(id,topic_id,customed_url,uid,title,topic_desc,cate,tags,regtime) VALUES ('','$abc','$customUrl','$uid','$topic_title','$topic_desc','$topic_cate','$topic_tags','$tnow_stamp') ";
                $qry = $db->query($sql);

                if($qry){
                    $thisScore = countScore('setTopic');
                    $d = new liveness();

                    if($d->setLiveness('setTopic',$thisScore,'Interface')){
                        //--------------------------------------------------------------------------------------------->发布成功
                        if(!empty($customUrl)){//自定义URL了
                            $status = $customUrl;
                            $reminder = "话题发布成功";
                        }else{
                            $status = $abc;
                            $reminder = "话题发布成功";
                        }

                    }else{
                        //--------------------------------------------------------------------------------------------->记录活跃度时出现错误
                        $status = 0;
                        $reminder = "记录活跃度时出现错误，导致话题发布失败";
                    }
                    echo $a->normalrespond($status,$reminder);
                }else{
                    //------------------------------------------------------------------------------------------------->数据库插入错误
                    $status = 0;
                    $reminder = "数据库插入错误，请联系管理员";
                    echo $a->normalrespond($status,$reminder);
                }

            }

        }

    }

}