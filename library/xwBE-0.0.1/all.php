<?php
session_start();

/**
 * 这是xiwoo.com类库、全局函数文件***
***/
header("Content-Type: text/html;charset=utf-8");
?>
<?php
/*一些函数中需要的全局变量的初始化*/
$freq = 0;//记录用户注册次数

?>
<?php
/*整个程序的初始化设置、赋值和取值*/
/**
 * 检测用户开放组队状态
 */
//每次登陆时都取消开放组队



?>
<?php
/***************************************************************************************************************  获取物理环境类 ***/
class _environment{
    /*****************获取ip地址******************/
    public function getIp(){
        if(!empty($_SERVER["HTTP_CLIENT_IP"])){
            $cip = $_SERVER["HTTP_CLIENT_IP"];
        }
        else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        else if(!empty($_SERVER["REMOTE_ADDR"])){
            $cip = $_SERVER["REMOTE_ADDR"];
        }
        else{
            $cip = "无法获取！";
        }
        if($cip == "::1"){
            $cip = "127.0.0.1";
        }
        return $cip;
        //输出为::1时，表示是IPV6本地回环地址，相当于IPV4的127.0...
    }
    /*****************获取格式化服务器时间*********************/
    public function getTime(){
        return date('Y-m-d H:i:s',time());
    }
    /*****************获取服务器时间戳***********************/
    public function getTimeStamp(){
        return time();
    }
    /*****************获取地址 | params:$mod:0,根据数据库***********************/
    public function getLocation($mod,$value){
        //
    }

}

/************************************************************************************************************************************************/
/**************************************************************************************************************遍历目录和文件列表的类getDirFile | ***/
define('DS', DIRECTORY_SEPARATOR);    
class getDirFile{    
    //返回数组  
    private $DirArray  = array();  
    private $FileArray = array();  
    private $DirFileArray = array();    
    private $Handle,$Dir,$File;  
  
    //获取目录列表  
    public function getDir( & $Dir ){  
        if( is_dir($Dir) ){  
            if( false != ($Handle = opendir($Dir)) ){  
                while( false != ($File = readdir($Handle)) ){  
                    if( $File!='.' && $File!='..' && !strpos($File,'.') ){  
                        $DirArray[] = $File;  
                    }  
                }  
                closedir( $Handle );  
            }  
        }else{  
            $DirArray[] = '[Path]:\''.$Dir.'\' is not a dir or not found!';  
        }  
        return $DirArray;  
    }
    //获取文件列表
    public function getFile( & $Dir ){  
        if( is_dir($Dir) ){  
            if( false != ($Handle = opendir($Dir)) ) {  
                while( false != ($File = readdir($Handle)) ){  
                    if( $File!='.' && $File!='..' && strpos($File,'.') ){  
                        $FileArray[] = $File;  
                    }  
                }  
                closedir( $Handle );  
            }  
        }else{  
            $FileArray[] = '[Path]:\''.$Dir.'\' is not a dir or not found!';  
        }  
        return $FileArray;  
    }
    //获取目录/文件列表  
    public function getDirFile( & $Dir ){  
        if( is_dir($Dir) ){  
            $DirFileArray['DirList'] = $this->getDir( $Dir );  
            if( $DirFileArray ){  
                foreach( $DirFileArray['DirList'] as $Handle ){  
                    $File = $Dir.DS.$Handle;  
                    $DirFileArray['FileList'][$Handle] = $this->getFile( $File );  
                }  
            }  
        }else{  
            $DirFileArray[] = '[Path]:\''.$Dir.'\' is not a dir or not found!';  
        }  
        return $DirFileArray;  
    }  
  
}

