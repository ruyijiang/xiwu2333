<?php
require("library/xwBE-0.0.1/connectDB.php");
require("library/xwBE-0.0.1/all.php");
include("library/xwFE-0.0.1/FEM.php");
?>
<!--欢迎来到喜屋-->
<!Doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" ng-app="myApp" ng-controller="xiwucontroller">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="喜屋,dota2,开黑,坑爹,大神,排位,天梯,电子竞技" />
	<meta name="robots" content="all" />
	<meta name="author" content="milo" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="HandheldFriendly" content="true">
	<meta name="full-screen" content="yes">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta http-equiv="Expires" content="0">
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Cache-control" content="no-cache">
	<meta http-equiv="Cache" content="no-cache">
	<title>{{NowPageTitle}}</title>

	<!-- Bootstrap Css -->
	<link href="//cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
	<link href="//cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap-theme.min.css" rel="stylesheet">
	<link href="css/normalize-4.0.0.css" rel="stylesheet"/>
	<link href="css/dashboard.css" rel="stylesheet"/>
	<link href="//at.alicdn.com/t/font_1472482956_7149565.css" rel="stylesheet"/>
	<link href="css/bootstrap-slider.min.css" rel="stylesheet"/>
	<!-- All Css -->
	<link href="css/all.css" rel="stylesheet"/>
	<!-- AngularJs -->
	<script src="js/vendor/angular.min.js"></script>

</head>
<script>
	var SERVER_BASE = "localhost";
	var IndexPage = "index.php";
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

<!--ui-view-->
<div ui-view class="ui-viewcon"></div>

<!-- 邀请码 -->
<invitation-code></invitation-code>

<!-- loading -->
<div class="index-mask">
    <img src="img/fragments/loading/5375751.gif" style="margin-top:23%">
</div>

<script src="//cdn.bootcss.com/angular-ui-router/0.2.15/angular-ui-router.min.js"></script>
<script src="//cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script  type="text/javascript" src="js/vendor/echarts.min.js"></script>
<script  type="text/javascript" src="js/vendor/angular-validation.js"></script>
<script  type="text/javascript" src="js/vendor/angular-validation-rule.js"></script>
<!-------------------------------------------------------------------------------------->
<script  type="text/javascript" src="js/run.js"></script>
<script  type="text/javascript" src="js/utill/all.js"></script>
<script  type="text/javascript" src="js/vendor/angular-popups.js"></script>
<script  type="text/javascript" src="js/router.js"></script>
<script  type="text/javascript" src="js/utill/htmldecode.js"></script>
<script  type="text/javascript" src="js/utill/welcomejsonstring.js"></script>
<script  type="text/javascript" src="js/utill/alterLocalStorage.js"></script>
<script  type="text/javascript" src="js/utill/unique_inarr.js"></script>
<!-------------------------------------------------------------------------------------->
<script type="text/javascript" src="library/ueditor-1.4.3.2/ueditor.config.js"></script>
<script type="text/javascript" src="library/ueditor-1.4.3.2/ueditor.all.min.js"></script>
<!-------------------------------------------------------------------------------------->
<script src="js/service/checkStatus.js" type="text/javascript"></script>
<script src="js/service/countLiveness.js" type="text/javascript"></script>
<script src="js/service/loadAndsaveHerosInfo.js" type="text/javascript"></script>
<script src="js/service/search.js" type="text/javascript"></script>
<!-------------------------------------------------------------------------------------->
<script  type="text/javascript" src="js/vendor/bootstrap-slider.min.js"></script>
<!-------------------------------------------------------------------------------------->
<script  type="text/javascript" src="js/controller/xiwucontroller.js"></script>
<script  type="text/javascript" src="js/controller/maincontroller.js"></script>
<script  type="text/javascript" src="js/controller/userlistcontroller.js"></script>
<script  type="text/javascript" src="js/controller/logincontroller.js"></script>
<script  type="text/javascript" src="js/controller/signupcontroller.js"></script>
<script  type="text/javascript" src="js/controller/writeblogcontroller.js"></script>
<script  type="text/javascript" src="js/controller/blogpagecontroller.js"></script>
<script  type="text/javascript" src="js/controller/createroomcontroller.js"></script>
<script  type="text/javascript" src="js/controller/info_SettingController.js"></script>
<script  type="text/javascript" src="js/controller/certificationController.js"></script>
<script  type="text/javascript" src="js/controller/m_passwordController.js"></script>
<script  type="text/javascript" src="js/controller/personpageController.js"></script>
<script  type="text/javascript" src="js/controller/searchController.js"></script>
<script  type="text/javascript" src="js/controller/communityController.js"></script>
<script  type="text/javascript" src="js/controller/topicController.js"></script>
<script  type="text/javascript" src="js/controller/404.js"></script>
<!-------------------------------------------------------------------------------------->
<script  type="text/javascript" src="js/directive/useInvitationCode/useInvitationCode.js"></script>
</body>
</html>