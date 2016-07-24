<?php
/**设置时区为中国**/
date_default_timezone_set('PRC');


/**设置编码为UTF8**/
header("Content-Type:text/html;charset:utf-8");


/**自定义全局变量**/
$DB = "localhost";
$DBUSER = "user";
$DBPASSWORD = "TmMd5Bd7GsXNxmuP";
$DBNAME = "xiwu2333.com";
$Dota2Info_DB = "info_dota2";
$STEAM_APIKEY = "77E69E31E10BC86B78CB6734A1C26F95";


/**初始Dota2 - Api**/
require_once("vendor/autoload.php");
use Dota2Api\Api;
Api::init($STEAM_APIKEY, array($DB, $DBUSER, $DBPASSWORD, $Dota2Info_DB, 'd2i_'));


