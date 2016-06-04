<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/6/5
 * Time: 0:28
 */
require("../connectDB.php");
require("../all.php");
?>
<?php
    $uid = $_SESSION["uid"];
    @$page_num = $_POST["page_num"];

    $status = $reminder = 0;
    $a = new interfaceResponse();

    if($page_num){
        $sql = "UPDATE users SET page_num = '$page_num' ";
        $qry = $db->query($sql);
        if($qry){
            $status = 1;
            $reminder = "";
            echo $a->normalrespond($status,$reminder);
        }else{
            $status = 0;
            $reminder = "数据库异常造成的更新失败，请联系管理员";
            echo $a->normalrespond($status,$reminder);
        }
    }else{
        $status = 0;
        $reminder = "缺少关键参数";
        echo $a->normalrespond($status,$reminder);
        //------------------------------------------------------------------------------------------------------------->出口1：缺少关键参数
    }
?>
