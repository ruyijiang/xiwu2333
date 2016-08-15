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
$a = file_get_contents("https://api.steampowered.com/IDOTA2Match_570/GetMatchHistory/v001/?key=77E69E31E10BC86B78CB6734A1C26F95&steamids=76561198253477944");
echo $a;