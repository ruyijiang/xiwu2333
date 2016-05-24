<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/5/5
 * Time: 12:36
 */
require("../connectDB.php");
require("../all.php");
?>
<?

    $room_name = $_POST["room_name"];
    @$owner_say = $_POST["owner_say"];
    $open_strategy = $_POST["open_strategy"];
    $room_password = $_POST["room_password"];
    @$pw_reminder = $_POST["pw_reminder"];
    @$server = $_POST["server"];
    $personlimit = $_POST["personlimit"];
    @$ladderscore = $_POST["tt"];
    @$winningrate = $_POST["winningrate"];
    @$score = $_POST["score"];
    @$blacklist = $_POST["blacklist"];
    @$tags = $_POST["tags"];

    if(!$ladderscore){$ladderscore = "";}
    else if(!$winningrate){$winningrate = "";}
    else if(!$score){$score = "";}
    else if(!$blacklist){$blacklist = "";}
    else if(!$tags){$tags = "";}
    else if(!$owner_say){$owner_say = "";}
    else if(!$pw_reminder){$pw_reminder = "";}
    //etc,//
    $uid = $_SESSION["uid"];
    $d = new _environment();
    $d = $d->getTime();



    //因为每个用户只允许创建一个房主属于自己的房间，因此根据UID是否有对应的房间记录，来判断是新创房间还是修改后发布房间
    @$uid = $_SESSION["uid"];
    $sql = "SELECT rid FROM rooms WHERE creator = '$uid' ";
    $qry = $db->query($sql);
    $row = $qry->fetch_assoc();
    $result_rid = $row["rid"];
    $status = $reminder = '';

    if(empty($result_rid) || !isset($result_rid)){
        //不存在此房间。说明是首次创建，使用insertSQL
        //创建房间信息
        $sql1 = "INSERT INTO rooms(rid,name,owner_say,open_strategy,password,pw_reminder,server,personlimit,tags,creator,regtime,lasttime,onlinestatus) VALUES ('','$room_name','$owner_say','$open_strategy','$room_password','$pw_reminder','$server','$personlimit','$tags','$uid','$d','$d','1')";
        $qry1 = $db->query($sql1);

        //创建筛选信息
        //ps,新建房间时候，筛选信息应该是第二步，因为没有房间则不会产生筛选信息，且没有rid，也无法进行对应
        //ps,而更新房间信息，则无所谓先后顺序
        $sql3 = "SELECT rid FROM rooms WHERE creator = '$uid' ";
        $qry3 = $db->query($sql3);
        $row3 = $qry3->fetch_assoc();
        $result3_rid = $row3["rid"];

        $sql2 = "INSERT INTO permissions(pms_id,rid,ladderscore,winningrate,score,blacklist,regtime,lasttime) VALUES ('','$result3_rid','$ladderscore','$winningrate','$score','$blacklist','$d','$d')";
        $qry2 = $db->query($sql2);

        $sql4 = "SELECT pms_id FROM permissions WHERE rid = '$result3_rid' ";
        $qry4 = $db -> query($sql4);
        $row4 = $qry4 -> fetch_assoc();
        $result4_pms_id = $row4["pms_id"];

        $sql4 = "UPDATE rooms SET permission = '$result4_pms_id' WHERE rid = '$result3_rid' ";//这里如果有错，就不报了
        $qry4 = $db->query($sql4);
        if($qry1 && $qry2){
            $status = 1;
            $reminder = "成功发布此房间";
            $a = new interfaceResponse();
            echo $a->normalrespond($status,$reminder);
            //写入一些session和cookie
            $_SESSION["rid"] = $result3_rid;
            setcookie("rid", $result3_rid, time()+1*24*60*60);
            //------------------------------------------------------------------------------------------------------------>出口1，成功发布此房间
        }else if($qry1 && !$qry2){
            $status = 0;
            $reminder = "更新筛选信息错误，房间准入条件不生效。请联系管理员";
            $a = new interfaceResponse();
            echo $a->normalrespond($status,$reminder);
            //------------------------------------------------------------------------------------------------------------>出口2，更新筛选信息错误
        }else{
            $status = 0;
            $reminder = "发布房间失败，请联系管理员";
            $a = new interfaceResponse();
            echo $a->normalrespond($status,$reminder);
            //------------------------------------------------------------------------------------------------------------>出口3，发布房间失败
        }

    }else if($result_rid){
        //说明是修改发布，使用updateSQL
        //更新筛选信息
        $sql2 = "UPDATE permissions SET ladderscore = '$ladderscore',winningrate = '$winningrate',score = '$score',blacklist = '$blacklist',lasttime = '$d' WHERE rid = '$result_rid' ";
        $qry2 = $db->query($sql2);
        //更新房间信息
        $sql1 = "UPDATE rooms SET name ='$room_name',owner_say = '$owner_say',open_strategy='$open_strategy',password='$room_password',pw_reminder='$pw_reminder',server='$server',personlimit='$personlimit',tags = '$tags',lasttime = '$d',onlinestatus='1' WHERE rid = '$result_rid' ";
        $qry1 = $db->query($sql1);
        if($qry1 && $qry2){
            $status = 1;
            $reminder = "成功修改发布此房间";
            $a = new interfaceResponse();
            echo $a->normalrespond($status,$reminder);
            //写入一些session和cookie
            $_SESSION["rid"] = $result_rid;
            setcookie("rid", $result_rid, time()+1*24*60*60);
            //------------------------------------------------------------------------------------------------------------>出口4，成功修改发布此房间
        }else if($qry1 && !$qry2){
            $status = 0;
            $reminder = "更新筛选信息错误，房间准入条件不生效，请联系管理员2";
            $a = new interfaceResponse();
            echo $a->normalrespond($status,$reminder);
            //------------------------------------------------------------------------------------------------------------>出口5，更新筛选信息错误
        }else{
            $status = 0;
            $reminder = "修改房间发布失败，请联系管理员";
            $a = new interfaceResponse();
            echo $a->normalrespond($status,$reminder);
            //------------------------------------------------------------------------------------------------------------>出口6，修改房间发布失败
        }
        $b = new UserRecord();
        $b -> createUserRecordFile();
        if($status == 1){
            $b->recordUserVisit("发布房间成功");
        }else{
            $b->recordUserVisit("房间发布失败，原因是：".$reminder);
            return false;
        }
    }



?>