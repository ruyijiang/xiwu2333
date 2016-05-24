<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/5/8
 * Time: 22:10
 */
?>

<?php
//流程:
    $uid = $_SESSION["uid"];

    $sql = "UPDATE users SET onlinestatus = '1' WHERE uid = '$uid' ";
    $qry = $db->query($sql);
    if($qry){

    }else{

    }


?>