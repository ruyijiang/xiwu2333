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

$uid = $_GET["uid"];                                        //uid
$dota2_uid = $_GET["dota2_uid"];                            //dota2_uid

$todayStart = mktime(0,0,0,date("m"),date("d"),date("Y"));  //今天0点UNIX时间
$todayEnd = $todayStart + 24*60*60-1;                       //今天23:59的UNIX时间

$EchoResult = array();                                      //此程序最终要等待json格式化输出的数组

$sql = "SELECT id,start_time FROM `info_dota2`.`d2i_matchhistory` WHERE d2id = '$dota2_uid' AND start_time < '$todayStart' ";
$qry = $db->query($sql);
@$row = mysqli_num_rows($qry);
    //拿存入数据库的今天之前的比赛数据//从数据库取
    while($row = $qry->fetch_assoc()){
        $ISOTime = date('m/d',$row["start_time"]);
        if(!isset($EchoResult[$ISOTime]) || empty($EchoResult[$ISOTime])){
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
            if($value->{"start_time"} >= $todayStart && $value->{"start_time"} <= $todayEnd){
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
                    $sql2 = "INSERT INTO `info_dota2`.`d2i_matchhistory`(id,match_id,match_seq_num,start_time) VALUES ('',$ThisMatch_id,$ThisMatch_seq_num,$ThisStart_time)";
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