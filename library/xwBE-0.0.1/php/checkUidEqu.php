<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/6/17
 * Time: 19:37
 */
require("../connectDB.php");
require("../all.php");
?>
<?php
    $timing = $_GET["timing"];

    $a = new interfaceResponse();
    $status = $reminder = "";

    if($timing){
        echo $_SESSION["uid"];
    }else{
        $status = 0;
        $reminder = "缺少关键参数，查询失败";
        echo $a->normalrespond($status,$reminder);
    }
?>