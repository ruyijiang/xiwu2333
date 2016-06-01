<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/5/10
 * Time: 16:30
 */
require("../all.php");
?>
<?
    $timing = $_POST["timing"];
    $a = new interfaceResponse();
    $status = $reminder = "";

    if($timing){

        @$uid = $_SESSION["uid"];
        @$unm = $_SESSION["username"];
        @$upw = $_SESSION["userpassword"];

        if($uid && $upw && $unm){
            //登陆了
            $status = 1;
            $reminder = "";
            echo $a->normalrespond($status,$reminder);
        }else{
            //没有登陆
            $status = 3;
            $reminder = "";
            echo $a->normalrespond($status,$reminder);
        }

    }else{
        $status = 0;
        $reminder = "异常错误，请联系管理员";
        echo $a->normalrespond($status,$reminder);
    }





?>
