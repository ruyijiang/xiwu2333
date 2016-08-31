<?php
/**
 * Created by PhpStorm.
 * User: milobluebell
 * Date: 16-8-31
 * Time: 下午1:54
 */
require("../../connectDB.php");
require("../../all.php");
?><?php

@$timing = $_GET["timing"];

$a = new interfaceResponse();
$status = 0;
$reminder = "";

if($timing){



}else{

    $status = 0;
    $reminder = "缺少关键参数，无法进行查询";
    echo $a->normalrespond($status,$reminder);

}