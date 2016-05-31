<?php
require("library/xwBE-0.0.1/connectDB.php");
require("library/xwBE-0.0.1/all.php");
include("library/xwFE-0.0.1/FEM.php");
?>
<!--喜屋是milo独自开发的一款，游戏玩家的社区类型网页应用-->
<!Doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" ng-app="myApp" ng-controller="xiwucontroller">
<head>
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
	<title>喜屋</title>
	<!-- Bootstrap Css -->
	<link href="http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet"/>
	<link href="http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap-theme.min.css" rel="stylesheet"/>
	<link href="library/normalize.css/normalize-4.0.0.css" rel="stylesheet"/>
	<link href="library/bootstrap-3.3.5-dist/css/dashboard.css" rel="stylesheet"/>
	<link href="//at.alicdn.com/t/font_1464153446_4585128.css" rel="stylesheet"/>
	<link href="library/bootstrap-3.3.5-dist/css/bootstrap-slider.min.css" rel="stylesheet"/>
	<!-- All Css -->
	<link href="css/all.css" rel="stylesheet"/>
	<!-- AngularJs -->
	<script src="js/angular.min.js"></script>
</head>
<script>
	var SERVER_BASE = "localhost";
	var IndexPage = "main.php";
</script>
<body>

<?php
//输出header头部navi_bar
if(isset($_SESSION['loginstatus']) == 1 && !empty($_SESSION['uid'])){
	echo $header_registered;
}else{
	echo $header_unregistered;
}
?>
<?php
//输出header头部navi_bar
echo $openupalertdiv;
?>
<InvitationCode></InvitationCode>
<div ui-view class="ui-viewcon"></div>

<!-- /.modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top:10%">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h5 class="modal-title" id="myModalLabel">请输入邀请码</h5>
			</div>
			<div class="modal-body">
				<input type="text" class="form-control invitationcode_ipt" placeholder="格式应是：xxxxxxxx-xxxx-xxxx-xxxx-xxxxxx" maxlength="30" autocomplete="off" spellcheck="false" ng-model="iccode" ng-readonly="disableModalBtn">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" ng-disabled="disableModalBtn">取消</button>
				<button type="button" class="btn btn-primary" ng-disabled="disableModalBtn" ng-click="SendIccode()">确认</button>
			</div>
		</div>
	</div>
</div>

<!-- /.loading -->
<div class="index-mask">
	<img src="img/fragments/loading/5375751.gif" style="margin-top:23%">
</div>


<!-- UI router -->
<script src="http://apps.bdimg.com/libs/angular-ui-router/0.2.15/angular-ui-router.min.js"></script>
<!--jQuery Js-->
<script  type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<!--Bootstrap Js-->
<script  type="text/javascript" src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<!--Echart Js-->
<script  type="text/javascript" src="library/Echart-3.1.4/echarts.simple.min.js"></script>
<!--all.js-->
<script  type="text/javascript" src="js/all.js"></script>
<!-- angular-popups -->
<script  type="text/javascript" src="js/angular-popups.js"></script>
<!-- router-->
<script  type="text/javascript" src="js/router.js"></script>
<!-- utills -->
<script  type="text/javascript" src="js/utill/htmldecode.js"></script>
<script  type="text/javascript" src="js/utill/welcomejsonstring.js"></script>
<script  type="text/javascript" src="js/utill/alterLocalStorage.js"></script>
<script  type="text/javascript" src="js/utill/unique_inarr.js"></script>
<!-------------------------------------------------------------------------------------->
<!-- Ueditor Js-->
<!--<script id="ueditor-main" name="content" type="text/plain"></script>-->
<script type="text/javascript" src="library/ueditor-1.4.3.2/ueditor.config.js"></script>
<script type="text/javascript" src="library/ueditor-1.4.3.2/ueditor.all.min.js"></script>
<!-------------------------------------------------------------------------------------->
<!--services-->
<script src="js/service/snslogin/qq.js" type="text/javascript"></script>
<script src="http://connect.qq.com/widget/loader/loader.js" widget="shareqq" charset="utf-8"></script>
<script src="js/service/countLiveness.js" widget="shareqq" charset="utf-8"></script>
<!-------------------------------------------------------------------------------------->
<!--bootstrap-slider-->
<script  type="text/javascript" src="library/bootstrap-3.3.5-dist/js/bootstrap-slider.min.js"></script>
<!-------------------------------------------------------------------------------------->
<!--controllers-->
<script  type="text/javascript" src="js/controller/xiwucontroller.js"></script>
<script  type="text/javascript" src="js/controller/mainpagecontroller.js"></script>
<script  type="text/javascript" src="js/controller/userlistcontroller.js"></script>
<script  type="text/javascript" src="js/controller/roomlistcontroller.js"></script>
<script  type="text/javascript" src="js/controller/logincontroller.js"></script>
<script  type="text/javascript" src="js/controller/signupcontroller.js"></script>
<script  type="text/javascript" src="js/controller/blogpagecontroller.js"></script>
<script  type="text/javascript" src="js/controller/writeblogcontroller.js"></script>
<script  type="text/javascript" src="js/controller/homepagecontroller.js"></script>
<script  type="text/javascript" src="js/controller/personal_settingcontroller.js"></script>
<script  type="text/javascript" src="js/controller/createroomcontroller.js"></script>
<script  type="text/javascript" src="js/controller/info_SettingController.js"></script>
<script  type="text/javascript" src="js/controller/certificationController.js"></script>
<script  type="text/javascript" src="js/controller/m_passwordController.js"></script>
<script  type="text/javascript" src="js/controller/personpageController.js"></script>
<!-------------------------------------------------------------------------------------->
<!--direcitves-->
<script  type="text/javascript" src="js/directive/useInvitationCode/useInvitationCode.js"></script>
<!--<script  type="text/javascript" src="js/directive/MyTeam.js"></script>-->
<!-------------------------------------------------------------------------------------->
</body>
</html>