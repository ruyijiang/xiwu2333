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
    echo(json_encode($result));


}else{
    $status = 0;
    $reminder = "缺少关键参数";
    echo $a->normalrespond($status,$reminder);
}