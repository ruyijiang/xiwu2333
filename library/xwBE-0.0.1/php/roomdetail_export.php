<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/5/22
 * Time: 23:03
 */
require("../connectDB.php");
require("../all.php");
?>
<?php
    $timing = $_POST["timing"];

    $uid = $_SESSION["uid"];
    $password = $_SESSION["userpassword"];

    $a= new interfaceResponse();
    $status = $reminder = "";

    if($timing){
        $sql = "SELECT * FROM rooms WHERE creator = '$uid' ";

    }else{
        $status = 0;
        $reminder = "缺少请求头内容，请联系管理员";
        echo $a->normalrespond($status, $reminder);
    }

?>