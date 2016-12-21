<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/9/18
 * Time: 10:29
 */

function create_TopicId(){
    $aidstr = "";

    $numbers = range (10,99);
    shuffle ($numbers);//将10-99的数组打乱
    $startnum = rand(0,84);//随机开始位置
    $lengthnum=5;//截取长度
    $result = array_slice($numbers,$startnum,$lengthnum);//['07','45','22','78']
    foreach ($result as $xa){
        $aidstr .= $xa;
    }

    return "TOP_".$aidstr;
}

?>