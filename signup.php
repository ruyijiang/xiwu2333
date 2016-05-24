<?php
require("library/xwBE-0.0.1/all.php");
require("library/xwBE-0.0.1/connectDB.php");
include("library/xwFE-0.0.1/FEM.php");
?>
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
<title>注册 - 喜屋</title>
<!--Bootstrap Css-->
<link href="http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet"></link>
<link href="http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap-theme.min.css" rel="stylesheet"></link>
<link href="library/normalize.css/normalize-4.0.0.css" rel="stylesheet"></link>
<link href="css/all.css" rel="stylesheet"></link>
</head>
<style>
body {
  background-color: #eee;
}
.form-signin {
  max-width: 450px;
}
.input-group{
	margin-bottom:15px;
}
</style>
<body>
	<?php echo $header_unregistered;?>
	<div class="container">
			<div class="row col-lg-12 col-sm-12 clearfix center-block">
              <form class="form-signin center-block">
                <h2 class="form-signin-heading">新用户注册</h2>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-envelope spanicon"></span>邮箱</span>
                  <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1"><span class="
glyphicon glyphicon-option-horizontal spanicon"></span>密码</span>
                  <input type="password" class="form-control" placeholder="Username" aria-describedby="basic-addon1" data-toggle="tooltip" data-placement="bottom" data-original-title="字母和数字的组合">
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">确认密码</span>
                  <input type="password" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
                </div>
                	<p>性别</p>
                <div class="btn-group" role="group" aria-label="...">
                  <button type="button" class="btn btn-default">男</button>
                  <button type="button" class="btn btn-default">女</button>
                </div>
       			<button class="btn btn-lg btn-primary btn-block" type="submit" style="margin-top:25px;">注册</button>
              </form>
            </div><!--row-->
    </div><!--container-->
            
            
            
    <div class="container" style="margin-top:20px;">
    </div><!--/.container-->









<!--Angular Js-->
<script  type="text/javascript" src="http://apps.bdimg.com/libs/angular.js/1.4.6/angular.min.js"></script>
<!--jQuery Js-->
<script  type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<!--Bootstrap Js-->
<script  type="text/javascript" src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script>
$(function () { $("[data-toggle='tooltip']").tooltip(); });
</script>
</body>
</html>