<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/12/28
 * Time: 23:24
 */
require("../../connectDB.php");
require("../../all.php");
?><?php
@$uid = $_SESSION["uid"];//uid
$timing = $_GET["timing"];

$status = 0;
$reminder = "";
$a = new interfaceResponse();

if($timing){

    $EchoResult = array();
    $dataArr = array();
    $dateArr = array();
    $x = $y = 0;

    for($i=1;$i<=10;$i++){

        $y = date("Y",strtotime("+".$i." day"));
        $m = date("m",strtotime("+".$i." day"));
        $d = date("d",strtotime("+".$i." day"));

        $TheDayStartTime = mktime(07,0,0,$m,$d,$y);
        $TheDayEndTime = $TheDayStartTime + 86400;

        $sql = "SELECT cover_id FROM `covers` WHERE post_time <= '$TheDayStartTime' && unpost_time >= '$TheDayStartTime' ";
        $qry = $db->query($sql);
        $y = $row_all = mysqli_num_rows($qry);

        if($row_all >= $x){
            $x = $row_all;
        }

        array_push($dataArr,$row_all);
        array_push($dateArr,$d."日");

    }

    $EchoResult["FurtherCoversAmountArr"] = $dataArr;
    $EchoResult["FurtherDateArr"] = $dateArr;
    $EchoResult["LargestNum"] = $x;

    $EchoResult = urldecode ( json_encode ( $EchoResult ));
    echo $EchoResult;

}else{

    //--------------------------------------------------------------------------------->参数无法解析
    $status = 0;
    $reminder = "缺少关键参数，无法获取相应数据";
    echo $a->normalrespond($status,$reminder);
    return false;

}