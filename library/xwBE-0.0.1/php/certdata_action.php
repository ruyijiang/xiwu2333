<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/5/18
 * Time: 22:06
 */
require("../connectDB.php");
require("../all.php");
?>
<?php
    $key = $_POST["key"];
    $value = $_POST["value"];

    $uid = $_SESSION["uid"];
    $password = $_SESSION["userpassword"];

    $a =  new interfaceResponse();
    $status = $reminder = "";
    $Repeated = 1;


/**
 * 先检验是否输入的内容是否已经存在
 */
    $sql = "SELECT uid FROM users WHERE `$key` = '$value' ";
    @$qry = $db->query($sql);
    @$row = $qry->fetch_assoc();
    @$result = $row["uid"];
    if($result)$Repeated = 1;else $Repeated = 0;

/**
 * 当不重复时，再执行更新数据库的操作
 */
    if(!$Repeated){

        $sql = "UPDATE users SET `$key` = '$value' WHERE uid = '$uid' AND password = '$password' ";
        $qry = $db->query($sql);
        if($qry){
            $status = 1;
            $reminder = "";
            echo $a->normalrespond($status,$reminder);
            //--------------------------------------------------------------------------------------------------------->出口1：实名信息更新成功
        }else{
            $status = 0;
            $reminder = "实名认证信息更新失败";
            echo $a->normalrespond($status,$reminder);
            //--------------------------------------------------------------------------------------------------------->出口2：实名信息更新失败
        }
    }else{
        $status = 0;
        $reminder = "填写的内容已经绑定其它账号";
        echo $a->normalrespond($status,$reminder);
        //-------------------------------------------------------------------------------------------------------------->出口3：填写的内容已经绑定其它账号
    }
?>
