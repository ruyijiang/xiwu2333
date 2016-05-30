<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/5/30
 * Time: 21:22
 */
require("../all.php");
?>
<?php
    $timing = $_POST["timing"];

    $status = $reminder = "";

    $a = new interfaceResponse();

    if($timing){
        $b = new _environment();
        echo $b->getDate();
    }else{
        $status = 0;
        $reminder = "缺少请求数据头，请重新获取";
        echo $a->normalrespond($status,$reminder);
    }
?>
