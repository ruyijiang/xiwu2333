<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/5/14
 * Time: 8:23
 */
require("../connectDB.php");
require("../all.php");
require("../algorithm/Liveness.php");
//仅负责开放组队时计算活跃度
?>
<?php
    $operation = $_POST["timing"];
    $status = $reminder = 0;
    $b = new interfaceResponse();
    if($operation){
        $a = new queue();
        @$c = $_SESSION["openstatus"];
        if($c && $c == "1"){//当前已经在开放组队
            $a->disablesearching();
            $status = 0;
            $reminder = "停止开放组队";
            $b->normalrespond($status,$reminder);
        }else{//当前没有正在开放组队
            $a->searching();
            $status = 0;
            $reminder = "开放组队";
            $b->normalrespond($status,$reminder);

            //加活跃度
            $thisScore = countScore('openTeam');
            $c = new liveness();
            if($c->setLiveness('openTeam',$thisScore)){
                $status = 1;
                $reminder = "";
            }else{
                $status = 0;
                $reminder = "数据库插入失败";
            }
            $b->normalrespond($status,$reminder);
        }
    }else{
        $status = 0;
        $reminder = "开放组队失败，可能的原因是没有发送请求头，请联系管理员";
        $b->normalrespond($status,$reminder);
    }
?>
