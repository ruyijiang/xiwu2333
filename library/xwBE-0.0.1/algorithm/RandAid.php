<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/6/14
 * Time: 15:59
 */
?>
<?php

function create_Aid(){
    $aidstr = "";

    $numbers = range (10,99);
    shuffle ($numbers);//将10-99的数组打乱
    $startnum = rand(0,84);//随机开始位置
    $lengthnum=5;//截取长度
    $result = array_slice($numbers,$startnum,$lengthnum);//['07','45','22','78']
    foreach ($result as $xa){
        $aidstr .= $xa;
    }

    return "ART_".$aidstr;
}

?>