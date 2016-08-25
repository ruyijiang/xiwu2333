<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/8/25
 * Time: 20:19
 */
require("../../connectDB.php");
require("../../all.php");
?><?php

$leagueMapper = new Dota2Api\Mappers\LeagueMapper(22); // set league id (can be get via leagues_mapper)
$games = $leagueMapper->load();
print_r($games);
/*
$leaguesMapperWeb = new Dota2Api\Mappers\LeaguesMapperWeb();
$leagues = $leaguesMapperWeb->load();
print_r($leagues);
echo "<br>";
foreach($leagues as $league) {
    echo $league->get('<br>');
    if ($league->get('tournament_url')) {
        echo $league->get('tournament_url');
    }
}*/