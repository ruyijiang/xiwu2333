<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/5/15
 * Time: 11:02
 * Target: 用户
 */

$timing = $_POST["timing"];
$uid = $_SESSION["uid"];

if($timing){
    if($uid){
        //登陆了
        $sql = "UPDATE users SET onlinestatus = '0'  WHERE uid = '$uid' ";
        $qry = $db->query($sql);
        if($qry){
            $status = 1;
            $reminder = "";
            echo $a->normalrespond($status,$reminder);
        }else{
            $status = 0;
            $reminder = "检测您的账号存在数据异常，此次退出可能无法停止开放组队，您确定要离开吗？";
            echo $a->normalrespond($status,$reminder);
            return ;
        }
    }else{
        //没有登陆
        $status = 0;
        $reminder = "检测您的账号存在数据异常，此次退出可能无法停止开放组队，您确定要离开吗？";
        echo $a->normalrespond($status,$reminder);
    }
}