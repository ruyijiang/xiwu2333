<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/7/23
 * Time: 15:06
 */
require("../../connectDB.php");
require("../../all.php");
?><?php
//header('Content-type: application/json');

$a = new interfaceResponse();
$status = $reminder = 0;

$uid = $_GET["uid"];//uid
$dota2_uid = $_GET["dota2_uid"];//dota2_uid

$sql = "SELECT last_requested_dota2_match_id FROM users WHERE uid = '$uid' AND dota2_uid = '$dota2_uid' ";
@$qry = $db->query($sql);
@$row = $qry->fetch_assoc();
if(!$row){
    //没有对应的记录结果
    $status = 0;
    $reminder = "没有找到对应玩家的dota2游戏记录";
    echo $a->normalnormalrespond($status,$reminder);
}else{
    //有对应的记录结果
    //那么我们就取
    $last_requested_dota2_match_id = $row["last_requested_dota2_match_id"];

    @$b = json_decode(file_get_contents("https://api.steampowered.com/IDOTA2Match_570/GetMatchHistory/v001/?key=".$STEAM_APIKEY."&account_id=".$dota2_uid));//附加参数： "&start_at_match_id=".$last_requested_match_id
    if(!$b || !$b->{"result"}->{"matches"}){
        $status = 0;
        $reminder = "无法访问steam-dota2服务器";
        echo $a->normalnormalrespond($status,$reminder);
    }else{
        $todayStart = mktime(0,0,0,date("m"),date("d"),date("Y"));
        $todayEnd = $todayStart + 24*60*60-1;

        foreach($b->{"result"}->{"matches"} as $value){
            if($value->{"start_time"} >= $todayStart && $value->{"start_time"} <= $todayEnd){
                //是今天发生的比赛
                $sql2 = "INSERT INTO `info_dota2`.`d2i_matchhistory`() VALUES ";
                echo $value->{"start_time"}."</br>";
            }
        }
    }
}