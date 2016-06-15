<?php
require("library/xwBE-0.0.1/connectDB.php");
require("library/xwBE-0.0.1/all.php");
include("library/xwFE-0.0.1/FEM.php");
header("Content-Type: text/html; charset=utf-8");
?>
    <div class="container" ng-controller="blogpagecontroller" style="margin-top:100px;">

      <div class="row">
        <div class="col-lg-9 col-md-8 col-sm-7 col-xs-12" >
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

              <div class="a1_content_container" style="font: 14px/1.5 'Microsoft YaHei',arial,tahoma,\5b8b\4f53,sans-serif;letter-spacing:1px;">
              关于您的个人信息<code>Hello World</code>
              　　豆瓣严格保护您个人信息的安全。我们使用各种安全技术和程序来保护您的个人信息不被未经授权的访问、使用或泄露。
              　　豆瓣会在法律要求或符合豆瓣的相关服务条款、软件许可使用协议约定的情况下透露您的个人信息，或者有充分理由相信必须这样做才能：(a) 满足法律或行政法规的明文规定，或者符合豆瓣网站适用的法律程序；（b）符合豆瓣相关服务条款、软件许可使用协议的约定；(c) 保护豆瓣的权利或财产，以及 (d) 在紧急情况下保护豆瓣员工、豆瓣产品或服务的用户或大众的个人安全。
              　　豆瓣不会未经您的允许将这些信息与第三方共享，本声明已经列出的上述情况除外。
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
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-4 col-lg-offset-0 col-md-offset-0 col-sm-offset-0 col-xs-offset-4 blog-sidebar">
          <div class="user-avatar">
              <h5 style="border-bottom:solid #f1f1f1 1px;padding-bottom:5px">作者：</h5>
          	<a href=""><img src="<? echo $result2_avatar;?>" class="img-responsive img-rounded" width="198" height="198"/></a>
          </div>
          <div class="sidebar-module sidebar-module-inset">
            <h2><? echo $result2_name?></h2>
            <p><? echo $result2_slogan?></p>
          </div>
          <hr>
          <div class="sidebar-module">
            <h4><span class="glyphicon glyphicon-fire"></span>热门</h4>
            <ol class="list-unstyled" style="margin-left:5px">
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
            <ol class="list-unstyled" style="margin-left:30px">
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