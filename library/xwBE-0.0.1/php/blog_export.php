<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/6/2
 * Time: 15:30
 */
require("connectDB.php");
require("all.php");
?>
<?php
$status = $reminder = 0;
@$uid = $_POST["uid"];
if(!$uid) $uid = $_SESSION["uid"];

$sql = "SELECT * FROM articles WHERE uid = '$uid' ";
$qry = $db->query($sql);
while($row = $qry->fetch_assoc()){
    $result_title = $row["title"];
    $result_time = $row["time"];
    $result_content = $row["content"];//这个内容需要进行修正，部分输出而不能全部输出
    $result_content = mb_substr(strip_tags($result_content),0,70,'utf-8');
}

?>