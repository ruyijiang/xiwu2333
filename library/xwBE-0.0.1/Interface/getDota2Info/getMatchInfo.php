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
    /*echo $match->get('match_id');
    echo $match->get('start_time');
    echo $match->get('game_mode');
    $slots = $match->getAllSlots();
    foreach($slots as $slot) {
        echo $slot->get('last_hits');
    }
    print_r($match->getSlot(0)->getDataArray());*/
    echo(json_encode($match->getDataArray()));






}else{
    $status = 0;
    $reminder = "缺少关键参数";
    echo $a->normalrespond($status,$reminder);
}