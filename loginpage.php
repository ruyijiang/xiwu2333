<?php
require("library/xwBE-0.0.1/connectDB.php");
require("library/xwBE-0.0.1/all.php");
include("library/xwFE-0.0.1/FEM.php");
?>
<div class="container col-lg-12 col-sm-12" style="margin-top:100px" ng-controller="loginController">
    <div class="alert alert-info text-center center-block" role="alert" style="margin-top:-35px;width:100%" ng-if="showStepReminder == true">
        <button type="button" class="close" data-dismiss="alert"
                aria-hidden="true">
            &times;
        </button>
        <i class="iconfont icon-alert"></i>
        暂时无法浏览相关内容，请先登录 &nbsp;|&nbsp; <a ng-href="/#/signup">还没有账号？</a>
    </div>

    <div class="col-lg-4 col-sm-4"></div>
        <div class="row col-lg-4 col-sm-4 clearfix center-block">
          <form class="form-signin center-block" ng-submit="loginsubmit()">
            <h2 class="form-signin-heading">请登陆</h2>

            <div>
                <label for="inputEmail" class="sr-only">邮箱：</label>
                <input validator="email" type="text" id="inputEmail" class="form-control" placeholder="请输入邮箱" autocomplete="off" ng-model="UserName">
            </div>

            <div>
                <label for="inputPassword" class="sr-only">密码：</label>
                <input validator="Xiwupassword" type="password" id="inputPassword" class="form-control" placeholder="密码" minlength="8" ng-model="UserPassword">
            </div>

            <!--<div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me" checked="checked">记住密码
              </label>
              <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" data-original-title="在公共计算机上不建议勾选"></span>
            </div>-->
            <div class="btn-group" style="margin-top:15px">
              <button type="button" class="btn btn-default" ui-sref="signup"><small>还没有账号?</small></button>
              <input type="submit" class="btn btn-primary" value="登陆&raquo;" />
            </div>
          </form>
        <div class="otherlogindiv" style="margin-top:25px">
            <small class="pull-left" style="margin-top:4px">使用其它社交账号登陆：</small>
            <div class="clearfix otherlogindiv_div">
              <a class="weibolog pull-left" ng-click="loginqq()"></a>
              <a class="qqlog pull-left" ng-click="loginqq()"></a>
            </div>
        </div>
        </div><!--row-->
</div><!--container-->

<style>
    body{background-color:#eee}
</style>