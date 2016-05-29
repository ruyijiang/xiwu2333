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
?>
<?php


    $uid = $_SESSION["uid"];

    $commitname = $_POST["commitname"];
    @$score = $_POST["score"];
    @$extra = $_POST["extra"];

    $status = $reminder = 0;

    if($commitname == "inviteNew" || $commitname == "writeBlog" || $commitname == "Share" || $commitname == "openTeam" || $commitname == "makeComment" || $commitname == "onlineDuration"){
        if(!$score) $score = countScore($commitname,null);//得分

        $a = new liveness();
        $a->setLiveness($commitname,$score);

        $status = 1;
        $reminder = "";
        //缺少关键参数
    }else{
        $status = 0;
        $reminder = "缺少关键参数，或参数错误";
        //缺少关键参数
    }

    $b = new interfaceResponse();
    echo $b->normalrespond($status,$reminder);

?>
