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
    @$commitname = $_POST["duration"];

    $status = $reminder = 0;


    if($commitname){
        if(!$score) $score = countScore($commitname);//得分

        $a = new liveness();
        $a->setLiveness($commitname,$score);


    }else{
        $status = 0;
        $reminder = "缺少关键参数";
        //缺少关键参数
    }

?>
