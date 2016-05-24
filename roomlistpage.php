<?php
require("library/xwBE-0.0.1/connectDB.php");
require("library/xwBE-0.0.1/all.php");
include("library/xwFE-0.0.1/FEM.php");
?>
<div class="container-fluid" ng-controller="roomlistController">
      <div class="row" style="margin-top:80px;">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">概览<span class="sr-only">(current)</span></a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li class="panel-heading">按性别：</li>
            <li><a href="">男</a></li>
            <li><a href="">女</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li class="panel-heading">按分区：</li>
            <li><a href="">电信</a></li>
            <li><a href="">联通</a></li>
          </ul>
            <ul class="nav nav-sidebar">
                <li class="panel-heading">按状态：</li>
                <li><a>不需密码</a></li>
                <li><a>即将人满</a></li>
            </ul>
        </div>
        
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h2 class="sub-header"><img src="img/fragments/icon/DOTA_32px_558493_easyicon.net.png" width="32" height="32" class="img-rounded" alt="Dota2ImgThumbnail32^2" style="margin-top:-6px;margin-right:3px">Dota2 - 房间列表</h2>
          <div class="row roomlistrow">
          	<div class="col-lg-4 col-md-6">
            	<h3>烧花鸭的春夏秋冬<strong>(6/8)</strong><abbr title="烧鸭给群主起的中文名是什么？"><i class="iconfont icon-lock roomlistlock"></i></abbr></h3>
                <small style="display:block"><strong>房主说：</strong><span>Zxc群内战，只要彩笔！欢迎加群168632417</span></small>
                <a href="" style="position:relative;">
                	<img style="width:100%;height:198px" src="img/room_img/5506ef197f231twomwebsitescreensho.jpg" class="img-responsive"/>
                </a>
                <h5 class="clearfix">
                	<div class="pull-left">
                      <span class="label label-primary">相声</span>
                      <span class="label label-primary">小品</span>
                      <span class="label label-primary">魔术</span>
                      <span class="label label-primary">杂技</span>
                    </div>
                	<div class="pull-right">
                      <span class="label label-warning">需要密码</span>
                    </div>
                </h5>
                <small><strong>创建者：</strong><a href="">shy</a></small>
                <small style="overflow:hiddenl;text-overflow:ellipsis;"><strong>成员：</strong><a href="">zxc</a>，<a href="">xixixi瓜</a>，<a href="">MARTIN</a>，<a href="">Yado</a>，<a href="">Yuki</a>，<a href="">月启</a>，<a href="">月启</a></small>
                <small style="display:block"><strong>最近一次游戏时间：</strong><span>2016-3-24 23:42</span></small>
                <small style="display:block">
                	<strong>主要分区：</strong>
                    <span class="label label-default">电信(上海)</span>
                    <span class="label label-default">电信(浙江)</span>
                    <span class="label label-default">电信(广东)</span>
                </small>
                <p class="pull-right">
                </p>
            </div>
          	<div class="col-lg-4 col-md-6">
            	<h3>烧花鸭的春夏秋冬<strong>(6/8)</strong><abbr title="烧鸭给群主起的中文名是什么？"><span class="glyphicon glyphicon-lock media-middle"></span></abbr></h3>
                <small style="display:block"><strong>房主说：</strong><span>Zxc群内战，只要彩笔！欢迎加群168632417</span></small>
                <a href="" style="position:relative;">
                	<img style="width:100%;height:198px" src="img/room_img/5506ef197f231twomwebsitescreensho.jpg" class="img-responsive"></img>
                    <span class="room-vacancy">差2人</span>
                </a>
                <h5 class="clearfix">
                	<div class="pull-left">
                      <span class="label label-primary">相声</span>
                      <span class="label label-primary">小品</span>
                      <span class="label label-primary">魔术</span>
                      <span class="label label-primary">杂技</span>
                    </div>
                	<div class="pull-right">
                      <span class="label label-warning">需要密码</span>
                    </div>
                </h5>
                <small><strong>创建者：</strong><a href="">shy</a></small>
                <small style="overflow:hiddenl;text-overflow:ellipsis;"><strong>成员：</strong><a href="">zxc</a>，<a href="">xixixi瓜</a>，<a href="">MARTIN</a>，<a href="">Yado</a>，<a href="">Yuki</a>，<a href="">月启</a>，<a href="">月启</a></small>
                <small style="display:block"><strong>最近一次游戏时间：</strong><span>2016-3-24 23:42</span></small>
                <small style="display:block">
                	<strong>主要分区：</strong>
                    <span class="label label-default">电信(上海)</span>
                    <span class="label label-default">电信(浙江)</span>
                    <span class="label label-default">电信(广东)</span>
                </small>
                <p class="pull-right">
                </p>
            </div>
          	<div class="col-lg-4 col-md-6">
            	<h3>烧花鸭的春夏秋冬<strong>(6/8)</strong><abbr title="烧鸭给群主起的中文名是什么？"><span class="glyphicon glyphicon-lock media-middle"></span></abbr></h3>
                <small style="display:block"><strong>房主说：</strong><span>Zxc群内战，只要彩笔！欢迎加群168632417</span></small>
                <a href="" style="position:relative;">
                	<img style="width:100%;height:198px" src="img/room_img/5506ef197f231twomwebsitescreensho.jpg" class="img-responsive"></img>
                    <span class="room-vacancy">差2人</span>
                </a>
                <h5 class="clearfix">
                	<div class="pull-left">
                      <span class="label label-primary">相声</span>
                      <span class="label label-primary">小品</span>
                      <span class="label label-primary">魔术</span>
                      <span class="label label-primary">杂技</span>
                    </div>
                	<div class="pull-right">
                      <span class="label label-warning">需要密码</span>
                    </div>
                </h5>
                <small><strong>创建者：</strong><a href="">shy</a></small>
                <small style="overflow:hiddenl;text-overflow:ellipsis;"><strong>成员：</strong><a href="">zxc</a>，<a href="">xixixi瓜</a>，<a href="">MARTIN</a>，<a href="">Yado</a>，<a href="">Yuki</a>，<a href="">月启</a>，<a href="">月启</a></small>
                <small style="display:block"><strong>最近一次游戏时间：</strong><span>2016-3-24 23:42</span></small>
                <small style="display:block">
                	<strong>主要分区：</strong>
                    <span class="label label-default">电信(上海)</span>
                    <span class="label label-default">电信(浙江)</span>
                    <span class="label label-default">电信(广东)</span>
                </small>
                <p class="pull-right">
                </p>
            </div>
          	<div class="col-lg-4 col-md-6">
            	<h3>烧花鸭的春夏秋冬<strong>(6/6)</strong><abbr title="无提示"><span class="glyphicon glyphicon-lock media-middle"></span></abbr></h3>
                <small style="display:block"><strong>房主说：</strong><span>我很懒，一句话都懒得说</span></small>
                <a href="" style="position:relative;">
                	<img style="width:100%;height:198px" src="img/room_img/20130428100656532.jpg" class="img-responsive"></img>
                </a>
                <h5 class="clearfix">
                	<div class="pull-left">
                      <span class="label label-primary">相声</span>
                      <span class="label label-primary">小品</span>
                      <span class="label label-primary">魔术</span>
                      <span class="label label-primary">杂技</span>
                    </div>
                	<div class="pull-right">
                      <span class="label label-warning">需要密码</span>
                      <span class="label label-danger">人满为患</span>
                    </div>
                </h5>
                <small><strong>创建者：</strong><a href="">shy</a></small>
                <small style="overflow:hiddenl;text-overflow:ellipsis;"><strong>成员：</strong><a href="">zxc</a>，<a href="">xixixi瓜</a>，<a href="">MARTIN</a>，<a href="">Yado</a>，<a href="">Yuki</a>，<a href="">月启</a>，<a href="">月启</a></small>
                <small style="display:block"><strong>最近一次游戏时间：</strong><span>2016-3-24 23:42</span></small>
                <small style="display:block">
                	<strong>主要分区：</strong>
                    <span class="label label-default">电信(上海)</span>
                    <span class="label label-default">电信(浙江)</span>
                    <span class="label label-default">电信(广东)</span>
                </small>
                <p class="pull-right">
                </p>
            </div>
          	<div class="col-lg-4 col-md-6">
            	<h3>烧花鸭的春夏秋冬<strong>(5/6)</strong><abbr title="无提示"></abbr></h3>
                <small style="display:block"><strong>房主说：</strong><span>阿拉法特dsafasd</span></small>
                <a href="" style="position:relative;">
                	<img style="width:100%;height:198px" src="img/room_img/2cf3b20e7bec54e7849b9c75bc389b504ec26ab6.jpg" class="img-responsive"></img>
                    <span class="room-vacancy">差1人</span>
                </a>
                <h5 class="clearfix">
                	<div class="pull-left">
                      <span class="label label-primary">相声</span>
                      <span class="label label-primary">小品</span>
                      <span class="label label-primary">魔术</span>
                      <span class="label label-primary">杂技</span>
                    </div>
                	<div class="pull-right">
                      <span class="label label-success">可进</span>
                    </div>
                </h5>
                <small><strong>创建者：</strong><a href="">shy</a></small>
                <small style="overflow:hiddenl;text-overflow:ellipsis;"><strong>成员：</strong><a href="">zxc</a>，<a href="">xixixi瓜</a>，<a href="">MARTIN</a>，<a href="">Yado</a>，<a href="">Yuki</a>，<a href="">月启</a>，<a href="">月启</a></small>
                <small style="display:block"><strong>最近一次游戏时间：</strong><span>2016-3-24 23:42</span></small>
                <small style="display:block">
                	<strong>主要分区：</strong>
                    <span class="label label-default">电信(上海)</span>
                    <span class="label label-default">电信(浙江)</span>
                    <span class="label label-default">电信(广东)</span>
                </small>
                <p class="pull-right">
                </p>
            </div>
            
          </div><!--row-->
          
          
          
          
          
          
          
          <hr>
            <?php echo $footer;?>
            </div>