<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/7/22
 * Time: 14:02
 */
require("../../connectDB.php");
require("../../all.php");

$playersMapperWeb = new Dota2Api\Mappers\PlayersMapperWeb();

$steamid = Dota2Api\Models\Player::convertId(252556081);

$playersInfo = $playersMapperWeb->addId($steamid)->load();

$playerMapperDb = new Dota2Api\Mappers\PlayerMapperDb();
foreach($playersInfo as $playerInfo) {
    $playerMapperDb->save($playerInfo);
}


print_r($playersInfo);