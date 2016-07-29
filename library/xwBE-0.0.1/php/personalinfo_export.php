<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/5/21
 * Time: 18:32
 */
require("../connectDB.php");
require("../all.php");
?>
<?php
    $timing = $_POST["timing"];

    @$uid = $_SESSION["uid"];
    @$password = $_SESSION["userpassword"];

    $a= new interfaceResponse();
    $status = $reminder = "";

    if($timing){
        $sql = "SELECT * FROM users WHERE uid='$uid' AND password = '$password' ";
        @$qry=$db->query($sql);
        $row=$qry->fetch_assoc();

        $uid = $row["uid"];
        $name = $row["name"];
        $email = $row["email"];
        $gender = $row["gender"];
        $server = $row["server"];
        $server_bigarea = $row["server_bigarea"];
        $country = $row["country"];//6
        $province = $row["province"];
        $city = $row["city"];
        $tel = $row["tel"];
        $qq = $row["qq"];
        $weixin = $row["weixin"];
        $weibo = $row["weibo"];
        $liveplain = $row["liveplain"];//13个
        $dota2_uid = $row["dota2_uid"];
        $avatar = $row["avatar"];

        $dataArr = array ('uid'=>$uid,'name'=>$name,'gender'=>$gender,'server'=>$server,'server_bigarea'=>$server_bigarea,'country'=>$country,'province'=>$province,'city'=>$city,'tel'=>$tel,'qq'=>$qq,'weixin'=>$weixin,'weibo'=>$weibo,'liveplain'=>$liveplain,'dota2_uid'=>$dota2_uid,'avatar'=>$avatar);

        foreach ( $dataArr as $key => $value ) {
            $dataArr[$key] = urlencode ($value);
        }

        $dataArr = urldecode ( json_encode ( $dataArr ));
        echo $dataArr;

    }else{
        $status = 0;
        $reminder = "缺少请求头内容，请联系管理员";
        echo $a->normalrespond($status, $reminder);
    }


?>
