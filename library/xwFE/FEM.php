<?php
//本文件需要在主页面require之前require(all.php)，否则可能会报一些异常
?>
<?php
/*********************html头部输出*************************************/
$openteam_status = $openstatus_bar_class = "";
if(@$_SESSION['loginstatus'] == 1 && !empty($_SESSION['uid'])){

	$uid = $_SESSION['uid'];
	$sql = "SELECT avatar,name,openstatus FROM users WHERE uid = $uid";
	$qry = $db->query($sql);
	$row = $qry->fetch_assoc();
	//输出用户信息时使用的数据
	$useravatar = $row["avatar"];
	$username = $row["name"];


	//输出用户开放组队信息时使用的数据
	$result = $row["openstatus"];
	if($result == 1){
		$openteam_status = 1;
		$openstatus_bar_class = "active";
	}else{
		$openteam_status = 0;
		$openstatus_bar_class = "";
	}
}
//********header-unregistered*******//未登陆的用户的头部
$header_unregistered = '<nav style="z-index:999" class="navbar navbar-inverse navbar-fixed-top xw-topbar"><div class="container"><div class="navbar-header"><button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="navbar-brand" ui-sref="main" style="margin-right:20px;"><img src="img/fragments/logo/xiwu_circle.png" style="margin-top:-5px;margin-right:10px;display:inline-block;"/><strong>喜屋</strong></a></div><div id="navbar" class="collapse navbar-collapse"><ul class="nav navbar-nav"><li ng-class="{active:NowShowPage==1}"><a ui-sref="main">首页</a></li><li ng-class="{active:NowShowPage==2}"><a ui-sref="userlist">玩家列表</a></li><li ng-class="{active:NowShowPage==3}"><a ui-sref="square">社区广场</a></li></ul><ul class="navbar-right nav navbar-nav"><form class="navbar-form navbar-left" role="search" style="margin-top:11px" ng-submit="gosearch(searchParam,0)"><div class="form-group"><input ng-model="searchParam" type="search" class="form-control input-sm" placeholder="{{HotSearchingContent}} ↵" style="font-size:13px;min-width:210px;border-radius:3px;font-size:12px;border:none;outline:none"></div></form><li ng-class="{active:NowShowPage==5}"><a class="pull-left active" ui-sref="login">登陆</a></li><li ng-class="{active:NowShowPage==4}"><a class="pull-left" ui-sref="signup">注册</a></li><li><a class="pull-left" data-toggle="modal" data-target="#myModal">激活邀请码</a></li></div></nav>';

//********header-registered*********//登陆了的用户的头部
//里面还有几个和用户相关的变量,该变量需要获取用户信息之后才能填写
//也就是说，必须先获取用户信息，$header_registered才能正常使用//
@$header_registered = '<nav style="z-index:999" class="navbar navbar-inverse navbar-fixed-top xw-topbar"><div class="container"><div class="navbar-header"><button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="navbar-brand" ui-sref="main"><img src="img/fragments/logo/xiwu_circle.png" style="margin-top:-5px;margin-right:10px;display:inline;"/><strong>喜屋</strong></a></div><div id="navbar" class="collapse navbar-collapse"><ul class="nav navbar-nav"><li ng-class="{active:NowShowPage==1}"><a ui-sref="main">首页</a></li><li ng-class="{active:NowShowPage==2}"><a ui-sref="userlist">玩家列表</a></li><li ng-class="{active:NowShowPage==3}"><a ui-sref="square">社区广场</a></li></ul><ul class="navbar-right nav navbar-nav">
<form class="navbar-form navbar-left" role="search" style="margin-top:11px" ng-submit="gosearch(searchParam,0)"><div class="form-group"><input ng-model="searchParam" type="search" class="form-control input-sm" placeholder="{{HotSearchingContent}} ↵" style="font-size:13px;min-width:210px;border-radius:3px;font-size:12px;border:none;outline:none"></div></form><li class="dropdown text-center"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img class="img-circle header-user-avatar" src="'.$useravatar.'"/>'.$username.'<span class="caret"></span></a><ul class="dropdown-menu navbar-right user_nav_bar"><li ng-class="{active:NowShowPage==21}"><a ui-sref="myhome"><span class="glyphicon glyphicon-home spanicon"></span>个人主页</a></li><li ng-class="{active:NowShowPage==22}"><a ui-sref="info_setting"><span class="glyphicon glyphicon-cog spanicon"></span>设置</a></li><li><a data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-barcode"></span>激活邀请码</a></li><li><a ng-click="logout()"><span class="glyphicon glyphicon-log-out spanicon"></span>退出登录</a></li><li role="separator" class="divider"></li><li class="dropdown-header">常用操作</li><li ng-class="{active:NowShowPage==4}"><a ui-sref="writeblog"><span class="glyphicon glyphicon-log-out spanicon"></span>写文章</a></li><li class="queue-list '.$openstatus_bar_class.'"><a ng-click="openteamornot()" data-toggle="tooltip" data-placement="bottom" title="开放组队状态下，您的消息将出现在玩家列表，其它人会找到您。"><span class="glyphicon glyphicon-off spanicon"></span>开放组队</a></li></ul></div></div></nav>';
/********************************************************End*/
//****openupalertdiv******//开放组队提示框
//***直接放在头部下一行***//
if($openteam_status == 1){
	$openupalertdiv = '<div class="alert alert-success col-xs-12 col-sm-12 text-center navbar-fixed-top  queue-alert-bar"><img src="img/fragments/loading/5375751.gif" height="19" style="margin-right:5px;margin-top:-4px"/>您当前正在开放组队</div>';
}else{
	$openupalertdiv = "";
}

