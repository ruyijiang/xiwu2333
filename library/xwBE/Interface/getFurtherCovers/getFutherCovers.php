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

if(!$timing){


    for($i=0;$i<7;$i++){

        $y = date("Y",strtotime("+".$i." day"));
        $m = date("m",strtotime("+".$i." day"));
        $d = date("d",strtotime("+".$i." day"));

        $todayTime= mktime(07,0,0,$m,$d,$y);

        $sql = "SELECT aid FROM `articles` WHERE   ";
        $qry = $db->query($sql);
        $row = $qry->fetch_assoc();


    }


    

}else{

    //--------------------------------------------------------------------------------->参数无法解析
    $status = 0;
    $reminder = "缺少关键参数，无法获取相应数据";
    echo $a->normalrespond($status,$reminder);
    return false;

}