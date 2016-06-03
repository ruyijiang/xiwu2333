<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/5/10
 * Time: 19:42
 * Function: 数据展示
 */
require("../connectDB.php");
require("../all.php");
?>
<?php
    $dateHeader = $_POST["timing"];
    $mod = $_POST["mod"];
    $a = new UserData();
    if(!empty($dateHeader)){
        if($mod == "getHighestLocation"){
            echo $a->getHighestLocation();
        }else if($mod == "getOnlineUsersAmount"){
            echo $a->getOnlineUsersAmount();
        }else if($mod == "getSexualRates"){
            echo $a->getSexualRates();
        }else{
            echo "没有选择mod模式，无法返回数据。请联系管理员";
        }

    }else{
        $status = 0;
        $reminder = "请求数据失败，可能的原因是没有发送请求头，请联系管理员";
        $a = new interfaceResponse();
        echo $a->normalrespond($status,$reminder);
    }
?>