//********footer***********//页脚
$footer = '<footer><div class="clearfix"><div style="color:#999"><small>&copy; 2016 milo |</small><small>&nbsp;<span class="glyphicon glyphicon-envelope"></span> 意见反馈：<a href="mailto:#">1444828173@qq.com</a> |&nbsp;<span class="glyphicon glyphicon-book"></span> alpha - 0.5</small><small class="pull-right">若使用本网站提供的服务，则视为接受本网站<a ng-href="/#/blog?aid=ART_3570838131">《喜屋网服务协议》</a>中各项和<a ng-href="/#/blog?aid=ART_2343461185">《诚信文明倡议》</a>。</small></div></div></footer>';


/**main页面的欢迎巨幕**/
/**将../img/fragments/bgs/main-bgs/目录中的所有图片的名字取成数组*****/
$File_one_dir = './img/main_bg';
@$getDirFile = new getDirFile();
$getDirFile = $getDirFile->getFile($File_one_dir);
foreach($getDirFile as $_FileKey => $_FileName){
	$DotPosition = strrpos($_FileName,".") + 1;
	$FileType = substr($_FileName,$DotPosition);
	if($FileType !== "jpg" && $FileType !== "png" && $FileType !== "gif" ){
		//不是符合要求的图片文件,则剔除出文件名数组
		array_splice($getDirFile,$_FileKey,1);
	}
}
$FileCount = count($getDirFile);//得出一共有多少张图
$random_n = rand(0,$FileCount - 1);//随机生成一个数字
$MainBgImgName = $getDirFile[$random_n];//根据随机数随机抽取数组中存储的图片名称
$main_bg = '<style>.main-jumbotron{overflow:hidden;z-index:0;position:relative;background-color:#000;color:white;}.main-jumbotron-background-img{	position:absolute;	top:0px;	left:0px;	z-index:1;	opacity:0.35;	animation:main-jumbotron-backgroundposition 8.65s  forwards;	-webkit-animation:main-jumbotron-backgroundposition 8.65s  forwards;	animation-timing-function:ease-out;}@-webkit-keyframes main-jumbotron-backgroundposition{from {	width:917px;	height:353px;	opacity:0.35;}to {	width:1067px;	height:410px;	opacity:1;}}@keyframes main-jumbotron-backgroundposition{from {	width:917px;	height:353px;	opacity:0.35;}to {	width:1067px;	height:410px;	opacity:1;}}</style>';//最终生成前段模块的CSS部分
$main_bg .= '<div class="jumbotron main-jumbotron"><img src="img/main_bg/'.$MainBgImgName.'" class="main-jumbotron-background-img center-block"/><h1 style="z-index:3;position:inherit;letter-spacing:3px;font-weight:100">欢迎,</h1><p style="z-index:3;position:inherit;letter-spacing:3px;font-weight:100"><strong>喜屋是电竞玩家们的社区。</strong></p></div>';//最终生成前段模块的HTML部分