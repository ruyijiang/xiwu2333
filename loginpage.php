
	
	<div class="container col-lg-12 col-sm-12" style="margin-top:100px" ng-controller="loginController">
        <div class="col-lg-4 col-sm-4"></div>
			<div class="row col-lg-4 col-sm-4 clearfix center-block">
              <form class="form-signin center-block" ng-submit="loginsubmit()">
                <h2 class="form-signin-heading">请登陆</h2>
                <label for="inputEmail" class="sr-only">邮箱：</label>
                <input type="text" id="inputEmail" class="form-control" placeholder="请输入邮箱" required autofocus autocomplete="off" ng-model="UserName">
                <label for="inputPassword" class="sr-only">密码：</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="密码" required ng-model="UserPassword">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="remember-me">记住密码
                  </label>
                  <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" data-original-title="在公共计算机上不建议勾选"></span>
                </div>
                <div class="btn-group">
                  <button type="button" class="btn btn-default" ui-sref="signup"><small>还没有账号?</small></button>
                  <input type="submit" class="btn btn-primary" value="登陆&raquo;" />
                </div>
              </form>
            <div class="otherlogindiv">
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