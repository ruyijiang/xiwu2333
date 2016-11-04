<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/11/4
 * Time: 22:41
 */
require("../../connectDB.php");
require("../../all.php");
?>
<?
@$uid = $_SESSION["uid"];//uid
$funcType = $_GET["funcType"];//邀请码的功能分类
/**
 * funcType类型 ********
 * 1，WriteCovers   | 书写covers
 * 2，Administrator | 管理员
 */


$a = new _environment();
$tnow = $a->getTime();//当前datetime - iso时间
$tnow_stamp = time();//当前datetime - UNIX时间

$status = 0;
$reminder = "";
$a = new interfaceResponse();

if($uid && $funcType){

        $sql = "SELECT iccode FROM `invitationcode` WHERE funcType = '$funcType' AND activated_uid = '$uid' AND isActivated = '1' ";
        $qry = $db->query($sql);
        if(mysqli_num_rows($qry) > 0){
            //------------------------------------------------------------------------------------>缺少关键参数，无法正确执行
            $rows = $qry->fetch_assoc();
            $status = $rows["iccode"];
            $reminder = "该用户激活了对应功能的邀请码";
            echo $a->normalrespond($status,$reminder);
        }

}else{
    //------------------------------------------------------------------------------------>缺少关键参数，无法正确执行
    $status = 0;
    $reminder = "缺少关键参数，无法正确执行";
    echo $a->normalrespond($status,$reminder);
}