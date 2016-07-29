<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/7/29
 * Time: 9:06
 */

$mm = new Dota2Api\Mappers\MatchMapperWeb(121995119);
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