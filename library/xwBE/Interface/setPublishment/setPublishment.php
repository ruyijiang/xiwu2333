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

$publishDate = (int)$_POST["publishDate"] + 1;
$publishUnixTime = strtotime("+".((int)$publishDate+1)." day");
$y = date("Y",strtotime("+".$publishDate." day"));
$m = date("m",strtotime("+".$publishDate." day"));
$d = date("d",strtotime("+".$publishDate." day"));
$publishUnixTime = mktime(07,0,0,$m,$d,$y);//上架时间（上架当日7点） - unix


$publishDuration = (int)$_POST["publishDuration"];
$unpublishUnixTime = $publishUnixTime + (int)60*60*$publishDuration - 1;//下架时间 - unix

$status = 0;
$reminder = "";
$a = new interfaceResponse();

if(empty($publishDate+1)){
    $reminder = "发布失败：没有输入发布时间。";
    echo $reminder;

}else if(empty($publishDuration)){
    $reminder = "发布失败：没有输入发布时长。";
    echo $reminder;

}else{
    //都输入了
    $sql = "UPDATE covers SET post_time = '$publishUnixTime',unpost_time = '$unpublishUnixTime' WHERE cover_id = '$cover_id' AND uid ='$uid' ";
    $qry = $db->query($sql);
    if($qry){

        $reminder = "封面文章发布成功。自动为您跳转，请稍候...";
        $reminder .= " <span style='font-style: italic;font-weight:bold;color:red' id='timeoutspan'>3</span> 秒";
        $reminder .= "<script language=\"JavaScript\">";
        $reminder .= 'var x = 4;setInterval(function(){x--;document.getElementById("timeoutspan").innerHTML=x;if(x==0){window.location.href="/#/blog?aid='.$cover_id.'"}},1000);';
        $reminder .= "</script>";
        echo $reminder;

    }else{

        $reminder = "发布失败：不明原因导致的发布失败，请联系管理员。";
        echo $reminder;

    }

}
