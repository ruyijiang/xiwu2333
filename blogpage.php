<?php
require("library/xwBE-0.0.1/connectDB.php");
require("library/xwBE-0.0.1/all.php");
include("library/xwFE-0.0.1/FEM.php");
header("Content-Type: text/html; charset=utf-8");
?>
    <div class="container" ng-controller="blogpagecontroller" style="margin-top:100px;">

      <div class="row">
        <div class="col-lg-9 col-md-8 col-sm-7 col-xs-12" >
          <div class="blog-post a_content_container" style="overflow: hidden; word-wrap: break-word;">
              <h2>{{BlogExport.title}}</h2>
              <p>
                  <em class="blog-time">{{BlogExport.time}}</em>
                  <a style="display:inline-block;margin-left:10px" style="padding-bottom:15px"><span class="glyphicon glyphicon-comment" style="display:inline-block;margin-right:2px;"></span>{{commentsLen}}条评论</a>
              </p>
              <div ng-if="BlogExport.permission == true">
                  <a role="button" class="btn btn-danger btn-xs" id="delete_a" ng-click="dialog_confirmdelete.open=true"><span class="glyphicon glyphicon-remove"></span>删除</a>
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


            <hr>
            <form role="form" class="row">
                <div class="col-lg-1 col-md-1 col-sm-2 col-xs-1 form-group">
                    <img ng-src="{{BlogExport.avatar}}" class="img-rounded" width="54" height="54"/>
                </div>
                <div class="col-lg-11 col-md-11 col-sm-10 col-xs-11 form-group comment_main">
                    <textarea class="form-control comment-textarea" style="resize: vertical;padding:8px;font-size:14px" rows="4" ng-model="comment_content"></textarea>
                    <div class="arrow_icon"></div>
                    <a class="btn btn-primary center-block" style="margin-top:3px" ng-disabled="comment_content==''" ng-click="sendcomment()">评论</a>
                </div>
            </form>
            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-1"></div>
            <div class="comments_shower col-lg-11 col-md-11 col-sm-10 col-xs-11" id="comments_shower">
                <div ng-repeat="xcom in comments track by $index">
                    <div class="row comments_shower_con">
                        <div class="col-lg-1 col-md-1 col-sm-2 col-xs-1">
                            <img ng-src="{{xcom.from_avatar}}" class="img-rounded" width="54" height="54"/>
                        </div>
                        <div class="col-lg-11 col-md-11 col-sm-10 col-xs-11">
                            <a style="font-weight:600" ng-href="/#/person?uid={{xcom.from_uid}}">{{xcom.from_name}}</a>
                            <span style="font-size:13px;margin-left:5px">- {{xcom.regtime}}</span>
                            <p style="margin-top:6px"><small ng-if="xcom.to_id">回复 <a ng-href="/#/person?uid={{xcom.to_id}}">{{xcom.to_name}}</a>：</small>{{xcom.content}}</p>
                        </div>
                    </div>
                    <div class="row comment_shower_scul">
                        <div class="col-lg-1 col-md-1 col-sm-2 col-xs-1"></div>
                        <div class="col-lg-11 col-md-11 col-sm-10 col-xs-11">
                            <div class="comment_shower_buttons clearfix">
                                <a ng-class="{active:commentAreaShower == $index}" ng-click="commentthis($index)"><span class="glyphicon glyphicon-comment"></span>评论</a>
                            </div>
                            <form class="clearfix" role="form" style="padding-bottom:10px" ng-show="commentAreaShower == $index">
                                <textarea class="form-control" style="resize:vertical;padding:8px;font-size:13px" rows="2" ng-model="xcom.new_content"></textarea>
                                <a class="btn btn-primary pull-right" style="margin-top:3px;padding:5px 20px" ng-init="xcom.new_content=''" ng-disabled="xcom.new_content==''" ng-click="sendcomment(xcom.from_uid,xcom.new_content)">评论</a>
                            </form>
                        </div>
                    </div>
                </div><!--End of comment_1-->

            </div>

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