<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/8/1
 * Time: 10:46
 */
require("../../connectDB.php");
require("../../all.php");
//这是执行速度很慢的一段代码
?><?php
header('Content-type: application/json');
@$matchamount = file_get_contents("php://input",true);

@$uid = $_SESSION["uid"];

$status = $reminder = "";
$a = new interfaceResponse();

$result_dota2_uid = "252556081";
$sql = "SELECT dota2_uid FROM users WHERE uid = '$uid' ";
$qry = $db->query($sql);
$row = $qry->fetch_assoc();
if(!$row){
    $status = 0;
    $reminder = "没有找到对应的玩家信息，您还有没有绑定游戏ID或尚未登陆。";
    echo $a->normalrespond($status,$reminder);
    return false;
}else{
    $result_dota2_uid = $row["dota2_uid"];

    //开始收录玩家游戏数据
    $matchesMapperWeb = new Dota2Api\Mappers\MatchesMapperWeb();
    $matchesMapperWeb->setAccountId($result_dota2_uid);
    @$matchesShortInfo = $matchesMapperWeb->load();
    if($matchesShortInfo !== null){

        $KDA = 0.0;//每场KDA的和
        $DamageRate = 0.00;//每场输出比的和
        $ParticipationRate = 0.0;//每场参战率的和
        $mnum = 0;//当前请求比赛数据的次数

        $status = 0;

        foreach ($matchesShortInfo as $key=>$matchShortInfo) {
            if($matchamount > 35) $matchamount = 35;
            if($mnum >= $matchamount){break;}

            $matchMapper = new Dota2Api\Mappers\MatchMapperWeb($key);
            $match = $matchMapper->load();
            @$slots = $match->getAllSlots();

            $team = null;//指定玩家所属队伍: radiant | diet

            $TargetDamage = 0;//指定玩家伤害
            $OtherDamage_radiant = 0;//天辉所有玩家伤害之和
            $OtherDamage_diet = 0;//夜宴所有玩家伤害之和

            $TargetKA = 0;//指定玩家击杀和助攻之和
            $Kills_radiant = 0;//天辉所有玩家击杀之和
            $Kills_diet = 0;//夜宴所有玩家击杀之和

            foreach($slots as $key2=>$slot) {
                if($slot->get('account_id') == $result_dota2_uid){
                    //是指定玩家
                    if($key2 <= 4){
                        $OtherDamage_radiant += $slot->get('hero_damage') + $slot->get('tower_damage');
                        $Kills_radiant += $slot->get('kills');
                        $team = "radiant";
                    }else{
                        $OtherDamage_diet += $slot->get('hero_damage') + $slot->get('tower_damage');
                        $Kills_diet += $slot->get('kills');
                        $team = "diet";
                    }

                    $TargetDamage = $slot->get('hero_damage') + $slot->get('tower_damage');
                    $TargetKA = $slot->get('kills') + $slot->get('assists');

                    if($slot->get('deaths') == 0){
                        $KDA += ($slot->get('kills')+$slot->get('assists'))/1;
                    }else{
                        $KDA += ($slot->get('kills')+$slot->get('assists'))/$slot->get('deaths');
                    }

                    $status = 1;
                    $mnum++;

                }else{
                    if($key2 <= 4){
                        $OtherDamage_radiant += $slot->get('hero_damage') + $slot->get('tower_damage');
                        $Kills_radiant += $slot->get('kills');
                    }else{
                        $OtherDamage_diet += $slot->get('hero_damage') + $slot->get('tower_damage');
                        $Kills_diet += $slot->get('kills');
                    }
                }
            }

            if($team == "radiant"){

                if($OtherDamage_radiant!==0){
                    $DamageRate += $TargetDamage / $OtherDamage_radiant;
                    $ParticipationRate += $TargetKA / $Kills_radiant;
                    $b = $TargetDamage / $OtherDamage_radiant;
                    $c = $TargetKA / $Kills_radiant;
                }else{
                    $DamageRate += $TargetDamage / 1;
                    $ParticipationRate += $TargetKA / 1;
                    $b = $TargetDamage / 1;
                    $c = $TargetKA / 1;
                }

            }else if($team == "diet"){

                if($OtherDamage_diet!==0){
                    $DamageRate += $TargetDamage / $OtherDamage_diet;
                    $ParticipationRate += $TargetKA / $Kills_diet;
                    $b = $TargetDamage / $OtherDamage_diet;
                    $c = $TargetKA / $Kills_diet;
                }else{
                    $DamageRate += $TargetDamage / 1;
                    $ParticipationRate += $TargetKA / 1;
                    $b = $TargetDamage / 1;
                    $c = $TargetKA / 1;
                }

            }

        }

        @$ave_kda = number_format($KDA/$mnum,1);
        @$ave_damage = (number_format($DamageRate/$mnum,4)*100)."%";
        @$ave_participationrate = (number_format($ParticipationRate/$mnum,3)*100)."%";



        //开始更新玩家数据库 - 场均数据
        $sql = "UPDATE users SET `damage` = '$ave_damage',`kda` = '$ave_kda',`participationrate` = '$ave_participationrate' WHERE uid = '$uid' ";
        $qry = $db->query($sql);
        if($qry){
            $status = 1;
            $reminder = "玩家数据入库成功";

            $arr = array ('statuscode'=>$status,'message'=>$reminder,'average_kda'=>$ave_kda,'average_dr'=>$ave_damage,'average_pr'=>$ave_participationrate);
            foreach ( $arr as $key => $value ) {
                $arr[$key] = urlencode ($value);
            }
            $arr = urldecode ( json_encode ( $arr ) );
            echo $arr;

        }else{
            $status = 0;
            $reminder = "用户数据入库失败，请联系管理员";
            echo $a->normalrespond($status,$reminder);
        }

    }else{
        $status = 0;
        $reminder = "无法请求数据，参数不正确或STEAM服务器出现问题";
        echo $a->normalrespond($status,$reminder);
    }


}


