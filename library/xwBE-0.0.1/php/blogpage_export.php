<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/6/15
 * Time: 14:02
 */
require("../connectDB.php");
require("../all.php");
?>
<?php
    @$uid = $_SESSION["uid"];
    $aid = $_GET["aid"];

    $a = new interfaceResponse();
    $status = $reminder = 0;

    $sql = "SELECT title,content,uid,time FROM articles WHERE aid = '$aid' ";

    $sql_prev = "SELECT aid FROM articles WHERE aid < '$aid' LIMIT 0,1 ";
    $sql_next = "SELECT aid FROM articles WHERE aid > '$aid' LIMIT 0,1 ";

    $qry = $db->query($sql);
    $row = $qry->fetch_assoc();
    $result_uid = $row["uid"];//作者uid
    $result_uid == $uid?$result_permission=true:$result_permission=false;//用户权限
    $result_title = $row["title"];//文章标题
    $result_content = $row["content"];//文章正文
    $result_time = $row["time"];//文章发表时间

    $result_uid = $row["uid"];//文章作者uid
    //根据uid获取该用户热度前三的文章
    $sql1 = "SELECT aid,title FROM articles WHERE uid = '$result_uid' ORDER BY read_times DESC LIMIT 0,3";
    $qry1 = $db->query($sql1);
    $result_hotblog = "";
    while($row1 = $qry1->fetch_assoc()){
        $result_hotblog .= "{'aid':'".$row1["aid"]."','title':'".$row1["title"]."'}".",";
    }
    $result_hotblog = "[".$result_hotblog."]";

    //根据uid获得用户相关信息
    $sql2 = "SELECT name,slogan,avatar,weibo,liveplain FROM users WHERE uid = '$result_uid' ";
    $qry2 = $db->query($sql2);
    $row2 = $qry2->fetch_assoc();
    $result_author_name = $row2["name"];//作者用户名
    $result_author_slogan = $row2["slogan"];//作者签名
    $result_author_avatar = $row2["avatar"];//作者头像
    if($row2["weibo"]){
        $weibo_status = 1;
        $result_author_weibo = $row2["weibo"];//作者微博
    }else $weibo_status = 0;

    if($row2["liveplain"]){
        $liveplain_status = 1;
        $result_author_liveplain = $row2["liveplain"];//作者直播平台
    }else $liveplain_status = 0;



    @$dataArr = array ('title'=>$result_title,'content'=>htmlspecialchars($result_content),'time'=>$result_time,'uid'=>$result_uid,'permission'=>$result_permission,'name'=>$result_author_name,'slogan'=>$result_author_slogan,'hotblog'=>$result_hotblog,'avatar'=>$result_author_avatar,'weibo_status'=>$weibo_status,'weibo'=>$result_author_weibo,'liveplain_status'=>$liveplain_status,'liveplain'=>$result_author_liveplain);
    foreach ( $dataArr as $key => $value ) {
        $dataArr[$key] = urlencode ($value) ;
    }
    $dataArr = urldecode ( json_encode ( $dataArr ));
    echo $dataArr;

?>