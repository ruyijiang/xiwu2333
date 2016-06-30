<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/5/5
 * Time: 12:38
 */
require("../connectDB.php");
require("../all.php");
?>
<?php
    $responsecontent = $_GET["responsecontent"];
    $num_onepage = $_GET["num_onepage"];
    $num_onepage = (int)$num_onepage;//每页显示数量
    $now_page = empty($_GET['now_page'])?1:$_GET['now_page'];

    //userlist.modal左侧微导航需要的检索条件
    @$gender = $_GET["gender"];
    @$serverArr = $_GET["server"];
    @$level = $_GET["skilllevel"];
    $sql_add = "";
    if($gender){
        $sql_add .= "gender = '$gender'" . "AND ";
        $no1 = true;
    }
    if($serverArr){//$serverArr = "电信（上海），电信（广东），"
        $sql_add .= "serverDist = '$gender'";
        @$no1==true?$sql_add.="AND "."serverDist = '$gender'":$sql_add;
        $no2==true;
    }
    if($level){
        $sql_add .= "skillDist = '$level'" . "AND ";
        @$no1==true?$sql_add.="AND "."skillDist = '$gender'":$sql_add;
        @$no2==true?$sql_add.="AND "."skillDist = '$gender'":$sql_add;
    }
    if(!$gender&&!$serverArr&&!$level){
        $sql = "SELECT uid FROM users WHERE openstatus = '1' AND onlinestatus = '1' ";
    }else{
        $sql = "SELECT uid FROM users WHERE ".$sql_add;
    }


    if($responsecontent == "userlist"){

        $qry = $db->query($sql);
        $row_all = mysqli_num_rows($qry);//总条数
        $page_num = ceil($row_all/$num_onepage);//分页数
        $now_page = (int)$now_page;//当前页数
        $limit_st = ($now_page-1)*$num_onepage;//起始数

        $sql2 = "SELECT * FROM users WHERE openstatus = '1' AND onlinestatus = '1' LIMIT $limit_st,$num_onepage ";
        $qry2 = $db->query($sql2);
        $user_countnum = 0;//输出的用户数量
        while($row = mysqli_fetch_array($qry2)){
            $uid = $row["uid"];
            $dota2_uid = $row["dota2_uid"];
            $name = $row["name"];
            $gender = $row["gender"];
            $skilledposition = $row["skilledposition"];
            $damage = $row["damage"];
            $kda = $row["kda"];
            $score = $row["score"];
            $dataArr = array ('uid'=>$uid,'dota2_uid'=>$dota2_uid,'name'=>$name,'gender'=>$gender,'skilledposition'=>$skilledposition,'damage'=>$damage,'kda'=>$kda,'score'=>$score);

            foreach ( $dataArr as $key => $value ) {
                $dataArr[$key] = urlencode ($value);
            }

            $dataArr = urldecode ( json_encode ( $dataArr ) . ",");
            echo $dataArr;
            $user_countnum++;
        }




    }/*else{

    }*/

?>
