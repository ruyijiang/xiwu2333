<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/7/22
 * Time: 14:02
 */
require("../../connectDB.php");
require("../../all.php");
?><?php
header('Content-type: application/json');

$mm = new Dota2Api\Mappers\MatchMapperWeb(2525733347);
$match = $mm->load();
echo $match->get('match_id');
echo $match->get('start_time');
echo $match->get('game_mode');
$slots = $match->getAllSlots();
foreach($slots as $slot) {
    echo $slot->get('last_hits');
}
print_r($match->getDataArray());
print_r($match->getSlot(0)->getDataArray());