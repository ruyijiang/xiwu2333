
    <div class="container center-block col-lg-12 col-sm-12" style="margin-top:100px;" ng-controller="signupcontroller">
        <div class="col-lg-4 col-sm-4"></div>
        <div class="row clearfix col-lg-4 col-sm-4">
            <form class="form-signup" name="SignupForm" role="form" novalidate>
                <h2 class="form-signup-heading">新用户注册</h2>

                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-envelope spanicon"></span>注册邮箱</span>
                    <input validator="email" message-id="email" type="text" class="form-control" placeholder="常用邮箱" aria-describedby="basic-addon1" name="email" autocomplete="off" ng-model="UserName">
                </div>
                <span id="email"></span>

                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-option-horizontal spanicon"></span>新建密码</span>
                    <input minlength="8" maxlength="24" validator="Xiwupassword" message-id="password" type="password" class="form-control" aria-describedby="basic-addon1" placeholder="请输入一个常用密码" name="password" ng-model="UserPassword">
                </div>
                <span id="password"></span>

                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-option-horizontal spanicon"></span>确认密码</span>
                    <input minlength="8" maxlength="24" validator="Xiwupassword" message-id="repeatpw" type="password" class="form-control" aria-describedby="basic-addon1" placeholder="重复上述密码" name="repeatpw" ng-model="UserPassword_Repeat">
                </div>
                <span id="repeatpw"></span>

                <p style="margin-top:15px">性别</p>
                <div class="btn-group" role="group" aria-label="...">
                    <button type="button" class="btn btn-default" ng-click="Gender = 'male'" ng-class="{active:Gender == 'male'}">男</button>
                    <button type="button" class="btn btn-default" ng-click="Gender = 'female'" ng-class="{active:Gender == 'female'}">女</button>
                </div>

                <input class="btn btn-lg btn-primary btn-block" type="submit" style="margin-top:25px;" validation-submit="SignupForm" ng-click="form.submit()" value="注册"/>
            </form>
            <div class="otherlogindiv">
                <small class="pull-left" style="margin-top:4px">使用其它社交账号登陆：</small>
                <div class="clearfix otherlogindiv_div">
                  <a class="weibolog pull-left" ng-click="tellmemore()"></a>
                  <a class="qqlog pull-left" ng-click="loginqq()"></a>
                </div>
            </div>
        </div><!--row-->
    </div><!--container-->
        
    <style>
        body{background-color:#eee}
    </style>