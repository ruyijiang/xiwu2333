<?php
require("library/xwBE-0.0.1/connectDB.php");
require("library/xwBE-0.0.1/all.php");
include("library/xwFE-0.0.1/FEM.php");
header("Content-Type: text/html; charset=utf-8");
?>
<div class="container" ng-controller="blogpagecontroller" style="margin-top:100px;">

    <div class="row">
        <div class="col-sm-8">
            <?php
            @$aid = $_POST["aid"];//文章id
            $aid = 4;
            $sql = "SELECT * FROM articles WHERE aid = '$aid' ";
            $qry = $db->query($sql);
            $row = $qry->fetch_assoc();
            $result_title = $row["title"];//文章标题
            $result_time = $row["time"];//文章创建时间
            @$result_Uri = $row["txt_url"];//文章txt所在路径
            @$result_content = $row["content"];//数据库中记载的文章正文
            @empty($result_title)?$result_title="标题获取错误":$result_title;
            @empty($result_time)?$result_time="创建时间获取错误":$result_time;



            ?>

            <div class="blog-post a_content_container" style="overflow: hidden; word-wrap: break-word;">
                <h2><? echo $result_title?></h2>
                <p><em class="blog-time"><? echo $result_time?></em></p>
                <div>
                    <a role="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove"></span>删除</a>
                    <!--<a role="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-print"></span>打印</a>-->
                    <a role="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit"></span>修改</a>

                    <!--<div style="display:inline-block;margin-left:10px;">
                        <div class="share_hiddendiv">
                            <i class="icon-weibo2 iconfont blogpage-i-icon" data-toggle="tooltip" data-placement="top" data-original-title="分享到微博"></i>
                            <i class="icon-weixin2 iconfont blogpage-i-icon" data-toggle="tooltip" data-placement="top" data-original-title="分享到微信"></i>
                            <i class="icon-qq2 iconfont blogpage-i-icon" data-toggle="tooltip" data-placement="top" data-original-title="分享到qq"></i>
                        </div>
                    </div>-->
                </div>

                <hr>

                <div class="a1_content_container">
                    <?php
                    if(empty($result_content) || !$row["content"]){
                        //如果存在uri（即数据库出错了），则通过uri打开txt文件，然后读取、输出
                        //否则直接拿取表中content字段输出，不过这可能会导致一些不明错误
                        //读取存档txt文件
                        $prefix = "";
                        $folder = $prefix."product/articles/".$_SESSION["uid"]."/";
                        $file = $folder.$result_title.".txt";
                        @$a = fopen($file,"r");
                        if(!$a){
                            echo "<span style='color:darkred'>抱歉，获取文章存档失败，请联系管理员或客服。</span>";
                        }
                        @readfile($file);
                    }else{
                        //正常情况下，则通过表里content字段直接输出文章正文
                        $a_content = $result_content;
                        echo $a_content;
                    }
                    ?>
                </div><!--End of a_content_container-->
            </div><!-- /.blog-post -->


            <nav>
                <ul class="pager">
                    <li><a href="#">&laquo;&nbsp;前一篇</a></li>
                    <li><a href="#">后一篇&nbsp;&raquo;</a></li>
                </ul>
            </nav>

        </div><!-- /.blog-main -->
        <?php
        $uid = $_SESSION["uid"];
        $sql2 = "SELECT * FROM users WHERE uid = '$uid' ";
        $qry2 = $db->query($sql2);
        $row2 = $qry2->fetch_assoc();
        $result2_avatar = $row2["avatar"];//用户头像路径
        $result2_name = "shy";//用户昵称
        $result2_slogan = "这个家伙很懒，连个P都没留下";//用户个人签名
        ?>
        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
            <div class="user-avatar">
                <a href=""><img src="<? echo $result2_avatar;?>" class="img-responsive img-rounded" width="198" height="198"/></a>
            </div>
            <div class="sidebar-module sidebar-module-inset">
                <h2><? echo $result2_name?></h2>
                <p><? echo $result2_slogan?></p>
            </div>
            <hr>
            <div class="sidebar-module">
                <h4><span class="glyphicon glyphicon-fire"></span>热门</h4>
                <ol class="list-unstyled">
                    <li><a href="#"><span class="glyphicon glyphicon-file"></span>我的电子竞技之路</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-file"></span>喜屋[公开征集]网站LOGO</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-file"></span>当我在做喜屋时，我到底在做什么？</a></li>
                </ol>
            </div>
            <hr>
            <!-- <div class="sidebar-module">
               <h4><span class="glyphicon glyphicon-calendar"></span>归档</h4>
               <ol class="list-unstyled">
                 <li><a href="#">2016年3月</a></li>
                 <li><a href="#">2016年3月</a></li>
                 <li><a href="#">2016年3月</a></li>
                 <li><a href="#">2016年3月</a></li>
                 <li><a href="#">2016年3月</a></li>
                 <li><a href="#">2016年3月</a></li>
                 <li><a href="#">2016年3月</a></li>
                 <li><a href="#">2016年3月</a></li>
                 <li><a href="#">2016年3月</a></li>
                 <li><a href="#">2016年3月</a></li>
                 <li><a href="#">2016年3月</a></li>
                 <li><a href="#">2016年3月</a></li>
               </ol>
             </div>
             <hr>-->
            <div class="sidebar-module">
                <h4><span class="glyphicon glyphicon-link"></span>其它平台</h4>
                <ol class="list-unstyled">
                    <li><a href="#">新浪微博</a></li>
                    <li><a href="#">斗鱼直播</a></li>
                </ol>
            </div>
        </div><!-- /.blog-sidebar -->

    </div><!-- /.row -->
    <hr>

    <?php echo $footer;?>
</div><!--container-->





<MyRoom></MyRoom>