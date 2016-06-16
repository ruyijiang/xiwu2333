<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/6/14
 * Time: 16:59
 */
require("../connectDB.php");
require("../all.php");
require("../algorithm/RandAid.php");
?>
<?php
    @$a_content = $_POST["content"];

    @$a_title = $_POST["title"];


    $a = new _environment();
    $uip = $a->getIp();
    $tnow = $a->getTime();
    $b = new interfaceResponse();
    $c = new UserRecord();


    $lj = preg_split('/\/{1}/',$_SERVER["PHP_SELF"]);//PHP5.3及以后的写法
    $folder = $lj[count($lj)-5];//得到根目录文件夹
    $status = 0;
    $filename = $a_title.".txt";
    $file = $folder."../../../product/articles/".$_SESSION["uid"]."/".$filename;
    $reminder = null;
    if(empty($_SESSION["uid"]) || !isset($_SESSION["uid"])){
        $status = 0;
        $reminder = "发表失败。请登录后再发表文章";
        echo $b->normalrespond($status,$reminder);
        return false;
    }else{
        if(empty($a_title) || empty($a_content)){
            $status = 0;
            $reminder = "没有填写内容或标题";
            echo $b->normalrespond($status,$reminder);
            return false;
            //--------------------------------------------------------------------------------------------------------->出口1：没有填写内容或标题
        }else{

            $sql = "SELECT * FROM articles WHERE title = '$a_title' ";
            $qry = $db->query($sql);
            @$row = $qry->fetch_assoc($qry);
            $row_all = mysqli_num_rows($qry);

            if($row_all>0 || $row){
                $status = 0;
                $reminder = "您已经发布过一篇同名文章";
                $c->createUserRecordFile();
                $c->recordUserVisit("发表失败：".$a_title."，该目录下同名文章已经存在");
                echo $b->normalrespond($status,$reminder);
                //----------------------------------------------------------------------------------------------------->出口3：同样标题的文章已存在
            }else{

                //***将文章放入数据库.article表****//
                $uid = $_SESSION["uid"];
                $abc = create_Aid();
                $a_content = addslashes($a_content);
                //$a_content = htmlspecialchars($a_content);
                $sql = "INSERT INTO articles(id,aid,uid,time,title,content,txt_url) VALUES ('','$abc','$uid','$tnow','$a_title','$a_content','$file') ";
                $qry = $db->query($sql);
                if(!$qry){
                    $status = 0;
                    $reminder = "发表失败，没有成功提交。请联系管理员";
                    $c->createUserRecordFile();
                    $c->recordUserVisit("发表失败：".$a_title);
                    echo $b->normalrespond($status,$reminder);
                    //------------------------------------------------------------------------------------------------->出口3：文章入库失败
                }else{
                    $status = $abc;//把文章的aid当作statuscode输出
                    $reminder = "发表成功";
                    $c->createUserRecordFile();
                    $c->recordUserVisit("发表了文章：".$a_title);
                    echo $b->normalrespond($status,$reminder);
                    //------------------------------------------------------------------------------------------------->出口4：文章入库成功

                    //***将文章放进文件夹进行存档****//
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
                        //--------------------------------------------------------------------------------------------->出口5：该目录下同名文章已经存在
                    }

                    //**开始写入文档**//
                    @$filestream = fopen($file,"a");
                    //$a_content = "\xEF\xBB\xBF".$a_content;
                    @$d = fwrite($filestream,$a_content);
                    @fclose($filestream);
                    if(!$d){
                        $status = 0;
                        $reminder = "发表失败，可能是由于找不到用户文章根目录导致的，请联系管理员";
                        //--------------------------------------------------------------------------------------------->出口6：txt文件创建成功，但是文章记录失败**极严重错误
                        $c->createUserRecordFile();
                        $c->recordUserVisit("发表失败：".$a_title."，文章的在线记录出现错误");
                        echo $b->normalrespond($status,$reminder);
                        return false;
                    }

                }

            }

        }

    }























    //--->出口1：没有输入内容或标题
    //--->出口2：标题长度超过限制
    //--->出口3：插入数据库失败
    //--->出口4：
?>