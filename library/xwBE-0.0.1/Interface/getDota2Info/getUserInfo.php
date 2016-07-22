<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/7/22
 * Time: 14:02
 */
require("../../connectDB.php");
require("../../all.php");

/*
$mm = new Dota2Api\Mappers\MatchMapperWeb(2518854450);
$match = $mm->load();
var_dump($match);
*/

$playersMapperWeb = new Dota2Api\Mappers\PlayersMapperWeb();

$a = Dota2Api\Models\Player::convertId(252556081);

$playersInfo = $playersMapperWeb->addId($a)->load();

$playerMapperDb = new Dota2Api\Mappers\PlayerMapperDb();

foreach($playersInfo as $playerInfo) {
    //echo $playerInfo->get('realname');
    //echo '<img src="'.$playerInfo->get('avatarfull').'" alt="'.$playerInfo->get('personaname').'" />';
    //echo '<a href="'.$playerInfo->get('profileurl').'">'.$playerInfo->get('personaname').'\'s steam profile</a>';
    $playerMapperDb->save($playerInfo);
    var_dump($playerMapperDb);
}
var_dump($playersMapperWeb);


print_r($playersInfo);