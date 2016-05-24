<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/5/5
 * Time: 12:38
 */
require("../connectDB.php");
require("../all.php");
?>
<?
    $dateHeader = $_POST["timing"];//接收一个随机时间,格式必须是UNIX时间戳
    if(!empty($dateHeader)){
        $sql = "SELECT * FROM users WHERE openstatus = '1' ";
        $qry = $db -> query($sql);
        $user_countnum = 0;//输出的用户数量
        while($row = mysqli_fetch_array($qry)){
            $uid = $row["uid"];
            $dota2_uid = $row["dota2_uid"];
            $name = $row["name"];
            $gender = $row["gender"];
            $skilledposition = $row["skilledposition"];
            $damage = $row["damage"];
            $kda = $row["kda"];
            $score = $row["score"];
            $dataArr = array ('uid'=>$uid,'dota2_uid'=>$dota2_uid,'name'=>$name,'gender'=>$gender,'skilledposition'=>$skilledposition,'damage'=>$damage,'kda'=>$kda,'score'=>$score);

            foreach ( $dataArr as $key => $value ) {
                $dataArr[$key] = urlencode ($value);
            }
            $dataArr = urldecode ( json_encode ( $dataArr ) . ",");
            echo $dataArr;
            $user_countnum++;
        }
    }else{
        $status = 0;
        $reminder = "请求开放组队玩家列表失败，可能的原因是没有发送请求头，请联系管理员";
        $a = new interfaceResponse();
        echo $a->normalrespond($status,$reminder);
    }
?>
