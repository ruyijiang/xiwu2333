<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/5/31
 * Time: 14:14
 */
require("../connectDB.php");
require("../all.php");
require("../algorithm/InvitationCode.php");
?>
<?php
    $status = $reminder = "";

    @$uid = $_SESSION["uid"];
    if(!empty($uid)){
        //是登陆了的用户在使用激活码，暂时不考虑
    }else{
        //是未登陆用户在使用激活码
        echo create_InCode();
    }
?>
