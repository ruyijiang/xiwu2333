<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/5/17
 * Time: 23:16
 */
require("../connectDB.php");
require("../all.php");
require("../Regulars.php");
?>
<?php
    @$name = $_POST["name"];
    $gender = $_POST["gender"];
    $server = $_POST["server"];
    $country = $_POST["country"];
    $province = $_POST["province"];
    $city = $_POST["city"];
    $tel = $_POST["tel"];
    $qq = $_POST["qq"];
    $weixin = $_POST["weixin"];
    $weibo = $_POST["weibo"];
    $liveplain = $_POST["liveplain"];

    $uid = $_SESSION["uid"];
    $password = $_SESSION["userpassword"];

    $a = new interfaceResponse();

    $status = 0;
    $reminder = "";
    if(!$name){
        $status = 0;
        $reminder = "还有未填写项目";
        echo $a->normalrespond($status,$reminder);
        return false;
        //------------------------------------------------------------------------------------------------------------->出口1：有未填写项
    }else{
        if(1==1){
            $sql = "UPDATE users SET name='$name',gender='$gender',server='$server',country='$country',province='$province',city='$city',tel='$tel',qq='$qq',weixin='$weixin',weibo='$weibo',liveplain='$liveplain' WHERE uid = '$uid' AND password='$password' ";
            $qry = $db->query($sql);
            if($qry){
                $status = 1;
                $reminder = "";
                echo $a->normalrespond($status,$reminder);
                //----------------------------------------------------------------------------------------------------->出口4：数据更新成功
            }else{
                $status = 0;
                $reminder = "个人信息更新失败，请联系管理员";
                echo $a->normalrespond($status,$reminder);
                return false;
                //----------------------------------------------------------------------------------------------------->出口3：数据库更新失败
            }
        }else{
            $status = 0;
            $reminder = "有内容填写不合规则";
            echo $a->normalrespond($status,$reminder);
            return false;
            //--------------------------------------------------------------------------------------------------------->出口2：有内容填写不合法
        }
    }
?>