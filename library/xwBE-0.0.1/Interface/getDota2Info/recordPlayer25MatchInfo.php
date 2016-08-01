<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/8/1
 * Time: 10:46
 */
require("../../connectDB.php");
require("../../all.php");
?><?php
//header('Content-type: application/json');
$matchesMapperWeb = new Dota2Api\Mappers\MatchesMapperWeb();
$matchesMapperWeb->setAccountId(252556081);
$matchesShortInfo = $matchesMapperWeb->load();
var_dump($matchesShortInfo);
foreach ($matchesShortInfo as $key=>$matchShortInfo) {
    $matchMapper = new Dota2Api\Mappers\MatchMapperWeb($key);
    $match = $matchMapper->load();
    $slots = $match->getAllSlots();
    foreach($slots as $slot) {
        if($slot->get('deaths')==0){
            echo number_format(($slot->get('kills')+$slot->get('assists'))/1,1)."<br>";
        }else{
            echo number_format(($slot->get('kills')+$slot->get('assists'))/$slot->get('deaths'),1)."<br>";
        }
    }

    /*if ($match) {
        $mm = new Dota2Api\Mappers\MatchMapperDb();
        //$mm->save($match);
    }*/
}