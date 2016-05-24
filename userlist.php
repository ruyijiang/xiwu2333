<!--喜屋是马子航milo，游戏id：shy开发的一款，旨在帮助游戏玩家寻找开黑好友的移动浏览器优先的网页应用-->
<!Doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width;initial-scale=1.0;maximum-scale=1.0;user-scalable=no;"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="喜屋,dota2,开黑,坑爹,大神,排位,天梯,电子竞技" />
<meta name="robots" content="none" />
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
<title>Dota2::玩家列表 - 喜屋</title>
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
            <li class="active"><a href="userlist.php">玩家列表</a></li>
            <li><a href="roomlist.php">房间列表</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li>
               <form class="navbar-form navbar-left"  role="search">
                     <div class="col-lg-11 form-group">
                        <div class="input-group">
                           <input type="text" class="form-control" placeholder="输入数字ID或昵称">
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
        
        <div class="col-sm-9 col-sm-offset-3 col-md-6 col-md-offset-2 main">
          <h1 class="page-header">网站Dota2统计</h1>

          <div class="row placeholders" style="margin-top:-25px">
            <div class="col-xs-6 col-sm-3 placeholder">
            	<div class="userlist-chart center-block" id="user-most"></div>
              <h4><strong>玩家最多</strong></h4>
              <span class="text-muted">广东省</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
            	<div class="userlist-chart center-block" id="user-ratio"></div>
              <h4><strong>男女比例</strong></h4>
              <span class="text-muted">88% - 12%</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
            	<div class="userlist-chart center-block" id="user-online" style="width:214px"></div>
              <h4><strong>当前在线玩家</strong></h4>
              <span class="text-muted">37</span>
            </div>
          </div>

          <h2 class="sub-header" style="margin-top:-25px"><img class="img-rounded" width="32" height="32" alt="Dota2ImgThumbnail32^2" src="img/fragments/icon/DOTA_32px_558493_easyicon.net.png"></img>Dota2 - 开放组队的玩家列表</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr class="info">
                  <th>游戏数字ID</th>
                  <th>昵称</th>
                  <th>性别</th>
                  <th>组队次数</th>
                  <th>组队次数</th>
                  <th>组队次数</th>
                  <th>组队次数</th>
                  <th>评分</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>252556081</td>
                  <td>shy</td>
                  <td>男</td>
                  <td>22</td>
                  <td>男</td>
                  <td>男</td>
                  <td>男</td>
                  <td>96</td>
                </tr>
                <tr>
                  <td>252556081</td>
                  <td>shy</td>
                  <td>男</td>
                  <td>22</td>
                  <td>男</td>
                  <td>男</td>
                  <td>男</td>
                  <td>96</td>
                </tr>
                <tr>
                  <td>252556081</td>
                  <td>shy</td>
                  <td>男</td>
                  <td>22</td>
                  <td>男</td>
                  <td>男</td>
                  <td>男</td>
                  <td>96</td>
                </tr>
                <tr>
                  <td>252556081</td>
                  <td>shy</td>
                  <td>男</td>
                  <td>22</td>
                  <td>男</td>
                  <td>男</td>
                  <td>男</td>
                  <td>96</td>
                </tr>
                <tr>
                  <td>252556081</td>
                  <td>shy</td>
                  <td>男</td>
                  <td>22</td>
                  <td>男</td>
                  <td>男</td>
                  <td>男</td>
                  <td>96</td>
                </tr>
                <tr>
                  <td>309449904</td>
                  <td>犯罪嫌疑人</td>
                  <td>男</td>
                  <td>3</td>
                  <td>男</td>
                  <td>男</td>
                  <td>男</td>
                  <td>81</td>
                </tr>
                <tr>
                  <td>309449904</td>
                  <td>犯罪嫌疑人</td>
                  <td>男</td>
                  <td>3</td>
                  <td>男</td>
                  <td>男</td>
                  <td>男</td>
                  <td>81</td>
                </tr>
                <tr>
                  <td>309449904</td>
                  <td>犯罪嫌疑人</td>
                  <td>男</td>
                  <td>3</td>
                  <td>男</td>
                  <td>男</td>
                  <td>男</td>
                  <td>81</td>
                </tr>
                <tr>
                  <td>309449904</td>
                  <td>犯罪嫌疑人</td>
                  <td>男</td>
                  <td>3</td>
                  <td>男</td>
                  <td>男</td>
                  <td>男</td>
                  <td>81</td>
                </tr>
                <tr>
                  <td>309449904</td>
                  <td>犯罪嫌疑人</td>
                  <td>男</td>
                  <td>3</td>
                  <td>男</td>
                  <td>男</td>
                  <td>男</td>
                  <td>81</td>
                </tr>
                <tr>
                  <td>309449904</td>
                  <td>犯罪嫌疑人</td>
                  <td>男</td>
                  <td>3</td>
                  <td>男</td>
                  <td>男</td>
                  <td>男</td>
                  <td>81</td>
                </tr>
                <tr>
                  <td>309449904</td>
                  <td>犯罪嫌疑人</td>
                  <td>男</td>
                  <td>3</td>
                  <td>男</td>
                  <td>男</td>
                  <td>男</td>
                  <td>81</td>
                </tr>
                <tr>
                  <td>309449904</td>
                  <td>犯罪嫌疑人</td>
                  <td>男</td>
                  <td>3</td>
                  <td>男</td>
                  <td>男</td>
                  <td>男</td>
                  <td>81</td>
                </tr>
                <tr>
                  <td>309449904</td>
                  <td>犯罪嫌疑人</td>
                  <td>男</td>
                  <td>3</td>
                  <td>男</td>
                  <td>男</td>
                  <td>男</td>
                  <td>81</td>
                </tr>
                <tr>
                  <td>309449904</td>
                  <td>犯罪嫌疑人</td>
                  <td>男</td>
                  <td>3</td>
                  <td>男</td>
                  <td>男</td>
                  <td>男</td>
                  <td>81</td>
                </tr>
                <tr>
                  <td>309449904</td>
                  <td>犯罪嫌疑人</td>
                  <td>男</td>
                  <td>3</td>
                  <td>男</td>
                  <td>男</td>
                  <td>男</td>
                  <td>81</td>
                </tr>
                <tr>
                  <td>309449904</td>
                  <td>犯罪嫌疑人</td>
                  <td>男</td>
                  <td>3</td>
                  <td>男</td>
                  <td>男</td>
                  <td>男</td>
                  <td>81</td>
                </tr>
                <tr>
                  <td>309449904</td>
                  <td>犯罪嫌疑人</td>
                  <td>男</td>
                  <td>3</td>
                  <td>男</td>
                  <td>男</td>
                  <td>男</td>
                  <td>81</td>
                </tr>
                <tr>
                  <td>309449904</td>
                  <td>犯罪嫌疑人</td>
                  <td>男</td>
                  <td>3</td>
                  <td>男</td>
                  <td>男</td>
                  <td>男</td>
                  <td>81</td>
                </tr>
              </tbody>
            </table>
            <div class="col-lg-12 text-center">
                <ul class="pagination pagination-lg">
                  <li><a href="#">&laquo;</a></li>
                  <li class="active"><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">&raquo;</a></li>
                </ul>
            </div>
          </div><!--table-striped-->
          
        </div><!--main-->
        <div class="col-lg-4 col-xm-12 gallery" style="margin-top:10px;padding-top:15px;">
           <!--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#gallery" aria-expanded="true" aria-controls="navbar">-->
            <a href="http://player.youku.com/player.php/sid/XMzAyMDc3OTQw/v.swf" target="_blank"class="sider-right-btn_1"></a>
            <a href="http://player.youku.com/player.php/sid/XNjg3OTcyNjMy/v.swf" target="_blank"class="sider-right-btn_2"></a>
        	<a href="http://www.dota2.com/comics/are_we_heroes_yet/" target="_blank" class="sider-right-btn_3"></a>
            <div class="well" style="width:256px;">
            	<small>如果本网站还不错的话。不妨点击下方按钮，收藏本站。</small>
                <button type="button" class="btn btn-primary btn-sm">收藏</button>
            </div>
        </div>
      </div>
    </div>
















