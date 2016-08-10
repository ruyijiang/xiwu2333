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
              <h2>{{BlogExport.title}}</h2>
              <p><em class="blog-time">{{BlogExport.time}}</em></p>
              <div ng-if="BlogExport.permission == true">
                  <a role="button" class="btn btn-danger btn-xs" id="delete_a" ng-click="dialog_confirmdelete.open=true"><span class="glyphicon glyphicon-remove"></span>删除</a>
                  <!--<a role="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-print"></span>打印</a>-->
                  <a role="button" class="btn btn-default btn-xs" ng-href="/#/writeblog?aid={{BlogExport.aid}}"><span class="glyphicon glyphicon-edit"></span>修改</a>

              </div>
            
              <hr>

              <div class="a1_content_container" style="font: 14px/1.5 'Microsoft YaHei',arial,tahoma,\5b8b\4f53,sans-serif;letter-spacing:1px;" ng-bind-html="BlogExport.content|to_trusted">
              </div><!--End of a_content_container-->
          </div><!-- /.blog-post -->


          <nav>
            <ul class="pager">
              <li ng-if="BlogExport.prev_aid!=='' "><a ng-click="skiptoart(BlogExport.prev_aid)">&laquo;&nbsp;上一篇</a></li><!--ng-href="/#/blog?aid={{BlogExport.prev_aid}}"-->
              <li ng-if="BlogExport.next_aid!=='' "><a ng-click="skiptoart(BlogExport.next_aid)">下一篇&nbsp;&raquo;</a></li><!--ng-href="/#/blog?aid={{BlogExport.next_aid}}"-->
            </ul>
          </nav>

        </div><!-- /.blog-main -->
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-6 col-lg-offset-0 col-md-offset-0 col-sm-offset-0 col-xs-offset-3 blog-sidebar">
          <div class="user-avatar">
              <h5 style="border-bottom:solid #f1f1f1 1px;padding-bottom:5px">作者：</h5>
          	<a ng-href="/#/person?uid={{BlogExport.uid}}"><img ng-src="{{BlogExport.avatar}}" class="img-responsive img-rounded" width="198" height="198"/></a>
          </div>
          <div class="sidebar-module sidebar-module-inset" style="margin-top:15px">
            <strong style="font-size:19px;">{{BlogExport.name}}</strong><i class="iconfont icon-renzheng" style="font-size:22px;color:#d87f00;margin-left:5px" title="{{BlogExport.callingcard_name}}"></i>
            <p style="color:#999;font-size:13px;margin-top:5px">{{BlogExport.slogan}}</p>
          </div>
          <hr>
          <div class="sidebar-module">
            <h4><span class="glyphicon glyphicon-fire"></span><span ng-if="BlogExport.gender == '0'">他</span><span ng-if="BlogExport.gender == '1'">她</span>的热门</h4>
            <ol class="list-unstyled" style="margin-left:5px">
              <li ng-repeat="xhota in BlogExport.hotblog"><a ng-click="skiptoart(xhota.aid)"><span class="glyphicon glyphicon-file"></span>{{xhota.title}}</a></li>
            </ol>
            <small ng-if="BlogExportHotblogLen == 0">暂无其它</small>
          </div>
          <hr>
          <div class="sidebar-module">
            <h4><span class="glyphicon glyphicon-link"></span>其它平台</h4>
            <ol class="list-unstyled" style="margin-left:30px">
              <li ng-if="BlogExport.weibo_status == 1"><a ng-href="{{BlogExport.weibo}}" target="_blank">新浪微博</a></li>
              <li ng-if="BlogExport.liveplain_status == 1"><a ng-href="{{BlogExport.liveplain}}" target="_blank">斗鱼直播</a></li>
              <li ng-if="BlogExport.weibo_status == 0&&BlogExport.liveplain_status == 0"><small>暂无</small></li>
            </ol>
          </div>
        </div><!-- /.blog-sidebar -->

      </div><!-- /.row -->
        <dialog ng-if="dialog_confirmdelete.open" modal align="bottom" close="dialog_confirmdelete.open=false">
            <div dialog-content>{{dialog_confirmdelete.content}}</div>
            <div dialog-buttons><button autofocus ng-click="confirmDel(BlogExport.aid)">确定</button><button ng-click="$close()">取消</button></div>
        </dialog>
      <hr>

      <?php echo $footer;?>
    </div><!--container-->

    

<MyRoom></MyRoom>