<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/5/26
 * Time: 18:43
 * 用户活跃度算法类
 */

function countScore($commitname){
    switch ($commitname){

        case "inviteNew":
            return 60;
            break;
        case "writeBlog":
            return 50;
            break;
        case "Share":
            return 40;
            break;
        case "onlineDuration":
            return 35;
            break;
        case "openTeam":
            return 25;
            break;
        case "makeComment":
            return 18;
            break;
        case "abc":
            return 18;
            break;

    }

}


?>
