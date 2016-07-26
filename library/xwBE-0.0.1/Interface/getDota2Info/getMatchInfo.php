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

$content = $_GET["content"];
$startnum = $_GET["startnum"];

$a = new interfaceResponse();
$status = $reminder = 0;

if(!empty($content) || !empty($startnum)){



    $mm = new Dota2Api\Mappers\MatchMapperWeb($content);
    $match = $mm->load();
    $result = $match->getDataArray();
    $slots = $match->getAllSlots();
    $slot_info = array();
    foreach($slots as $slot) {
        $hero_id = $slot->get("hero_id");
        $sql = "SELECT name FROM `info_dota2`.`heros` WHERE hero_id = '$hero_id' ";
        @$qry = $db->query($sql);
        if(!$qry){
            array_push($slot_info,$slot->get("hero_id"));
        }else{
            $row = $db->fetch_assoc($qry);
            $hero_name = $row["name"];
            array_push($slot_info,$hero_name);
        }
    }
    //print_r($match->getSlot(0)->getDataArray());
    $result["slot_info"] = $slot_info;


    /*************************
     ****** 翻译数组内容：******
     ************************/
    //1，翻译所在服务器：
    switch ($result["cluster"]){
        case "223":
            $result["cluster"] = "电信（浙江）";
            break;
        case "224":
            $result["cluster"] = "电信（上海）";
            break;
        case "225":
            $result["cluster"] = "电信（广东）";
            break;
        case "227":
            $result["cluster"] = "电信（华中）";
            break;
        case "231":
            $result["cluster"] = "联通1";
            break;
    }
    //2，翻译开始时间：
    $a = new _environment();
    $tnow = strtotime($a->getTime());
    if($minus = $tnow - strtotime($result["start_time"]) <= 24*60*60 && $tnow - strtotime($result["start_time"]) >= 1*60*60){
        //一天之内
        $result["start_time"] = "约".round($minus / 60 * 60,0)."小时前";
    }else if($minus = $tnow - strtotime($result["start_time"]) < 1*60*60){
        $result["start_time"] = "约".(round($minus / 60 * 60,1)*60)."分钟前";
    }
    //3，翻译持续时间：
    $result["duration"] = floor($result["duration"] / 60) . "分" . $result["duration"]%60 . "秒";
    /*******************End of 翻译****************/
    /*********************************************/



    //输出json对象
    echo(json_encode($result));

}else{
    $status = 0;
    $reminder = "缺少关键参数";
    echo $a->normalrespond($status,$reminder);
}