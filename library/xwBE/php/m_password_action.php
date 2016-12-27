<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/5/20
 * Time: 14:56
 */
require("../connectDB.php");
require("../all.php");
require_once("../Regulars.php");
?>
<?php

    @$uid = $_SESSION["uid"];
    @$password = $_SESSION["userpassword"];

    $status = $reminder = "";
    $a = new interfaceResponse();

    @$OldPassword = $_POST["OldPassword"];
    @$NewPassword = $_POST["NewPassword"];
    @$RepeatedPassword = $_POST["RepeatedPassword"];
    $b = preg_match( $Regular_Password, $NewPassword);


    @$OldPassword = md5($_POST["OldPassword"]);
    @$NewPassword = md5($_POST["NewPassword"]);
    @$RepeatedPassword = md5($_POST["RepeatedPassword"]);

    $sql = "SELECT password FROM users WHERE uid ='$uid' AND password = '$password' ";
    $qry = $db->query($sql);
    $row = $qry->fetch_assoc();
    $result = $row["password"];

if($OldPassword === $result){
    if($OldPassword !== $NewPassword){
        if($NewPassword === $RepeatedPassword){
            if($b){
                $sql = "UPDATE users SET password='$NewPassword' WHERE uid= '$uid' AND password = '$password' ";
                $qry = $db->query($sql);
                if($qry){
                    $status = 1;
                    $reminder = "密码修改成功";
                    echo $a->normalrespond($status, $reminder);
                    $_SESSION["userpassword"] = $NewPassword;
                    //------------------------------------------------------------------------------------------------->出口4，修改密码成功
                }else{
                    $status = 0;
                    $reminder = "密码更新失败，请联系管理员";
                    echo $a->normalrespond($status, $reminder);
                    //------------------------------------------------------------------------------------------------->出口3，插入数据库失败
                }
            }else{
                $status = 0;
                $reminder = "密码不合法，应仅包括6-24位数字、字母或下划线";
                echo $a->normalrespond($status, $reminder);
                //----------------------------------------------------------------------------------------------------->出口2，密码不合法
            }
        }else{
            $status = 0;
            $reminder = "重复输入密码错误";
            echo $a->normalrespond($status, $reminder);
            //--------------------------------------------------------------------------------------------------------->出口1，重复输入密码错误
        }
    }else{
        $status = 0;
        $reminder = "新密码与旧密码不能相同";
        echo $a->normalrespond($status, $reminder);
        //------------------------------------------------------------------------------------------------------------->出口5，新密码与旧密码相同
    }
}else{
    $status = 0;
    $reminder = "旧密码输入不正确";
    echo $a->normalrespond($status, $reminder);
    //----------------------------------------------------------------------------------------------------------------->出口6，旧密码输入不正确
}


?>