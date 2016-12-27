<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/11/4
 * Time: 23:13
 */
require("../../connectDB.php");
require("../../all.php");
?>
<?
@$uid = $_SESSION["uid"];//uid
$iccode = $_GET["iccode"];//邀请码的功能分类

$a = new _environment();
$tnow = $a->getTime();//当前datetime - iso时间
$tnow_stamp = time();//当前datetime - UNIX时间

$status = 0;
$reminder = "";
$a = new interfaceResponse();

if($uid && $iccode){

    $sql = "SELECT icid FROM `invitationcode` WHERE iccode = '$iccode' AND isActivated = '1' ";
    $qry = $db->query($sql);
    if(mysqli_num_rows($qry) > 0){
        //------------------------------------------------------------------------------------>该邀请码已经被激活了
        $status = 0;
        $reminder = "该邀请码已经被激活了";
        echo $a->normalrespond($status,$reminder);
    }else{
        $sql2 = "SELECT icid FROM `invitationcode` WHERE iccode = '$iccode' AND isActivated = '0' ";
        $qry2 = $db->query($sql2);
        if(mysqli_num_rows($qry) > 0){
            //存在对应的未激活邀请码

            $sql = "UPDATE `invitationcode` SET `activated_uid` = '$uid',`isActivated` = '1',`activationTime` = '$tnow_stamp' WHERE uid = '$uid' ";
            $qry = $db->query($sql);
            if($qry){
                //------------------------------------------------------------------------------------>邀请码激活成功---@@@
                $status = 1;
                $reminder = "邀请码激活成功";
                echo $a->normalrespond($status,$reminder);
            }else{
                //------------------------------------------------------------------------------------>不明原因导致邀请码激活失败
                $status = 0;
                $reminder = "不明原因导致邀请码激活失败";
                echo $a->normalrespond($status,$reminder);
            }

        }else{
            //-------------------------------------------------------------------------------->没有找到对应的未激活的邀请码
            $status = 0;
            $reminder = "没有找到对应的未激活邀请码";
            echo $a->normalrespond($status,$reminder);
        }
    }

}else{
    //------------------------------------------------------------------------------------>缺少关键参数，无法正确执行
    $status = 0;
    $reminder = "缺少关键参数，无法正确执行";
    echo $a->normalrespond($status,$reminder);
}