/**************************************************************************************************************************************************/
/********************************************************************************************************************************记录用户操作类 | ***/
class UserRecord{
/*** 创建"用户记录"文件，但是并不写入任何内容 | 已经通过session[uid]进行自动化 | 自动化之前：param:$mod - 有两种数值可选:"ip"和"uid"，分别用于记录|游客|和|注册用户|的浏览信息 ***/
    public function createUserRecordFile(){
        $_En = new _environment();
        $uip = $_En->getIp();

        //$lj = split("/",$_SERVER["PHP_SELF"]);<--PHP5.3之前的写法
        $lj = preg_split('/\/{1}/',$_SERVER["PHP_SELF"]);//PHP5.3及以后的写法
        $folder = $lj[count($lj)-5];//得到根目录文件夹

        if(!empty($_SESSION["uid"])){
            $a = $_SESSION["uid"];
            $tg = "user_traces/RegisteredUser/";
        }else{
            $a = $uip;
            $tg = "user_traces/IP/";
        }
        $filename = $a.".txt";
        $file = $folder."../../../data/".$tg.$filename;

        if(!file_exists($file)){
            if(!file_exists(dirname($file))){//如果目录不存在
                mkdir(dirname($file),0777);//则创建一个目录，并赋予0777模式权限
                $cf = fopen($file,"w");//则创建一个文件，并富裕可读写权限
                fclose($cf);
            }else{//如果目录存在
                $cf = fopen($file,"w");//则创建一个文件，并富裕可读写权限
                fclose($cf);
            }
        }
    }//End of function
/*** 创建或写入"用户记录"文件夹下的txt文件，写入内容，即记录用户浏览轨迹 | 已经通过session[uid]进行自动化，现在需要一个content参数，作为记录内容 | 自动化之前：param:$mod - 有两种数值可选:"ip"和"uid"，分别用于记录|游客|和|注册用户|的浏览信息 * ***/
    public function recordUserVisit($content){
        //mod有"ip"和"registered"和"auto"三种模式，分别服务于未注册用户和已注册用户。
        $_En = new _environment();
        $uip = $_En->getIp();
            $pagename = preg_split('/\/{1}/',$_SERVER["PHP_SELF"]);
            $pagename = $pagename[count($pagename)-1];
            $now = "20".date('y-m-d H:i:s',time());
            if(!$pagename || !$now){
                echo "时间和页面获取失败";
            }else{
                if(!empty($_SESSION["uid"])){
                        $a = $_SESSION["uid"];
                        $tg = "user_traces/RegisteredUser/";
                    }else{
                        $a = $uip;
                        $tg = "user_traces/IP/";
                    }
                }
                $filename = $a.".txt";
                $file = "../../../data/".$tg.$filename;
                $filestream = fopen($file,"r");
                /*$content = fgets($filestream);
                $target = strpos("用户登录",$content);
                if($target === false){//没有找到duration项目，创建项目
                    $filestream = fopen($file,"a");
                    fwrite($filestream,""."[".$now."]创建此文件，并浏览[".$pagename."]\r\n");
                    fclose($filestream);
                }else{//找到了duration项目，在其19个字符之后的位置进行书写，然后再返回文件*/
                    $filestream = fopen($file,"a");
                    fwrite($filestream,"[".$now."]浏览[".$pagename."]，备注内容为：【".$content."】\r\n");
                    fclose($filestream);
                //}

    }
    /*** 创建或写入"用户记录"文件夹下的txt文件，用于记录用户搜索记录 | param:   - 没有参数 ***/

}
/**************************************************************************************************************************************************/
/************************************************************************************************************接通tencent Api需要的tencentApi类 | ***/
class tencentApi{
    //private $openid = $_GET["openid"];
    //private $openkey  = $_GET["openkey"];
    public function getopenid(){
        
    }
    public function getopenkey(){
        
    }
}
/***************************************************************************************************************************************************/
/****************************************************************************************************************************************接口输出 ***/
class interfaceResponse{
    //normalresponse主要用于注册、登陆、注销等一般性功能的输出
    //输出结果为json
    public function normalrespond($statuscode,$message){
        $arr = array ('statuscode'=>$statuscode,'message'=>$message);
        foreach ( $arr as $key => $value ) {
            $arr[$key] = urlencode ($value);
        }
        $arr = urldecode ( json_encode ( $arr ) );
        return $arr;
    }
    /****************************************************/
    /****************************************************/
    //chartDataRespond主要用于返回某些展示页面的
    //输出结果为json
    public function chartDataRespond($statuscode,$tagtitle,$tagcontent){
        $arr = array ('statuscode'=>$statuscode,'tagtitle'=>$tagtitle,'tagcontent'=>$tagcontent);
        foreach ( $arr as $key => $value ) {
            $arr[$key] = urlencode ($value);
        }
        $arr = urldecode ( json_encode ( $arr ) . ",");
        return $arr;
    }
}
/**************************************************************************************************************************************************/
/************************************************************************************************************************登陆函数login() | 返回值： ***/
function login($email, $password){
    require ("connectDB.php");

    $useremail = $email;
    $userpassword = $password;
    $status = $reminder = null;

    if(!isset($useremail) || !isset($userpassword)){
        $status = 0;
        $reminder = "没有输入用户名或密码";
        return false;
        //----------------------------------------------------------------------------------------------------->登陆出口1：没有填写useremail和userpassword
    }else{
        //拿数据去数据库里查
        $sql = "SELECT * FROM users WHERE email = '$useremail' ";
        $qry = $db -> query($sql);
        $row = $qry->fetch_assoc();
        $result_email = $row["email"];//用户邮箱

        $b = new _environment();
        $uip = $b->getIp();//用户当前ip
        $tnow = $b->getTime();//用户当前时间
        $onlinestatus = "1";//用户在线状态

        if(!$qry || !$row){
            $status = 0;
            $reminder = "账号不存在";
            $a = new interfaceResponse();
            echo $a->normalrespond($status,$reminder);
            //------------------------------------------------------------------------------------------------->登陆出口2：登陆使用的邮箱，并没有对应记录
        }else{
            $result_password = $row["password"];//用户密码

            if(!$result_password){
                $status = 0;
                $reminder = "获取密码失败，请联系管理员";
                $a = new interfaceResponse();
                echo $a->normalrespond($status,$reminder);
                //-------------------------------------------------------------------------------------------------------------->登陆出口3：密码获取错误
            }else if($result_password == md5($userpassword)){

                //拿取必要的用户数据
                $result_uid = $row["uid"];//用户uid
                $result_uname = $row["name"];//用户名
                if(empty($result_uname) || !$result_uname){
                    $result_uname = "unnamed";
                }

                $sql2 = "UPDATE users SET lastip = '$uip',lasttime = '$tnow',onlinestatus = '$onlinestatus' WHERE email = '$result_email' && uid = '$result_uid' && name = '$result_uname' && password = '$result_password'";
                $qry2 = $db->query($sql2);
                if(!$qry2){
                    $_SESSION["uid"] = $result_uid;
                    $_SESSION["username"] = $result_uname;
                    $_SESSION["userpassword"] = $result_password;
                    $_SESSION["loginstatus"] = 1;
                    setcookie("uid", $result_uid, time()+604800);//604800是7天的秒数，表示记录cookie一礼拜
                    setcookie("username", username, time()+604800);
                    setcookie("userpassword", userpassword, time()+604800);

                    $status = 1;
                    $reminder = "登陆成功。但是状态更新失败，可能会造成一些错误";
                    $a = new interfaceResponse();
                    echo $a->normalrespond($status,$reminder);
                //--------------------------------------------------------------------------------------------->登陆出口5：登陆成功，但是状态数据更新失败
                }else{
                    //加入到session和cookie中
                    $_SESSION["uid"] = $result_uid;
                    $_SESSION["username"] = $result_uname;
                    $_SESSION["userpassword"] = $result_password;
                    $_SESSION["loginstatus"] = 1;
                    setcookie("uid", $result_uid, time()+604800);//604800是7天的秒数，表示记录cookie一礼拜
                    setcookie("username", $result_uname, time()+604800);
                    setcookie("userpassword", $result_password, time()+604800);

                    $status = 1;
                    $reminder = "";
                    $a = new interfaceResponse();
                    echo $a->normalrespond($status,$reminder);
                    //--------------------------------------------------------------------------------------------->登陆出口4：登陆成功
                }
            }else{
                $status = 0;
                $reminder = "密码错误";
                $a = new interfaceResponse();
                echo $a->normalrespond($status,$reminder);
                //-------------------------------------------------------------------------------------------------------------->登陆出口5：密码错误
            }
        }
    }
    $b = new UserRecord();
    $b->createUserRecordFile();
    if($status == 1 && empty($reminder)){
        $b->recordUserVisit("登陆成功，"."用户登录的ip是".$uip);
    }else{
        $b->recordUserVisit("登陆失败，原因是：".$reminder."用户登录的ip是".$uip);
        return false;
    }
}

