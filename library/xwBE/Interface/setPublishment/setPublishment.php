<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/12/30
 * Time: 10:40
 */
require("../../connectDB.php");
require("../../all.php");
?>
<?php
@$uid = $_SESSION["uid"];//uid
$cover_id = $_POST["cover_id"];//cover_id

$publishDate = $_POST["publishDate"];
$publishUnixTime = strtotime("+".$i." day");//上架时间 - unix

$publishDuration = $_POST["publishDuration"];
$unpublishUnixTime = $publishUnixTime + 60*60*$publishDuration;//下架时间 - unix


$status = 0;
$reminder = "";
$a = new interfaceResponse();

if(empty($publishDate)){
    $reminder = "没有输入发布时间";
    echo $reminder;

}else if(empty($publishDuration)){
    $reminder = "没有输入发布时长";
    echo $reminder;

}else{
    //都输入了
    $sql = "UPDATE covers SET post_time = '$publishUnixTime',unpost_time = '$unpublishUnixTime' WHERE cover_id = '$cover_id' AND uid ='$uid' ";
    $qry = $db->query($sql);
    if($qry){

        $reminder = "封面文章发布成功";
        echo $reminder;

    }else{

        $reminder = "不明原因导致的发布失败，请联系管理员";
        echo $reminder;

    }

}
