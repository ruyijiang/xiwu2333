<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/5/15
 * Time: 11:02
 * Target: 用户关闭页面时需要更新的数据
 */
require("../connectDB.php");
require("../all.php");
?>
<?

$timing = $_POST["timing"];
$mod = $_POST["mod"];
@$uid = $_SESSION["uid"];
$a = new interfaceResponse();

if($timing && isset($mod)){
    if($uid){
        //登陆了
        $sql = "UPDATE users SET onlinestatus = '$mod' WHERE uid = '$uid' ";
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