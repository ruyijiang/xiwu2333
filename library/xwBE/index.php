<?php
include("all.inc.php");
/**�������ݿ�**/
$db = new mysqli($DB,$DBUSER,$DBPASSWORD,$DBNAME);
$db -> query("SET NAMES UTF8");
if(mysqli_connect_errno()){
echo "#A001�����ݿ����ӻ�ѡ��ʧ�ܣ�����ϵ�ͷ���Ա������վ����Ա";
exit;
}//������ݿ��Ƿ���ȷ

?>