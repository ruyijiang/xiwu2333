<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/7/26
 * Time: 19:34
 */
require("../../connectDB.php");
require("../../all.php");
?><?php
header('Content-type: application/json');
$a = file_get_contents("Database/heros.json");
echo $a;