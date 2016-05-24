<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/5/10
 * Time: 19:42
 * Function: 数据展示
 */
require("../connectDB.php");
require("../all.php");
?>
<div style="margin-top:150px;height:20px;background-color:#e9e9e9;"></div>
<?php

    $sql = "select count(1),city from users group by city order by count(1) desc limit 0,3";
    $qry = $db->query($sql);
    while ($row = $qry->fetch_assoc()){
        $result = $row["city"];
        var_dump($result);
    }
    //$row = $qry->fetch_assoc();

class UserData{
    /**
     * 获取玩家性别比例
     * return:  {"rate_male":xxx,"rate_female":xxx}(string)
     */
    public function getSexualRates(){
        $sql_gendermale = "SELECT COUNT(gender) FROM users WHERE gender = '0' ";
        $qry_gendermale = $db->query($sql_gendermale);
        $row_gendermale = $qry_gendermale->fetch_assoc();
        $result_gendermale = $row_gendermale["COUNT(gender)"];
        $result_gendermale = intval($result_gendermale, 10);//性别为男的数量 -> type:int
        $sql_genderfemale = "SELECT COUNT(gender) FROM users WHERE gender = '1' ";
        $qry_genderfemale  = $db->query($sql_genderfemale);
        $row_genderfemale = $qry_genderfemale->fetch_assoc();
        $result_genderfemale = $row_genderfemale["COUNT(gender)"];
        $result_genderfemale = intval($result_genderfemale, 10);//性别为女的数量 -> type:int

        $rate_male = $result_gendermale/($result_gendermale + $result_genderfemale);
        $rate_female = $result_genderfemale/($result_gendermale + $result_genderfemale);

        return '{"rate_male":'.$rate_male.',"rate_female":'.$rate_female.'}';
    }

    /**
     * 获取玩家所在地记录
     * return {"HighestProvince":xxx,"HighestProvince":xxx}(string)
     */
    public function getHighestLocation(){


    }

    /**
     * 获取当前在线玩家数量
     * return xxx(int)
     */
    public function getOnlineUsersAmount(){
        $sql = "SELECT uid FROM users WHERE onlinestatus = '1' ";
        $qry = $db->query($sql);
        $row = $qry->fetch_assoc();
        $result_uid = $row["uid"];
        $result = intval($result_uid, 10);

        return $result;
    }

    /**
     * 获取某一时段内在线玩家数量
     * @param:period-时间段，格式为:TimeStamp1-TimeStamp2
     * @param:interval-时间间隔(int)，单位是秒
     * return {"09:30":xxx,"10:00":xxx,"10:30":xxx,"11:00":xxx}(string)
     */
    public function getOnlineUsersAmountInPeriod($period,$interval){

    }

}


    //当前在线玩家



?>