/**********************************************************************************************************************************************************/
/*****************************************************************************************************************************注册函数signup() | 返回值： ***/
function signup($email, $password, $gender){
    require ("connectDB.php");

    $useremail = $email;
    $userpassword = $password;
    $usergender = $gender;
    $gap_time = 86400;//同一个ip地址，一天最多注册2个账号。时间间隔为$gap_time
    $status = $reminder = null;
    $gap_time_check = null;

    //检验：同一个ip地址，$gap_time时间内最多注册2个账号
    if(!$useremail || !$userpassword || !$usergender){
        $status = 0;
        $reminder = "有未填项目";
        $a = new interfaceResponse();
        echo $a->normalrespond($status,$reminder);
        //----------------------------------------------------------------------------------------------------------------------------------->注册出口1：有未填项
    }else{
        /*1检测验证信息是否符合格式*/
        $useremail_validity_result = null;
        $rule_email = '/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/';
        $rule_email = preg_match( $rule_email, $useremail);
        $rule_password = '/^\w+$/';
        $rule_password = preg_match( $rule_password, $userpassword );
        if(($usergender !== "male" && $usergender !== "female") || !$rule_email || !$rule_password){
            $useremail_validity_result = false;
        }else{
            $useremail_validity_result = true;
        }
        /*2检测邮箱是否已经注册过*/
        $useremail_existed_sql = "SELECT `uid` From `users` WHERE `email` = '$useremail' ";
        $useremail_existed_qry = $db -> query($useremail_existed_sql);
        $row = $useremail_existed_qry->fetch_assoc();
        $useremail_existed_result = $row["uid"];
        if(!$useremail_validity_result){
            $status = 0;
            $reminder = "填写内容的格式不正确";
            $a = new interfaceResponse();
            echo $a->normalrespond($status,$reminder);
            //----------------------------------------------------------------------------------------------------------------------------->注册出口3：输入格式不合法
        }else if($useremail_existed_result){
            $status = 0;
            $reminder = "该邮箱已经注册过账号";
            $a = new interfaceResponse();
            echo $a->normalrespond($status,$reminder);
            //-------------------------------------------------------------------------------------------------------------------------------->注册出口4：已经注册过
        }else{
            //检测一个地址注册的频率，策略：
            //首先获取用户IP地址，然后根据IP地址入库查询，将所有结果按照时间倒序排列，取最后3个中的3rd个
            //将这个号的regtime与当前时间进行比对，如果时间差距短于1*24*60*60秒，则不允许注册
            $useren = new _environment();
            $userip = $useren->getIp();
            $timenow = $useren->getTime();

            $duration_sql = "SELECT regtime FROM users WHERE regip = '$userip' ORDER BY regtime DESC LIMIT 2,1";
            $duration_qry = $db->query($duration_sql);
            $duartion_row = $duration_qry->fetch_assoc();
            $duration_result = $duartion_row["regtime"];
            $duration_time = strtotime($duration_result);
            $timenow_stamp = strtotime($timenow);
            $minus_dif = $timenow_stamp - $duration_time;
            if($minus_dif < 1*24*60*60){
                $status = 0;
                $reminder = "抱歉，同一ip地址在一天内只允许注册3个账号";
                $a = new interfaceResponse();
                echo $a->normalrespond($status,$reminder);
                //----------------------------------------------------------------------------------------------------------------->注册出口6：同一个IP地址，在24h内注册数超过3个
            }else{
                if($usergender == "male"){
                    $usergender = 0;//男
                    $useravatarUri = "img/user_img/avatar/default/default_male.png";
                }else{
                    $usergender = 1;//女
                    $useravatarUri = "img/user_img/avatar/default/default_female.png";
                }
                $userpassword = md5($userpassword);
                //根据邮箱生成用户名
                $num = strpos($useremail,"@");
                $randName = substr($useremail,0,$num);
                //*改成对数据库无害的字段********************************************//2!%@$$%^@Needed
                $importable_sql = "INSERT INTO `xiwu2333.com`.`users` (uid, email, name, password, gender, lastip,avatar, lasttime, regtime, regip, onlinestatus) VALUES ('','$useremail','$randName','$userpassword','$usergender','$userip','$useravatarUri','$timenow','$timenow','$userip',0) ";
                $importable_qry = $db->query($importable_sql);
                if(!$importable_qry){
                    $status = 0;
                    $reminder = "数据库插入失败，原因不明，请联系管理员或客服";
                    $a = new interfaceResponse();
                    echo $a->normalrespond($status,$reminder);
                    //---------------------------------------------------------------------------------------------------------------->注册出口7：数据库插入失败
                }else{
                    $status = 1;
                    $reminder = "";
                    $a = new interfaceResponse();
                    echo $a->normalrespond($status,$reminder);
                    //----------------------------------------------------------------------------------------------------------------->注册出口8：数据库插入成功，即注册成功
                    //setcookie("frequency", $freq, time()+86400);
                }
                //给cookie加1
            }
        }
    }
    $b = new UserRecord();
    $b->createUserRecordFile();
    if($status == 1){
        $b->recordUserVisit("注册成功");
    }else{
        $b->recordUserVisit("注册失败，原因是：".$reminder);
        return false;
    }
}
/***************************************************************************************************************************************************************/
/***********************************************************************************************************************************退出函数logout() | 返回值： ***/
function logout(){
    require ("connectDB.php");
    //删除session和cookie
    @$useruid = $_SESSION["uid"];

    session_unset("uid");
    session_unset("username");
    session_unset("userpassword");
    session_unset("loginstatus");
    session_unset("openstatus");
    setcookie("uid", "", time() - 3600);//604800是7天的秒数，表示记录cookie一礼拜
    setcookie("username", "", time() - 3600);
    setcookie("userpassword", "", time() - 3600);
    setcookie("openstatus", "", time() - 3600);

    $logoutCheck = isset($_SESSION["uid"]) || isset($_SESSION["username"]) || isset($_SESSION["userpassword"]) || isset($_SESSION["loginstatus"]) || empty($_COOKIE["uid"]) || empty($_COOKIE["username"]) || empty($_COOKIE["userpassword"]);
    if($logoutCheck){
        $status = 0;
        $reminder = "检测到数据异常，禁止退出登录，请联系管理员，或者您可以直接关闭此页";
        $a = new interfaceResponse();
        echo $a->normalrespond($status,$reminder);
        //----------------------------------------------------------------------------------------------------------------->注册出口1：退出失败，数据异常。
    }else{
        //更新数据库在线状态，以及最后登录时间，登陆地址
        $a = new _environment();
        $tnow = $a->getTime();
        $uip = $a->getIp();
        $sql = "UPDATE users SET lasttime = '$tnow',lastip='$uip',onlinestatus='0',openstatus='0' WHERE uid = '$useruid' ";
        $qry = $db->query($sql);
        if(!$qry){
            $status = 0;
            $reminder = "退出登陆成功，但是更新用户数据失败（这将导致无法更新您最后一次登录的时间和地址，以及可能的在线状态错误）";
            $a = new interfaceResponse();
            echo $a->normalrespond($status,$reminder);
            //-------------------------------------------------------------------------------------------------------------------------->注册出口2：用户退出成功，但数据更新失败
        }else{
            $status = 1;
            $reminder = "退出成功";
            $a = new interfaceResponse();
            echo $a->normalrespond($status,$reminder);
            //--------------------------------------------------------------------------------------------------------------------------->注册出口3：用户退出成功，数据更新也成功
        }
    }

}
/****************************************************************************************************************************************开放组队 ***/
/***************************************************************************************************************************************************/
class queue{
    public function searching(){
        require ("connectDB.php");
        $status = $reminder = '';
        @$uid = $_SESSION["uid"];
        $sql = "UPDATE users SET openstatus='1' WHERE uid = '$uid' ";
        $_SESSION["openstatus"] = 1;
        $qry = $db->query($sql);
        if($qry){
            $status = 1;
            $reminder = "开始开放组队";
            $a = new interfaceResponse();
            echo $a->normalrespond($status,$reminder);
        }else{
            $status = 0;
            $reminder = "开放组队失败，请联系管理员";
            $a = new interfaceResponse();
            echo $a->normalrespond($status,$reminder);
        }
        $b = new UserRecord();
        $b -> createUserRecordFile();
        if($status == 1){
            $b->recordUserVisit("开放组队成功");
        }else{
            $b->recordUserVisit("开放组队失败");
            return false;
        }
    }

