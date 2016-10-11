<?php
/**
 * Created by PhpStorm.
 * User: milobluebell
 * Date: 16-8-30
 * Time: 上午9:16
 */
require("../../connectDB.php");
require("../../all.php");
?><?php

@$timing = $_GET["timing"];

$a = new interfaceResponse();
$status = 0;
$reminder = "";

if($timing){

    $EchoResult = array();

    $sql = "SELECT uid,avatar,name,calling_card_id FROM users WHERE identification = 1 AND calling_card_id <> '' ORDER BY regtime DESC LIMIT 12";
    $qry = $db->query($sql);
    $row_all = mysqli_num_rows($qry);
    if($row_all < 1){
        //一个认证用户都没有

        $sql = "SELECT uid,avatar,name,calling_card_id FROM users ORDER BY regtime DESC LIMIT 12";
        $qry = $db->query($sql);
        while($row = $qry->fetch_assoc()){

            $result_uid = $row["uid"];
            $result_avatar = $row["avatar"];
            $result_name = $row["name"];

            $dataArr = array('uid'=>$result_uid,'avatar'=>$result_avatar,'title'=>$result_name);
            foreach ( $dataArr as $key => $value ) {
                $dataArr[$key] = urlencode ($value);
            }

            array_push($EchoResult,$dataArr);

        }

        $EchoResult = urldecode ( json_encode ( $EchoResult ));
        echo $EchoResult;

    }else{
        //有认证用户

        $Num = $row_all;

        while($row = $qry->fetch_assoc()){

            $result_uid = $row["uid"];
            $result_avatar = $row["avatar"];
            $result_calling_card_id = $row["calling_card_id"];

            $sql2 = "SELECT content FROM callingcard WHERE ccid = '$result_calling_card_id' ";
            $qry2 = $db->query($sql2);
            $row2 = $qry2->fetch_assoc();
            $result_calling_card_name = $row2["content"];

            $dataArr = array('uid'=>$result_uid,'avatar'=>$result_avatar,'title'=>$result_calling_card_name);
            foreach ( $dataArr as $key => $value ) {
                $dataArr[$key] = urlencode ($value);
            }

            array_push($EchoResult,$dataArr);

        }


        $sql3 = "SELECT uid,avatar,name,calling_card_id FROM users ORDER BY regtime DESC LIMIT '$Num' ";
        $qry3 = $db->query($sql3);
        while($row3 = $qry3->fetch_assoc()){

            $result_uid = $row3["uid"];
            $result_avatar = $row3["avatar"];
            $result_name = $row3["name"];

            $dataArr = array('uid'=>$result_uid,'avatar'=>$result_avatar,'title'=>$result_name);
            foreach ( $dataArr as $key => $value ) {
                $dataArr[$key] = urlencode ($value);
            }

            array_push($EchoResult,$dataArr);

        }

        $EchoResult = urldecode ( json_encode ( $EchoResult ));
        echo $EchoResult;

    }

}else{

    $status = 0;
    $reminder = "缺少关键参数，无法进行查询";
    echo $a->normalrespond($status,$reminder);

}


