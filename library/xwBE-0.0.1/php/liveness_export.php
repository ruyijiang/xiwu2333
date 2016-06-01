<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/6/1
 * Time: 21:01
 */
require("../connectDB.php");
require("../all.php");
?>
<?php
    $status = $reminder = 0;

    $uid = $_POST["uid"];//必填
    @$timestart = $_POST["timestart"];//选填
    @$timeend = $_POST["timeend"];//选填

    $a = new interfaceResponse();
    $b = new liveness();

    if($uid){
        if(!isset($timestart) || !isset($timeend)){
            //使用默认请求时间，默认是从今天开始往前15天这段时间
            $timestart = strtotime(date("Y-m-d",strtotime("-14 day")));
            $timeend = strtotime(date("Y-m-d"));
        }
        $b->getLiveness($uid,$timestart,$timeend);

    }else{
        $status = 0;
        $reminder = "缺少关键参数，请求数据失败";
        echo $a->normalrespond($status,$reminder);
        //------------------------------------------------------------------------------------------------------------->出口2，缺少关键参数，请求数据失败
    }



?>
