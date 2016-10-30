<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/10/22
 * Time: 0:59
 */
require("../../connectDB.php");
require("../../all.php");
?>
<?

@$uid = $_SESSION["uid"];//uid

$topic_id = $_GET["topic_id"];

$a = new _environment();
$tnow = $a->getTime();//当前datetime - iso时间
$tnow_stamp = time();//当前datetime - UNIX时间

$status = 0;
$reminder = "";
$a = new interfaceResponse();

if($topic_id){

    $sql = "SELECT topic_id FROM `topics` WHERE topic_id = '$topic_id' ";
    $qry = $db->query($sql);
    if(mysqli_num_rows($qry) <= 0){
        //-------------------------------------------------------------------------------->没有找到对应的话题
        $status = 0;
        $reminder = "没有找到对应的话题，无法正确执行";
        echo $a->normalrespond($status,$reminder);
    }else{
        $sql2 = "SELECT ballot_id,to_topicid,result FROM `ballots` WHERE from_uid = '$uid' AND to_topicid = '$topic_id' ";
        $qry2 = $db->query($sql2);

        if(mysqli_num_rows($qry2) == 1){
            $rows = $qry2->fetch_assoc();
            $result_topicid = $rows["to_topicid"];
            //-------------------------------------------------------------------------------->在对应话题下投过票---@@@

            $sql3 = "SELECT result FROM `ballots` WHERE to_topicid = '$topic_id' ";
            $qry3 = $db->query($sql3);
            $EchoArr = array();
            $ResultArr = array();

            while($rows3 = $qry3->fetch_assoc()){
                $TempArr = explode(",",$rows3["result"]);
                foreach ($TempArr as $key => $value){

                    if(isset($ResultArr[$value])){
                        $ResultArr[$value]++;
                    }else{
                        $ResultArr[$value] = 1;
                    }

                }
            }

            $result_ballot_result = $rows["result"];

            $EchoArr["statuscode"] = $result_topicid;
            $EchoArr["message"] = "在对应话题下投过票";
            $EchoArr["results"] = $ResultArr;
            echo (json_encode($EchoArr));

        }else if(mysqli_num_rows($qry2) > 1){
            //-------------------------------------------------------------------------------->用户在对应话题下多次投票
            $status = 0;
            $reminder = "查询到多个投票结果";
            echo $a->normalrespond($status,$reminder);

        }else{
            //-------------------------------------------------------------------------------->没有在对应话题下投过票---@@@
            $status = 0;
            $reminder = "没有在对应话题下透过票";
            echo $a->normalrespond($status,$reminder);

        }

    }

}else{
    //------------------------------------------------------------------------------------>缺少关键参数，无法正确执行
    $status = 0;
    $reminder = "缺少关键参数，无法正确执行";
    echo $a->normalrespond($status,$reminder);
}