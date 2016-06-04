<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/6/2
 * Time: 14:52
 */
require("../connectDB.php");
require("../all.php");
require("../algorithm/AbstractofArticle.php");
?>
<?php
    $status = $reminder = 0;
    @$uid = $_POST["uid"];
    if(!$uid) $uid = $_SESSION["uid"];

    $sql = "SELECT title,time,content FROM articles WHERE uid = '$uid' ";
    $qry = $db->query($sql);
    while($row = $qry->fetch_assoc()){
        $result_title = $row["title"];
        $result_time = date('Y-m-d H:i', strtotime($row["time"]));


        $tnow = strtotime(date("Y:m:d h:i:s"));
        $result_time2 = strtotime($result_time);
        $gap = $tnow - $result_time2;
        $gap = 58680;
        if($gap < 60*60){
            //1小时以内
            $result_time = round($gap/60)."分钟 前";
        }else if($gap >= 60*60 && $gap < 24*60*60){
            //1小时以上，1天以内
            $gap = round($gap/3600);
            $result_time = $gap."小时 前";
        }else if($gap >= 24*60*60 && $gap < 48*60*60){
            //1天以上，2天以内
            $gap = date('H:i', strtotime($result_time));
            $result_time = "昨天 ".$gap;
        }

        $result_content = $row["content"];
        $result_abstract = getAbstract($result_content);


        $dataArr = array ('title'=>$result_title,'time'=>$result_time,'abstract'=>$result_abstract);
        foreach ( $dataArr as $key => $value ) {
            $dataArr[$key] = urlencode ($value) ;
        }
        $dataArr = urldecode ( json_encode ( $dataArr )). ",";
        echo $dataArr;
    }

?>