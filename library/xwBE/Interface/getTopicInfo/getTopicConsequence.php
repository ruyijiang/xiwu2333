<?php
/**
 * Created by PhpStorm.
 * User: milobluebell
 * Date: 16-9-26
 * Time: 下午4:03
 */
require("../../connectDB.php");
require("../../all.php");
?><?php
header('Content-type: application/json');

@$uid = $_SESSION["uid"];//uid

$topic_id = $_GET["topic_id"];

$a = new _environment();
$tnow = $a->getTime();//当前datetime - iso时间
$tnow_stamp = time();//当前datetime - UNIX时间

$status = 0;
$reminder = "";
$a = new interfaceResponse();


if($topic_id){

    $sql = "SELECT `choices` FROM comments WHERE `topic_id` = '$topic_id' ";
    $qry = $db->query($sql);
    if($row_all = mysqli_num_rows($qry) > 0){
        $result_conArr = array();//最终结果

        while ($row = $qry->fetch_assoc()){

            $result_choices_arr = explode(";",$row["choices"]);//单选：2 //多选：0;0;1;1;0;0
            if(count($result_choices_arr) > 1){
                //是多选
                foreach ($result_choices_arr as $key => $value){
                    if($value !== 0 && $value !== false){
                        if(isset($result_conArr[$key+1])){
                            $result_conArr[$key+1]++;
                        }else{
                            $result_conArr[$key+1] = 1;
                        }
                    }
                }
            }else{
                //是单选
                if(isset($result_conArr[$value])){
                    $result_conArr[$value]++;
                }else{
                    $result_conArr[$value] = 1;
                }
            }

        }


    }else{
        //------------------------------------------------------------------------------------>没有搜索到结果
        $status = 0;
        $reminder = "没有搜索到任何结果";
        echo $a->normalrespond($status,$reminder);
    }

}else{
    //------------------------------------------------------------------------------------>缺少关键参数
    $status = 0;
    $reminder = "缺少关键参数，无法获取话题".$topic_id."的结果";
    echo $a->normalrespond($status,$reminder);
}