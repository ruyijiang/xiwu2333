<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/5/30
 * Time: 9:41
 * 生成8-9位不重复随机数，用于当作用户uid
 * 1,由10-99随机排序成一个数组 2,从这个数组里的随机位置开始截取4个数组元素
 */
?>
<?php

    function create_Uid(){
        $uidstr = "";

        $numbers = range (10,99);
        shuffle ($numbers);//将10-99的数组打乱
        $startnum = rand(0,85);//随机开始位置
        $lengthnum=4;//截取长度
        $result = array_slice($numbers,$startnum,$lengthnum);//['07','45','22','78']
        foreach ($result as $xa){
            $uidstr .= $xa;
        }

        return $uidstr;
    }

?>
