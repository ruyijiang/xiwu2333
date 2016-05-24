<!--喜屋是马子航milo，游戏id：shy开发的一款，旨在帮助游戏玩家寻找开黑好友的移动浏览器优先的网页应用-->
<!Doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width;initial-scale=1.0;maximum-scale=1.0;user-scalable=no;"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="喜屋,dota2,开黑,坑爹,大神,排位,天梯,电子竞技" />
<meta name="robots" content="all" />
<meta name="author" content="shy" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="HandheldFriendly" content="true">
<meta name="full-screen" content="yes">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta http-equiv="Expires" content="0">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-control" content="no-cache">
<meta http-equiv="Cache" content="no-cache">
<!--<meta http-equiv="Pragma" content="no-cache">-->
<title>Dota2::房间列表 - 喜屋</title>
<!--Bootstrap Css-->
<link href="http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet"></link>
<link href="http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap-theme.min.css" rel="stylesheet"></link>
<link href="library/normalize.css/normalize-4.0.0.css" rel="stylesheet"></link>
<link href="library/bootstrap-3.3.5-dist/css/dashboard.css" rel="stylesheet"></link>
<link href="css/all.css" rel="stylesheet"></link>
<style>
</style>
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" style="border-radius:0">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#" style="margin-right:15px;"><strong>喜屋</strong></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="main.php">主页</a></li>
            <li><a href="userlist.php">玩家列表</a></li>
            <li class="active"><a href="">房间列表</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li>
               <form class="navbar-form navbar-left"  role="search">
                     <div class="col-lg-11 form-group">
                        <div class="input-group">
                           <input type="text" class="form-control" placeholder="在房间列表中搜索">
                           <span class="input-group-btn">
                              <button class="btn btn-primary" type="submit">
                                 <span class="glyphicon glyphicon-search"></span>
                              </button>
                           </span>
                        </div><!-- /input-group -->
                     </div><!-- /.col-lg-6 -->
               </form>
            </li> 
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">shy<span class="caret"></span></a>
              <ul class="dropdown-menu navbar-right user_nav_bar">
                <li><a href="homepage.php"><span class="glyphicon glyphicon-home"></span>个人主页</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-tower"></span>我的房间<span class="label label-danger media-middle">new</span></a></li>
                <li><a href="#"><span class="glyphicon glyphicon-cog"></span>设置</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-log-out"></span>退出登录</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="开放组队状态下，您的消息将被提交到玩家列表，方便其它网友找到您">开放组队</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->
    <div class="alert alert-success col-xs-12 col-sm-12 text-center navbar-fixed-top" style="margin:50px 0 25px 0;z-index:1"><span class="glyphicon glyphicon-globe"></span><strong>您当前正在开放组队</strong></div>




    <div class="container-fluid">
      <div class="row" style="margin-top:100px;">
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
        </div>
        
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h2 class="sub-header"><img src="img/fragments/icon/DOTA_32px_558493_easyicon.net.png" width="32" height="32" class="img-rounded" alt="Dota2ImgThumbnail32^2">Dota2 - 房间列表</h2>
          <div class="row">
          	<div class="col-lg-3">
            	<h3>烧花鸭的春夏秋冬<strong>(6/8)</strong><abbr title="烧鸭给群主起的中文名是什么？"><span class="glyphicon glyphicon-lock media-middle"></span></abbr></h3>
                <small style="display:block"><strong>房主说：</strong><span>Zxc群内战，只要彩笔！欢迎加群168632417</span></small>
                <a href="" style="position:relative;">
                	<img style="width:359px;height:198px" src="img/room_img/5506ef197f231twomwebsitescreensho.jpg" class="img-responsive"></img>
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
          	<div class="col-lg-3">
            	<h3>烧花鸭的春夏秋冬<strong>(6/6)</strong><abbr title="无提示"><span class="glyphicon glyphicon-lock media-middle"></span></abbr></h3>
                <small style="display:block"><strong>房主说：</strong><span>我很懒，一句话都懒得说</span></small>
                <a href="" style="position:relative;">
                	<img style="width:359px;height:198px" src="img/room_img/20130428100656532.jpg" class="img-responsive"></img>
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
          	<div class="col-lg-3">
            	<h3>烧花鸭的春夏秋冬<strong>(5/6)</strong><abbr title="无提示"></abbr></h3>
                <small style="display:block"><strong>房主说：</strong><span>阿拉法特dsafasd</span></small>
                <a href="" style="position:relative;">
                	<img style="width:359px;height:198px" src="img/room_img/2cf3b20e7bec54e7849b9c75bc389b504ec26ab6.jpg" class="img-responsive"></img>
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
          
          
          
          
          
          
          
          
			
        </div><!---->
      </div>
    </div>
















<!--jQuery Js-->
<script  type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<!--Bootstrap Js-->
<script  type="text/javascript" src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script>
$(function () { $("[data-toggle='tooltip']").tooltip(); });
</script>
</body>
</html>