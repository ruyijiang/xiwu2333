<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/5/3
 * Time: 21:01
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
<div class="container" ng-controller="homepagecontroller" style="margin-top:130px;">
    <div class="row">
        <div class="per_s-leftpart col-lg-3 col-sm-3 col-xs-12 boat" style="padding: 0px">
            <ul class="nav nav-pills nav-stacked ">
                <li>
                    <a>资料设置</a>
                </li>
                <li>
                    <a>修改密码</a>
                </li>
                <li>
                    <a>开放组队设置</a>
                </li>
                <li class="active">
                    <a>实名验证</a>
                </li>
            </ul>
        </div><!--End of leftpart-->


        <div class="per_s-rightpart col-lg-9 col-sm-9 col-xs-12 row" style="min-height:300px;border-radius:4px;">
            <form class="form-horizontal" role="form">
                <div class="row boat">
                    <div class="form-group row col-lg-8">
                        <label class="col-lg-3 control-label">身份证号码</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" readonly value="120104199010161510">
                        </div>
                    </div>
                    <div class="form-group col-lg-8">
                        <label class="col-lg-3 control-label">绑定手机号</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" readonly value="18622039775">
                        </div>
                    </div>
                    <div class="form-group col-lg-8">
                        <label class="col-lg-3 control-label">绑定邮箱</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" readonly value="1444828173@qq.com">
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
