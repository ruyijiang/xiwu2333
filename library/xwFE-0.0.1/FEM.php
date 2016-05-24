<?php
//本文件需要在主页面require之前require(all.php)，否则可能会报一些异常
?>
<?php
/*********************html头部输出*************************************/
if(isset($_SESSION['loginstatus']) == 1 && !empty($_SESSION['uid'])){
	$uid = $_SESSION['uid'];
	$sql = "SELECT avatar FROM users WHERE uid = $uid";
	$qry = $db->query($sql);
	$row = $qry->fetch_assoc();
	$useravatar = $row["avatar"];
	$username = $_SESSION["username"];
}

//********header-unregistered*******//未登陆的用户的头部
$header_unregistered = '<nav class="navbar navbar-inverse navbar-fixed-top" style="border-radius:0"><div class="container"><div class="navbar-header"><button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="navbar-brand" ui-sref="main" style="margin-right:20px;"><strong>喜屋</strong></a></div><div id="navbar" class="collapse navbar-collapse"><ul class="nav navbar-nav"><li><a ui-sref="main">首页</a></li><li><a ui-sref="userlist">玩家列表</a></li><li><a ui-sref="roomlist">房间列表</a></li></ul><ul class="navbar-right nav navbar-nav"><li class="dropdown"><a class="pull-left" ui-sref="login">登陆</a><a class="pull-left" ui-sref="signup">注册</a><a class="pull-left" ui-sref="activation">激活邀请码</a></div></nav>';

//********header-registered*********//登陆了的用户的头部
//里面还有几个和用户相关的变量,该变量需要获取用户信息之后才能填写
//也就是说，必须先获取用户信息，$header_registered才能正常使用//
@$header_registered = '<nav class="navbar navbar-inverse navbar-fixed-top" style="border-radius:0"><div class="container"><div class="navbar-header"><button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="navbar-brand" ui-sref="main"><strong>喜屋</strong></a></div><div id="navbar" class="collapse navbar-collapse"><ul class="nav navbar-nav"><li><a ui-sref="main">首页</a></li><li><a href="userlist.php" ui-sref="userlist">玩家列表</a></li><li><a ui-sref="roomlist">房间列表</a></li></ul><ul class="navbar-right nav navbar-nav"><li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img class="img-circle header-user-avatar" src="'.$useravatar.'"/>'.$username.'<span class="caret"></span></a><ul class="dropdown-menu navbar-right user_nav_bar"><li><a href="homepage.php?type=pulse&username='.$username.'"><span class="glyphicon glyphicon-home spanicon"></span>个人主页</a></li><li><a href="myroom.php?id='.$userroomid.'"><span class="glyphicon glyphicon-flag spanicon"></span>我的房间</a></li><li class="active"><a href="homepage.php?type=blog&username='.$username.'"><span class="glyphicon glyphicon-file spanicon"></span>我的文章</a></li><li><a><span class="glyphicon glyphicon-cog spanicon"></span>设置</a></li><li><a ng-click="logout()"><span class="glyphicon glyphicon-log-out spanicon"></span>退出登录</a></li><li role="separator" class="divider"></li><li class="dropdown-header">个人操作</li><li class="active"><a href="" data-toggle="tooltip" data-placement="bottom" title="开放组队状态下，您的消息将被提交到玩家列表，方便其它网友找到您。"><span class="glyphicon glyphicon-off spanicon"></span>开放组队<span class="glyphicon glyphicon-ok"></span></a></li><li role="separator" class="divider"></li><li class="dropdown-header">房间操作</li><li><a href="" data-toggle="tooltip" data-placement="bottom">完全开放</a></li><li><a href="" data-toggle="tooltip" data-placement="bottom">设密开放</a></li><li class="active"><a href="" data-toggle="tooltip" data-placement="bottom" title="">隐藏房间<span class="glyphicon glyphicon-ok"></span></a></li></ul></li></ul></div></div></nav>';
/********************************************************End*/


//****openupalertdiv******//开放组队提示框
//***直接放在头部下一行***//
$openupalertdiv = '<div class="alert alert-success col-xs-12 col-sm-12 text-center navbar-fixed-top" style="margin:50px 0 25px 0;z-index:1;border:none;"><img src="img/fragments/loading/5375751.gif" height="19" style="vertical-align:middle;margin-right:5px;margin-top:-4px"/>您当前正在开放组队</div>';


//********footer***********//页脚
$footer = '<footer><div class="clearfix"><div style="color:#999"><small>&copy; 2016 milo |</small><small>&nbsp;<span class="glyphicon glyphicon-envelope"></span> 意见反馈：<a href="mailto:#">1444828173@qq.com</a> |&nbsp;<span class="glyphicon glyphicon-book"></span> alpha - 0.1</small><small class="pull-right">若使用本网站提供的服务，则视为接受本网站<a href="">《服务条款说明》</a>中各项和<a href="">《诚信文明公约》</a>。</small></div></div></footer>';


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
$main_bg .= '<div class="jumbotron main-jumbotron"><img src="img/main_bg/'.$MainBgImgName.'" class="main-jumbotron-background-img center-block"/><h1 style="z-index:3;position:inherit">你好!</h1><p style="z-index:3;position:inherit"><strong>欢迎来到喜屋！这是一个帮助游戏玩家进行组队的网站</strong></p></div>';//最终生成前段模块的HTML部分