    public function disablesearching(){
        require ("connectDB.php");
        $status = $reminder = '';
        @$uid = $_SESSION["uid"];
        $sql = "UPDATE users SET openstatus = '0' WHERE uid = '$uid' ";
        $qry = $db->query($sql);
        $_SESSION["openstatus"] = "0";
        if($qry){
            $status = 1;
            $reminder = "停止开放组队";
            $a = new interfaceResponse();
            echo $a->normalrespond($status,$reminder);
        }else{
            $status = 0;
            $reminder = "停止开放组队失败，请联系管理员";
            $a = new interfaceResponse();
            echo $a->normalrespond($status,$reminder);
        }
        $b = new UserRecord();
        $b -> createUserRecordFile();
        if($status == 1){
            $b->recordUserVisit("停止开放组队");
        }else{
            $b->recordUserVisit("停止开放组队失败");
            return false;
        }
    }
}
/********************************************************************************************************************************userlist用户数据 ***/
/***************************************************************************************************************************************************/
class UserData{
    public function getSexualRates(){
        require ("connectDB.php");
        $sql_gendermale = "SELECT COUNT(gender) FROM users WHERE gender = '0' ";
        $qry_gendermale = $db->query($sql_gendermale);
        $row_gendermale = $qry_gendermale->fetch_assoc();
        $result_gendermale = $row_gendermale["COUNT(gender)"];
        $result_gendermale = intval($result_gendermale, 10);//性别为男的数量 -> type:int
        $sql_genderfemale = "SELECT COUNT(gender) FROM users WHERE gender = '1' ";
        $qry_genderfemale  = $db->query($sql_genderfemale);
        $row_genderfemale = $qry_genderfemale->fetch_assoc();
        $result_genderfemale = $row_genderfemale["COUNT(gender)"];
        $result_genderfemale = intval($result_genderfemale, 10);//性别为女的数量 -> type:int

        $rate_male = $result_gendermale/($result_gendermale + $result_genderfemale);
        $rate_female = $result_genderfemale/($result_gendermale + $result_genderfemale);

        return '{"rate_male":'.$rate_male.',"rate_female":'.$rate_female.'}';
    }

    public function getHighestLocation(){
        require ("connectDB.php");
        $sql = "select count(1),city from users group by city order by count(1) desc limit 0,3";
        $qry = $db->query($sql);
        while ($row = $qry->fetch_assoc()){
            $result_count = $row["count(1)"];
            $result_region = $row["city"];
            $a = new interfaceResponse();
            echo $a-> chartDataRespond(1,$result_region,$result_count);
        }
    }

    public function getOnlineUsersAmount(){
        require ("connectDB.php");
        $sql = "SELECT uid FROM users WHERE onlinestatus = '1' AND openstatus = '1'  ";
        $qry = $db->query($sql);
        $num = 0;
        while($row = $qry->fetch_assoc()){
            $num++;
        }
        return $num;
    }

    public function getOnlineUsersAmountInPeriod($period,$interval){
        require ("connectDB.php");

    }

}
?>