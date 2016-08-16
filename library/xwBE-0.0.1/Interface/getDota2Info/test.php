<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/7/23
 * Time: 15:06
 */
require("../../connectDB.php");
require("../../all.php");

$a = new interfaceResponse();
$status = $reminder = 0;

@$b = file_get_contents("https://api.steampowered.com/IDOTA2Match_570/GetMatchHistory/v001/?key=77E69E31E10BC86B78CB6734A1C26F95&account_id=252556081");
if(!$b){
    $status = 0;
    $reminder = "dota2服务器崩溃";
    echo $a->normalnormalrespond($status,$reminder);
}else{
    echo $b;
}