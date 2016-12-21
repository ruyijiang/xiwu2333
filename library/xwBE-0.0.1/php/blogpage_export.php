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

    $sql = "SELECT id,aid,title,content,uid,time,read_times FROM articles WHERE aid = '$aid' ";
    $qry = $db->query($sql);
    $row = $qry->fetch_assoc();
    $blogCate = "normal";

    if($row == null){
        $sql = "SELECT * FROM covers WHERE cover_id = '$aid' ";
        $qry = $db->query($sql);
        $row = $qry->fetch_assoc();
        $blogCate = "cover";
    }

    if(!empty($row)){

        $result_id = $row["id"];
        if($blogCate !== "cover"){
            $result_aid = $row["aid"];//cover_aid
            $result_read_times = $row["read_times"];
            $result_time = $row["time"];//文章发表时间
        }else{
            $result_aid = $row["cover_id"];//文章aid
            $result_read_times = $row["read_times"];
            $result_time = $row["regtime"];//文章发表时间
        }
        $result_uid = $row["uid"];//作者uid

        $sql_prev = "SELECT aid FROM articles WHERE id < '$result_id' AND uid = '$result_uid' ORDER BY id DESC LIMIT 0,1 ";
        $qry_prev = $db->query($sql_prev);
        $row_prev = $qry_prev->fetch_assoc();
        $result_prev = $row_prev["aid"];//前一篇的aid
        $sql_next = "SELECT aid FROM articles WHERE id > '$result_id' AND uid = '$result_uid' ORDER BY id ASC LIMIT 0,1 ";
        $qry_next = $db->query($sql_next);
        $row_next = $qry_next->fetch_assoc();
        $result_next = $row_next["aid"];//后一篇的aid

        $result_uid == $uid?$result_permission=true:$result_permission=false;//用户权限
        $result_title = $row["title"];//文章标题
        $result_content = $row["content"];//文章正文

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
        $sql2 = "SELECT name,gender,slogan,avatar,weibo,liveplain FROM users WHERE uid = '$result_uid' ";
        $qry2 = $db->query($sql2);
        $row2 = $qry2->fetch_assoc();
        $result_author_name = $row2["name"];//作者用户名
        $result_gender = $row2["gender"];//作者用户名
        $result_author_slogan = $row2["slogan"];//作者签名
        $result_author_avatar = $row2["avatar"];//作者头像

        $sql4 = "SELECT content FROM callingcard WHERE uid = '$result_uid' ";
        $qry4 = $db->query($sql4);
        $row4 = $qry4->fetch_assoc();
        $result_author_callingcard_name = $row4["content"];
        if($row2["weibo"]){
            $weibo_status = 1;
            $result_author_weibo = $row2["weibo"];//作者微博
        }else $weibo_status = 0;

        if($row2["liveplain"]){
            $liveplain_status = 1;
            $result_author_liveplain = $row2["liveplain"];//作者直播平台
        }else $liveplain_status = 0;


        @$dataArr = array ('aid'=>$result_aid,'title'=>$result_title,'content'=>htmlspecialchars($result_content),'time'=>$result_time,'uid'=>$result_uid,'permission'=>$result_permission,'name'=>$result_author_name,'gender'=>$result_gender,'callingcard_name'=>$result_author_callingcard_name,'slogan'=>$result_author_slogan,'hotblog'=>$result_hotblog,'avatar'=>$result_author_avatar,'weibo_status'=>$weibo_status,'weibo'=>$result_author_weibo,'liveplain_status'=>$liveplain_status,'liveplain'=>$result_author_liveplain,'prev_aid'=>$result_prev,'next_aid'=>$result_next);
        foreach ( $dataArr as $key => $value ) {
            $dataArr[$key] = urlencode ($value) ;
        }
        $dataArr = urldecode ( json_encode ( $dataArr ));
        echo $dataArr;


        //输出了相关数据，对数据表的状态进行更新
        $result_read_times += 1;
        $sql3 = "UPDATE articles SET read_times = '$result_read_times' WHERE aid = '$result_aid' ";
        $qry3 = $db->query($sql3);

    }else{

        $status = 0;
        $reminder = "没有该文章";
        echo $a->normalrespond($status,$reminder);

    }

?>