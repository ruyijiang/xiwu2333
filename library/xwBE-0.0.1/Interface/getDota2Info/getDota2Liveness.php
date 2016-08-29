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
$weekarray=array("日","一","二","三","四","五","六");
$weektoday = "周".$weekarray[date("w")];

$a = new interfaceResponse();
$status = $reminder = 0;

$uid = $_GET["uid"];                                        //uid
$dota2_uid = $_GET["dota2_uid"];                            //dota2_uid

$todayStart = mktime(0,0,0,date("m"),date("d"),date("Y"));  //今天0点UNIX时间
$todayEnd = $todayStart + 24*60*60-1;                       //今天23:59的UNIX时间

$daysBeforeToday = "";
$daysBeforeToday_Unix = 0;
switch (date("w")){
    case "0":
        $daysBeforeToday = date('m/d', strtotime('-98 days'));
        $daysBeforeToday_Unix = mktime(0,0,0,date('m', strtotime('-98 days')),date('d', strtotime('-98 days')));
        break;
    case "1":
        $daysBeforeToday = date('m/d', strtotime('-92 days'));
        $daysBeforeToday_Unix = mktime(0,0,0,date('m', strtotime('-92 days')),date('d', strtotime('-92 days')));
        break;
    case "2":
        $daysBeforeToday = date('m/d', strtotime('-93 days'));
        $daysBeforeToday_Unix = mktime(0,0,0,date('m', strtotime('-93 days')),date('d', strtotime('-93 days')));
        break;
    case "3":
        $daysBeforeToday = date('m/d', strtotime('-94 days'));
        $daysBeforeToday_Unix = mktime(0,0,0,date('m', strtotime('-94 days')),date('d', strtotime('-94 days')));
        break;
    case "4":
        $daysBeforeToday = date('m/d', strtotime('-95 days'));
        $daysBeforeToday_Unix = mktime(0,0,0,date('m', strtotime('-95 days')),date('d', strtotime('-95 days')));
        break;
    case "5":
        $daysBeforeToday = date('m/d', strtotime('-96 days'));
        $daysBeforeToday_Unix = mktime(0,0,0,date('m', strtotime('-96 days')),date('d', strtotime('-96 days')));
        break;
    case "6":
        $daysBeforeToday = date('m/d', strtotime('-97 days'));
        $daysBeforeToday_Unix = mktime(0,0,0,date('m', strtotime('-97 days')),date('d', strtotime('-97 days')));
        break;
}

$EchoResult = array();//此程序最终要等待json格式化输出的数组
$finaltime = 0;
do{

    if($finaltime == 0){
        $finaltime = $daysBeforeToday_Unix + 86400;
    }else{
        $finaltime += 86400;
    }

    $ISOTime = date('m/d',$finaltime);
    $EchoResult[$ISOTime] = 0;


}while($finaltime < $todayStart - 86400);


    $sql = "SELECT id,start_time FROM `info_dota2`.`d2i_matchhistory` WHERE d2id = '$dota2_uid' AND start_time >= '$daysBeforeToday_Unix' AND start_time < '$finaltime' ";
    $qry = $db->query($sql);
    //拿存入数据库的今天之前的比赛数据//从数据库取
    while($row = $qry->fetch_assoc()){
        $ISOTime = date('m/d',$row["start_time"]);
        if(!isset($EchoResult[$ISOTime]) || $EchoResult[$ISOTime] == 0){
            $EchoResult[$ISOTime] = 1;
        }else{
            $EchoResult[$ISOTime]++;
        }
    }

    //拿今天的数据//从api取
    $last_requested_dota2_match_id = $row["last_requested_dota2_match_id"];

    @$b = json_decode(file_get_contents("https://api.steampowered.com/IDOTA2Match_570/GetMatchHistory/v001/?key=".$STEAM_APIKEY."&account_id=".$dota2_uid));//附加参数： "&start_at_match_id=".$last_requested_match_id
    if(!$b || !$b->{"result"}->{"matches"}){
        $status = 0;
        $reminder = "无法访问steam-dota2服务器";
        echo $a->normalnormalrespond($status,$reminder);
        exit;
    }else{
        foreach($b->{"result"}->{"matches"} as $value){
            if($value->{"start_time"} >= $todayStart - 86400 && $value->{"start_time"} <= $todayEnd){
                //是今天发生的比赛

                $ThisMatch_id = $value->{"match_id"};
                $ThisMatch_seq_num = $value->{"match_seq_num"};
                $ThisStart_time = $value->{"start_time"};

                $ISOTime = date('m/d',$ThisStart_time);
                if(!isset($EchoResult[$ISOTime]) || empty($EchoResult[$ISOTime])){
                    $EchoResult[$ISOTime] = 1;
                }else{
                    $EchoResult[$ISOTime]++;
                }

                $sql3 = "SELECT id FROM `info_dota2`.`d2i_matchhistory` WHERE match_id = '$ThisMatch_id' ";
                $qry3 = $db->query($sql3);
                @$row3 = mysqli_num_rows($qry3);
                if(!$row3){
                    $sql2 = "INSERT INTO `info_dota2`.`d2i_matchhistory`(id,match_id,match_seq_num,start_time,d2id) VALUES ('',$ThisMatch_id,$ThisMatch_seq_num,$ThisStart_time,$dota2_uid)";
                    $qry2 = $db->query($sql2);
                    if(!$qry2){
                        $status = 0;
                        $reminder = "存储dota2比赛数据失败，失败的match_id是：".$ThisMatch_id;
                        echo $a->normalnormalrespond($status,$reminder);
                    }
                    exit;
                }

            }
        }//End of Foreach
    }


    echo (json_encode($EchoResult));