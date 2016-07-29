<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/7/23
 * Time: 15:06
 */
require("../../connectDB.php");
require("../../all.php");
?><?php
header('Content-type: application/json');

$content = $_GET["content"];
$startnum = $_GET["startnum"];

$a = new interfaceResponse();
$status = $reminder = 0;

if(!empty($content) || !empty($startnum)){



    $mm = new Dota2Api\Mappers\MatchMapperWeb($content);
    $match = $mm->load();
    $result = $match->getDataArray();

    if($result["match_id"] !== null){
        $slots = $match->getAllSlots();
        $slot_info = array();
        foreach($slots as $slot) {
            $hero_id = $slot->get("hero_id");
            $sql = "SELECT name FROM `info_dota2`.`heros` WHERE hero_id = '$hero_id' ";
            @$qry = $db->query($sql);
            if(!$qry){
                array_push($slot_info,$slot->get("hero_id"));
            }else{
                $row = $db->fetch_assoc($qry);
                $hero_name = $row["name"];
                array_push($slot_info,$hero_name);
            }
        }
        $result["slot_info"] = $slot_info;


        /*************************
         ****** 翻译数组内容：******
         ************************/
        //1，翻译所在服务器：
        switch ($result["cluster"]){
            case "223":
                $result["cluster"] = "电信（浙江）";
                break;
            case "224":
                $result["cluster"] = "电信（上海）";
                break;
            case "225":
                $result["cluster"] = "电信（广东）";
                break;
            case "227":
                $result["cluster"] = "电信（华中）";
                break;
            case "231":
                $result["cluster"] = "联通1";
                break;
        }
        //2，翻译开始时间：
        $a = new _environment();
        $tnow = strtotime($a->getTime());
        if($tnow - strtotime($result["start_time"]) <= 24*60*60 && $tnow - strtotime($result["start_time"]) >= 1*60*60){
            //一天之内
            $minus = $tnow - strtotime($result["start_time"]);
            $result["start_time"] = "约".round($minus / 3600,0)."小时前";
        }else if($minus = $tnow - strtotime($result["start_time"]) < 1*60*60){
            $result["start_time"] = "约".(round($minus / 3600,1)*60)."分钟前";
        }
        //3，翻译持续时间：
        $result["duration"] = floor($result["duration"] / 60) . "分钟";// . $result["duration"]%60 . "秒";
        /*******************End of 翻译****************/
        /*********************************************/


        //输出json对象
        echo(json_encode($result));


        //把搜索结果记入数据库，并添加分类
        insertIntoDatabase("搜索比赛",$content,1);

    }else{
        insertIntoDatabase("搜索比赛",$content,0);
        $status = 0;
        $reminder = "没有找到以'".$content."'为编号的比赛数据";
        echo $a->normalrespond($status,$reminder);
    }



}else{
    $status = 0;
    $reminder = "缺少关键参数";
    echo $a->normalrespond($status,$reminder);
}




/**把搜索内容写入数据库**/
function insertIntoDatabase($ClassPri,$content,$isAvailable){
    require("../../connectDB.php");

    $a = new _environment();
    $tnow = $a->getTime();
    $b = new interfaceResponse();

    /**先检测该关键词是否已经存在于数据库了**/
    $sql = "SELECT times,searid FROM searchings WHERE content='$content' AND classification = '$ClassPri' AND isAvailable = '$isAvailable'";
    $qry = $db->query($sql);
    $row_all = mysqli_num_rows($qry);
    if($row_all>0){
        //content已经在数据库里存在了 -> 执行Update
        $row = $qry->fetch_assoc();
        $Otimes = (int)$row["times"];
        $Osearid = $row["searid"];
        $Otimes += 1;
        $sql2 = "UPDATE searchings SET times = '$Otimes',lasttime = '$tnow' WHERE searid = '$Osearid' ";
        $qry2 = $db->query($sql2);
        if($qry2){
            //----------------------------------------------------------------------------------------------------->出口1，更新搜索数据库完毕
            return true;
        }else{
            //----------------------------------------------------------------------------------------------------->出口2，更新搜索数据库失败
            return false;
        }
    }else{
        //content没在数据库里存在 -> 执行Insert
        $sql2 = "INSERT INTO searchings(searid,content,times,regtime,lasttime,classification,isAvailable,remark) VALUES ('','$content','1','$tnow','$tnow','$ClassPri','$isAvailable','none')";
        $qry2 = $db->query($sql2);
        if($qry2){
            //----------------------------------------------------------------------------------------------------->出口1，更新搜索数据库完毕
            return true;
        }else{
            //----------------------------------------------------------------------------------------------------->出口2，更新搜索数据库失败
            return false;
        }
    }
}