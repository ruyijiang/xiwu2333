<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/5/28
 * Time: 21:37
 */
require("../connectDB.php");
require("../all.php");
require("../algorithm/Liveness.php");
//仅负责关闭页面时计算活跃度
?>
<?php

    $uid = $_SESSION["uid"];

    $commitname = $_POST["commitname"];
    @$extra = $_POST["extra"];
    @$score = $_POST["score"];//手动指定得分

    $status = $reminder = 0;

    if($commitname == "inviteNew" || $commitname == "writeBlog" || $commitname == "Share" || $commitname == "openTeam" || $commitname == "makeComment" || $commitname == "onlineDuration"){
        if(!$score) $score = countScore($commitname,$extra);//得分

        $a = new liveness();

        if($a->setLiveness($commitname,$score)){
            $status = 1;
            $reminder = "";
        }else{
            $status = 0;
            $reminder = "数据库插入失败";
        }
    }else{
        $status = 0;
        $reminder = "缺少关键参数，或参数错误";
        //缺少关键参数
    }

    $b = new interfaceResponse();
    echo $b->normalrespond($status,$reminder);

?>
