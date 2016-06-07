<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/5/8
 * Time: 22:10
 */
require("../connectDB.php");
require("../all.php");
?>
<?php
//流程:
    $uid = $_SESSION["uid"];
    $con = $_GET["content"];
    $pri = $_GET["priority"];
    if($pri!=='user'||$pri!=='competition'||$pri!=='article') $pri='user';//当priority不是三者之一的时候，默认为user


/*
    $sql = "UPDATE users SET onlinestatus = '1' WHERE uid = '$uid' ";
    $qry = $db->query($sql);
    if($qry){

    }else{

    }
*/

?>