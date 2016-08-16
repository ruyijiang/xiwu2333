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
header('Content-type: application/json');

$a = new interfaceResponse();
$status = $reminder = 0;

$uid = $_GET["uid"];//uid
$dota2_uid = $_GET["dota2_uid"];//dota2_uid

$sql = "SELECT last_requested_match_id FROM users WHERE uid = '$uid' AND dota2_uid = '$dota2_uid' ";
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
    $last_requested_match_id = $row["last_requested_match_id"];

    @$b = file_get_contents("https://api.steampowered.com/IDOTA2Match_570/GetMatchHistory/v001/?key=".$STEAM_APIKEY."&account_id=".$dota2_uid);//附加参数： "&start_at_match_id=".$last_requested_match_id
    if(!$b){
        $status = 0;
        $reminder = "无法访问steam-dota2服务器";
        echo $a->normalnormalrespond($status,$reminder);
    }else{
        echo $b;
    }
}