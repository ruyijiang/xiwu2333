<?php
require("../connectDB.php");
require("../all.php");
require("../algorithm/RandAid.php");

    //echo "<h2><div id='ue_title'>".$_POST["title"]."</h2></div>"."<br>";
    //echo $_POST["content"];
    @$a_content = $_POST["content"];
    @$a_title = $_POST["title"];


    $a = new _environment();
    $uip = $a->getIp();
    $tnow = $a->getTime();
    $b = new interfaceResponse();
    $c = new UserRecord();


    if(strlen($a_title) > 40){
        $status = 0;
        $reminder = "发表失败。标题过长。";
        echo $b->normalrespond($status,$reminder);$c->createUserRecordFile();
        $c->recordUserVisit("发表了文章：".$a_title);
        return false;
        //----------------------------------------------------------------------------------------------------------------->登陆出口7：标题过长
    }


    //$lj = split("/",$_SERVER["PHP_SELF"]);<--PHP5.3之前的写法
    $lj = preg_split('/\/{1}/',$_SERVER["PHP_SELF"]);//PHP5.3及以后的写法
    $folder = $lj[count($lj)-5];//得到根目录文件夹
    $status = 0;
    $reminder = null;
    if(empty($_SESSION["uid"]) || !isset($_SESSION["uid"])){
        $status = 0;
        $reminder = "发表失败。请登录后再发表文章";
        echo $b->normalrespond($status,$reminder);
        return false;
        //----------------------------------------------------------------------------------------------------------------->登陆出口1：用户信息获取失败
    }else if($_SESSION["uid"]){
        if(empty($a_title) || empty($a_content)){
            $status = 0;
            $reminder = "没有填写内容或标题";
            echo $b->normalrespond($status,$reminder);
            return false;
            //----------------------------------------------------------------------------------------------------------------->登陆出口2：没有填写内容或标题
        }else{
            $a = $_SESSION["uid"];
            $filename = $a_title.".txt";
            //建立或者读取目录//
            $file = $folder."../../../product/articles/".$a."/".$filename;
            if(!file_exists($file)){
                if(!file_exists(dirname($file))){//如果目录不存在
                    mkdir(dirname($file),0777);//则创建一个目录，并赋予0777模式权限
                    @$filestream = fopen($file,"w");//则创建一个文件，并富裕可读写权限
                }else{//如果目录存在
                    @$filestream = fopen($file,"w");//则创建一个文件，并富裕可读写权限
                }
            }else{
                $status = 0;
                $reminder = "您已经发布过一篇同名文章";
                $c->createUserRecordFile();
                $c->recordUserVisit("发表失败：".$a_title."，该目录下同名文章已经存在");
                echo $b->normalrespond($status,$reminder);
                return false;
                //----------------------------------------------------------------------------------------------------------------->登陆出口5：该目录下同名文章已经存在
            }
            //**开始写入文档**//
            @$filestream = fopen($file,"a");
            //$a_content = "\xEF\xBB\xBF".$a_content;
            @$d = fwrite($filestream,$a_content);
            @fclose($filestream);
            if(!$d){
                $status = 0;
                $reminder = "发表失败，可能是由于找不到用户文章根目录导致的，请联系管理员";
                //----------------------------------------------------------------------------------------------------------------->登陆出口3：txt文件创建成功，但是文章记录失败**极严重错误
                $c->createUserRecordFile();
                $c->recordUserVisit("发表失败：".$a_title."，文章的在线记录出现错误");
                echo $b->normalrespond($status,$reminder);
                return false;
            }else{
                //将文章放入数据库.article表
                $uid = $_SESSION["uid"];
                $abc = create_Aid();
                $sql = "INSERT INTO articles(aid,uid,time,title,content,txt_url) VALUES ('$abc','$uid','$tnow','$a_title','$a_content','$file') ";
                $qry = $db->query($sql);
                if(!$qry){
                    $status = 0;
                    $reminder = "发表失败，没有成功提交。请联系管理员";
                    $c->createUserRecordFile();
                    $c->recordUserVisit("发表失败：".$a_title);
                    echo $b->normalrespond($status,$reminder);
                    //----------------------------------------------------------------------------------------------------------------->登陆出口6：入库失败
                }else{
                    $status = $abc;
                    $reminder = "发表成功";
                    //----------------------------------------------------------------------------------------------------------------->登陆出口4：发表成功
                    $c->createUserRecordFile();
                    $c->recordUserVisit("发表了文章：".$a_title);
                    echo $b->normalrespond($status,$reminder);
                }
            }

        }
    }//End of else if()


?>