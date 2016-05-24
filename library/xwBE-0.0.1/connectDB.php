<?php

include("all.inc.php");
/**连接数据库**/
$db = new mysqli($DB,$DBUSER,$DBPASSWORD,$DBNAME);
$db -> query("SET NAMES UTF8");
if(mysqli_connect_errno()){
echo "#A001，数据库链接或选择失败，请联系客服人员或者网站管理员";
exit;
}//检测数据库是否正确

?>