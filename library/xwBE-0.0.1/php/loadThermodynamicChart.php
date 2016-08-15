<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/8/13
 * Time: 23:34
 */
require("../connectDB.php");
require("../all.php");
echo $timestamp = mktime(0, 0, 0, date('m'), date('d'), date('Y'))."</br>";
echo $tnow = date("Y-m-d H:i:s")."</br>";
echo $halfAnYearAgo = date("Y-m-d H:i:s",strtotime("-6 month"));