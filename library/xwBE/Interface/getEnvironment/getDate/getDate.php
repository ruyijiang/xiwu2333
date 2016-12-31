<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/12/30
 * Time: 14:47
 */
require("../../../connectDB.php");
require("../../../all.php");
?>
<?php
$timing = $_GET["timing"];

$a = new interfaceResponse();
$status = $reminder = 0;

if($timing){

    $EchoResult = array();

    $EchoResult["today_year"] = date("Y");
    $EchoResult["today_month"] = date("m");
    $EchoResult["today_date"] = date("d");

    $EchoResult["tomorrow_year"] = date("Y",strtotime("+1 day"));
    $EchoResult["tomorrow_month"] = date("m",strtotime("+1 day"));
    $EchoResult["tomorrow_date"] = date("d",strtotime("+1 day"));

    $EchoResult["yesterday_year"] = date("Y",strtotime("-1 day"));
    $EchoResult["yesterday_month"] = date("m",strtotime("-1 day"));
    $EchoResult["yesterday_date"] = date("d",strtotime("-1 day"));

    echo (json_encode($EchoResult));

}else{

    //--------------------------------------------------------------------------------->缺少关键参数
    $status = 0;
    $reminder = "缺少关键参数，请输入参数后查询";
    echo $a->normalrespond($status,$reminder);
    return false;

}