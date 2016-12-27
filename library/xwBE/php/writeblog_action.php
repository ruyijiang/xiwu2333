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
require("../algorithm/AbstractofArticle.php");
require("../algorithm/Liveness.php");
?>
<?php
    @$aType = $_POST["aType"];
    @$a_title = $_POST["title"];
    @$subtitle = $_POST["subtitle"];
    @$abstract = $_POST["abstract"];
    @$a_content = $_POST["content"];
    @$cover_img = $_POST["cover_img"];
    @$bg_color = $_POST["bg_color"];
    @$BtnContent = $_POST["BtnContent"];
    @$aid = $_POST["aid"];
    @$ArtLength = $_POST["alength"];

    $uid = $_SESSION["uid"];

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

            if(!empty($aid)){
                //指定了aid,说明是修改
                $sql = "SELECT * FROM articles WHERE aid = '$aid' ";
                $qry = $db->query($sql);
                @$row = $qry->fetch_assoc();
                $row_all = mysqli_num_rows($qry);
                if($row_all>1){
                    $status = 0;
                    $reminder = "存在多个相同编号的文章，无法为您拉取信息，请联系管理员。";
                    echo $b->normalrespond($status,$reminder);
                    //------------------------------------------------------------------------------------------------->出口8：存在一篇以上同名文章
                }else if($row_all<=0){
                    $status = 0;
                    $reminder = "不存在此文章";
                    echo $b->normalrespond($status,$reminder);
                    //------------------------------------------------------------------------------------------------->出口9：并不存在该文章s
                }else{

                    if($aType == "normal"){
                        $sql = "UPDATE `articles` SET content = '$a_content',title = '$a_title',subtitle = '$abstract',article_img = '$cover_img' WHERE aid = '$aid' AND uid = '$uid' ";
                    }else if($aType == "cover"){
                        $sql = "UPDATE `covers` SET content = '$a_content',title = '$a_title',subtitle='$subtitle',abstract = '$abstract',cover_img='$cover_img',bg_color='$bg_color',btn_content='$BtnContent' WHERE cover_id = '$aid' AND uid = '$uid' ";
                    }else{
                        $status = 0;
                        $reminder = "没有对应类型的文章分类，请重新填写";
                        echo $b->normalrespond($status,$reminder);
                        //--------------------------------------------------------------------------------------------->出口12：文章更新失败
                        return false;
                    }
                    $qry = $db->query($sql);
                    if($qry){

                        //计算活跃度
                        $thisScore = countScore('writeBlog',$ArtLength);
                        $d = new liveness();
                        if($d->setLiveness('UpdateBlog',$thisScore)){
                            $status = $aid;
                            $reminder = "文章修改成功";
                        }else{
                            $status = 0;
                            $reminder = "文章修改失败";
                        }
                        echo $b->normalrespond($status,$reminder);
                        //--------------------------------------------------------------------------------------------->出口10：文章更新成功
                    }else{
                        $status = 0;
                        $reminder = "文章修改时数据库插入失败，请联系管理员";
                        echo $b->normalrespond($status,$reminder);
                        //--------------------------------------------------------------------------------------------->出口11：文章更新失败
                    }
                }

            }else{

                //没有指定aid,说明是新建
                $sql = "SELECT * FROM articles WHERE title = '$a_title' ";
                $qry = $db->query($sql);
                @$row = $qry->fetch_assoc();
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
                    $a_DataBaseContent = addslashes($a_content);
                    if(empty($abstract)){
                        $a_AbNeededContent = getAbstract(strip_tags($a_content));
                    }else{
                        $a_AbNeededContent = $abstract;
                    }

                    if($aType == "normal"){
                        $abc = create_Aid('article');
                        $sql = "INSERT INTO `articles`(id,aid,uid,time,title,content,txt_url,article_img,subtitle) VALUES ('','$abc','$uid','$tnow','$a_title','$a_DataBaseContent','$file','$cover_img','$a_AbNeededContent') ";
                    }else if($aType == "cover"){
                        $abc = create_Aid('cover');
                        $sql = "INSERT INTO `covers`(id,cover_id,uid,title,subtitle,abstract,cover_img,bg_color,btn_content,content,regtime,remark) VALUES ('','$abc','$uid','$a_title','$subtitle','$a_AbNeededContent','$cover_img','$bg_color','$BtnContent','$a_content','$tnow','') ";
                    }else{
                        $status = 0;
                        $reminder = "没有对应类型的文章分类，请重新填写";
                        echo $b->normalrespond($status,$reminder);
                        //--------------------------------------------------------------------------------------------->出口12：文章更新失败
                        return false;
                    }
                    $qry = $db->query($sql);
                    if(!$qry){
                        $status = 0;
                        $reminder = "发表失败，没有成功提交。请联系管理员";
                        $c->createUserRecordFile();
                        $c->recordUserVisit("发表失败：".$a_title);
                        echo $b->normalrespond($status,$reminder);
                        //------------------------------------------------------------------------------------------------->出口3：文章入库失败
                    }else{
                        $c->createUserRecordFile();
                        $c->recordUserVisit("发表了文章：".$a_title);

                        //计算活跃度
                        $thisScore = countScore('writeBlog',$ArtLength);
                        $d = new liveness();
                        if($d->setLiveness('writeBlog',$thisScore)){
                            $status = $abc;
                            $reminder = "文章发布成功";
                        }else{
                            $status = 0;
                            $reminder = "文章发布失败";
                        }
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

    }























    //--->出口1：没有输入内容或标题
    //--->出口2：标题长度超过限制
    //--->出口3：插入数据库失败
    //--->出口4：
?>