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
    $iccode = $_POST["iccode"];

    $a = new interfaceResponse();

    if(empty($iccode)){
        $status = 0;
        $reminder = "邀请码不得为空";
        echo $a->normalrespond($status,$reminder);
        //------------------------------------------------------------------------------------------------------------->出口1：邀请码为空
    }else{
        $sql = "SELECT iid FROM invitationcode WHERE guid = '$iccode' AND used != 0";
        $qry = $db->query($sql);
        @$row = $qry->fetch_assoc();
        @$result = $row["iid"];
        if(empty($result)){
            
            $status = 1;
            $reminder = "";
            echo $a->normalrespond($status,$reminder);
            //--------------------------------------------------------------------------------------------------------->出口2：邀请码可以使用
        }else{
            $status = 0;
            $reminder = "邀请码不存在或已被使用";
            echo $a->normalrespond($status,$reminder);
            //--------------------------------------------------------------------------------------------------------->出口3：邀请码不存在或已被使用
        }
    }
?>