/**main页面的随机推荐的房间**/
/**该房间不能是设置密码的房间**/
$random_recommendation = '';

$EchartScript = "<script>";
$EchartScript .= "	 var myChart_most = echarts.init(document.getElementById('user-most'));	 option1 = {		tooltip : {			trigger: 'axis',			axisPointer : {            // 坐标轴指示器，坐标轴触发有效				type : 'line'        // 默认为直线，可选为：'line' | 'shadow'			}		},		grid: {			left: '1%',			right: '1%',			bottom: '5%',			top:'15%',			containLabel: true		},		xAxis : [			{				type : 'category',				data : ['广东','浙江','上海']			}		],		yAxis : [			{				type : 'value'			}		],		series : [			{				type:'bar',				data:[375, 332, 301]			},		]	};		 var myChart_ratio = echarts.init(document.getElementById('user-ratio'));	 option2 = {		series : [			{				type: 'pie',				radius : '55%',				data:[					{value:12, name:'女'},					{value:88, name:'男'}				],			}		],	};		 var myChart_online = echarts.init(document.getElementById('user-online'));	 option3 = {		tooltip: {			trigger: 'axis'		},		grid: {			left: '1%',			right: '10%',			bottom: '5%',			top: '15%',			containLabel: true		},		toolbox: {			feature: {				saveAsImage: {}			}		},		xAxis: {			type: 'category',			boundaryGap: false,			data: ['14:00','15:00','16:00','17:00','17:51']		},		yAxis: {			type: 'value'		},		series: [			{				name:'今天',				type:'line',				stack: '总量',				data:[75,120, 132, 101, 134]			}		]	};			//实例echart	myChart_most.setOption(option1);	myChart_ratio.setOption(option2);	myChart_online.setOption(option3);";
$EchartScript .= "</script>";



//********homepage的pulse视图块***********//
$HomePageView_Pulse = '<div class="liveness-sheet panel panel-default" style="margin-top:15px;">                    	<div class="panel-heading">活跃曲线</div><div class="panel-body" id="liveness-chart-body" style="height:260px;">                                                	</div></div><hr><h5><strong>最新动态</strong></h5><p>发表了&nbsp;<a href=""><span class="glyphicon glyphicon-file"></span>我的3月23日DOTA2一日游</a>&nbsp;一文</p><span></span><p>评价了&nbsp;<a href=""><span class="glyphicon glyphicon-user"></span>Zxc</a></p><p>评价了&nbsp;<a href=""><span class="glyphicon glyphicon-user"></span>MARTIN</a></p>';
//********homepage的article视图块***********//
$HomePageView_Article = '<div class="article-sheet" style="margin-top:15px;">                    	<a class="btn btn-danger pull-left" role="button" style="margin-right:5px;" ui-sref="writeblog"><span class="glyphicon glyphicon-pencil spanicon"></span>写文章</a>                    	<form>                        	<div class="input-group-container"><div class="input-group col-lg-5"><input type="text" class="form-control" placeholder="搜索"><span class="input-group-btn"><button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button></span></div></div></form><h5 class="pull-left" style="width:75px;padding-top:2px;color:#CCC">文章列表</h5><hr><div class="article clearfix">                        	<a href=""><h4><strong>我的3月23日DOTA2一日游</strong></h4></a><blockquote><h5>2016年3月24日，一个明媚的早晨<span>...</span></h5></blockquote><small class="pull-right"><time>3min 前</time></small></div><hr><div class="article clearfix">                        	<a href=""><h4><strong>我的3月24日DOTA2一日游</strong></h4></a><blockquote><h5>2016年3月24日，一个明媚的早晨<span>...</span></h5></blockquote><small class="pull-right"><time>昨天 16:24</time></small></div><hr><div class="col-lg-12 text-center"><nav><ul class="pagination"><li><a aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li><li><a>1</a></li><li><a>2</a></li><li><a>3</a></li><li><a>4</a></li><li><a>5</a></li><li><a aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li></ul></nav></div></div>';
//********homepage的pulse视图块***********//
$HomePageView_Assess = '<div class="comment-sheet" style="margin-top:15px;"><div class="article">                        	<blockquote class="clearfix">                            	<a href="" class="pull-left" data-toggle="tooltip" data-placement="bottom" data-original-title="Yado"><img src="img/user_img/avatar/622762d0f703918f331290f3523d269758eec4cc.jpg" class="img-responsive" style="height:42px;width:42px;"/></a><h5 class="pull-left" style="margin-left:20px;">这个人好坑的...</h5></blockquote><small class="pull-right"><time>3min 前</time></small></div><div class="article">                        	<blockquote class="clearfix">                            	<a href="" class="pull-left" data-toggle="tooltip" data-placement="bottom" data-original-title="shy"><img src="img/user_img/avatar/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" class="img-responsive" style="height:42px;width:42px;"/></a><h5 class="pull-left" style="margin-left:20px;">这个人好坑的...</h5></blockquote><small class="pull-right"><time>3min 前</time></small></div></div>';



?>