<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/5/3
 * Time: 20:09
 */
?>

<?php
require("library/xwBE-0.0.1/connectDB.php");
require("library/xwBE-0.0.1/all.php");
include("library/xwFE-0.0.1/FEM.php");
?>
<style>
    body{background-color:#f5f8fa}
    .boat ul li>a{border-radius: 1px}
</style>
<div class="container" ng-controller="m_PasswordController" style="margin-top:130px;">

    <ol class="breadcrumb" style="background-color:white;border:solid 1px rgb(211, 224, 233)">
        <li><a ui-sref="info_setting">个人设置</a></li>
        <li class="active">修改密码</li>
    </ol>

    <div class="row">
        <div class="per_s-leftpart col-lg-3 col-sm-3 col-xs-12 boat" style="padding: 0px">
            <ul class="nav nav-pills nav-stacked ">
                <li>
                    <a ui-sref="info_setting">资料设置</a>
                </li>
                <li class="active">
                    <a ui-sref="m_password">修改密码</a>
                </li>
                <li>
                    <a ui-sref="createroom">房间设置</a>
                </li>
                <li>
                    <a ui-sref="certification">实名验证</a>
                </li>
            </ul>
        </div><!--End of leftpart-->


        <div class="per_s-rightpart col-lg-9 col-sm-9 col-xs-12 row" style="min-height:300px;border-radius:4px;">
            <form class="form-horizontal" role="form" ng-submit="submitData()">
                <div class="row boat">
                    <div class="form-group row col-lg-8">
                        <label for="oldpassword" class="col-lg-3 control-label">旧密码</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="oldpassword"
                                   placeholder="输入旧密码" ng-model="PasswordData.OldPassword">
                        </div>
                    </div>
                    <div class="form-group col-lg-8">
                        <label for="newpassword" class="col-lg-3 control-label">新密码</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="newpassword"
                                   placeholder="输入新密码" ng-model="PasswordData.NewPassword">
                        </div>
                    </div>
                    <div class="form-group col-lg-8">
                        <label for="newpassword_repeat" class="col-lg-3 control-label">重复新密码</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="newpassword_repeat"
                                   placeholder="重复新密码" ng-model="PasswordData.RepeatedPassword">
                        </div>
                    </div>
                </div><!--End of a boat-->


                <div class="row boat" style="padding:0">
                    <input type="submit" class="btn btn-lg btn-primary btn-block" value="完成提交">
                </div>
            </form>


        </div><!--End of leftpart-->
    </div><!--End of row-->
    <hr>
    <? echo $footer;?>



</div>

