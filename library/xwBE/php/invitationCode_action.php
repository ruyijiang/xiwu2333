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
    @$iccode = $_GET["iccode"];
    $tnow = date('Y-m-d H:i:s');

    $a = new interfaceResponse();

    if(empty($iccode)){
        $status = 0;
        $reminder = "邀请码不得为空";
        echo $a->normalrespond($status,$reminder);
        //------------------------------------------------------------------------------------------------------------->出口1：邀请码为空
    }else{
        if(preg_match("/^[0-9A-Z]{8}-[0-9A-Z]{4}-[0-9A-Z]{4}-[0-9A-Z]{4}-[0-9A-Z]{6}$/",$iccode)){
            $sql = "SELECT icid FROM `invitationcode` WHERE iccode = '$iccode' AND isActivated = '0' ";
            $qry = $db->query($sql);
            @$row = $qry->fetch_assoc();
            @$result_icid = $row["icid"];
            if(!empty($result_icid)){
                //激活码正确，执行后续操作
                $sql2 = "UPDATE `invitationcode` SET activated_uid = '$uid',isActivated = '1',activationTime = '$tnow' WHERE icid = '$result_icid' ";
                $qry2 = $db->query($sql2);
                if($qry2){
                    $status = 1;
                    $reminder = "激活成功";
                    echo $a->normalrespond($status,$reminder);
                }else{
                    $status = 0;
                    $reminder = "激活成功,但是激活码的数据更新失败";
                    echo $a->normalrespond($status,$reminder);
                }
                //--------------------------------------------------------------------------------------------------------->出口2：邀请码可以使用
            }else{
                $status = 0;
                $reminder = "邀请码不存在或已被使用";
                echo $a->normalrespond($status,$reminder);
                //--------------------------------------------------------------------------------------------------------->出口3：邀请码不存在或已被使用
            }
        }else{
            $status = 0;
            $reminder = "邀请码格式错误，请重新输入";
            echo $a->normalrespond($status,$reminder);
            //--------------------------------------------------------------------------------------------------------->出口4：邀请码格式错误
        }
    }
?>
