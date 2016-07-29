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
$mm = new Dota2Api\Mappers\MatchMapperWeb(2051819680);
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