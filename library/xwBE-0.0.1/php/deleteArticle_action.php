<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/7/7
 * Time: 22:45
 */
require("../connectDB.php");
require("../all.php");
?><?
    @$uid = $_SESSION["uid"];

    $status = $reminder = "";
    $a = new interfaceResponse();

    @$aid = $_GET["aid"];

    if(!empty($aid)){

        $sql = "DELETE FROM `xiwu2333.com`.`articles` WHERE `articles`.`aid` = '$aid' AND `articles`.`uid` = '$uid' ";
        $qry = $db->query($sql);
        $qry = true;
        if($qry){
            $status = 1;
            $reminder = "删除成功";
            echo $a->normalrespond($status,$reminder);
            return true;
        }else{
            $status = 0;
            $reminder = "";
            echo $a->normalrespond($status,$reminder);
            return false;
        }

    }else{
        $status = 0;
        $reminder = "缺少aid的关键参数";
        echo $a->normalrespond($status,$reminder);
        return false;
    }
?>