<!--jQuery Js-->
<script  type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<!--Bootstrap Js-->
<script  type="text/javascript" src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<!--Echart Js-->
<script  type="text/javascript" src="library/Echart-3.1.4/echarts.simple.min.js"></script>
<script>
$(function () {
	$("[data-toggle='tooltip']").tooltip();//开启tooltip
	
	 /***初始化设置echart**/
	 var myChart_most = echarts.init(document.getElementById('user-most'));
	 option1 = {
		tooltip : {
			trigger: 'axis',
			axisPointer : {            // 坐标轴指示器，坐标轴触发有效
				type : 'line'        // 默认为直线，可选为：'line' | 'shadow'
			}
		},
		grid: {
			left: '1%',
			right: '1%',
			bottom: '5%',
			top:"15%",
			containLabel: true
		},
		xAxis : [
			{
				type : 'category',
				data : ['广东','浙江','上海']
			}
		],
		yAxis : [
			{
				type : 'value'
			}
		],
		series : [
			{
				type:'bar',
				data:[375, 332, 301]
			},
		]
	};
	
	 var myChart_ratio = echarts.init(document.getElementById('user-ratio'));
	 option2 = {
		series : [
			{
				type: 'pie',
				radius : '55%',
				data:[
					{value:12, name:'女'},
					{value:88, name:'男'}
				],
			}
		],
	};
	
	 var myChart_online = echarts.init(document.getElementById('user-online'));
	 option3 = {
		tooltip: {
			trigger: 'axis'
		},
		grid: {
			left: '1%',
			right: '10%',
			bottom: '5%',
			top: '15%',
			containLabel: true
		},
		toolbox: {
			feature: {
				saveAsImage: {}
			}
		},
		xAxis: {
			type: 'category',
			boundaryGap: false,
			data: ['14:00','15:00','16:00','17:00','17:51']
		},
		yAxis: {
			type: 'value'
		},
		series: [
			{
				name:'今天',
				type:'line',
				stack: '总量',
				data:[75,120, 132, 101, 134]
			}
		]
	};
	
	
	//实例echart
	myChart_most.setOption(option1);
	myChart_ratio.setOption(option2);
	myChart_online.setOption(option3);
	 
	 
});
</script>
</body>
</html>