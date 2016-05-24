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
<div class="container" ng-controller="certificationController" style="margin-top:130px;">

    <ol class="breadcrumb" style="background-color:white;border:solid 1px rgb(211, 224, 233)">
        <li><a ui-sref="info_setting">个人设置</a></li>
        <li class="active">实名认证</li>
    </ol>

    <div class="row">
        <div class="per_s-leftpart col-lg-3 col-sm-3 col-xs-12 boat" style="padding: 0px">
            <ul class="nav nav-pills nav-stacked ">
                <li>
                    <a ui-sref="info_setting">资料设置</a>
                </li>
                <li>
                    <a ui-sref="m_password">修改密码</a>
                </li>
                <li>
                    <a ui-sref="createroom">房间设置</a>
                </li>
                <li class="active">
                    <a ui-sref="certification">实名验证</a>
                </li>
            </ul>
        </div><!--End of leftpart-->


        <div class="per_s-rightpart col-lg-9 col-sm-9 col-xs-12 row" style="min-height:300px;border-radius:4px;">
            <?php
                $uid = $_SESSION["uid"];
                $password = $_SESSION["userpassword"];
                $sql = "SELECT idcard,tel,email FROM users WHERE uid = '$uid' AND password = '$password' ";
                $qry = $db->query($sql);
                $row = $qry->fetch_assoc();

                $result_idcard = $row["idcard"];
                $result_tel = $row["tel"];
                $result_email = $row["email"];
            ?>
            <form class="form-horizontal" role="form">
                <div class="row boat">
                    <div class="form-group row col-lg-8">
                        <label class="col-lg-3 control-label">身份证号码</label>
                        <div class="col-lg-7">
                            <input id="idcard_ipt" type="text" class="form-control" ng-readonly="!IdCardEditable" value="<? echo $result_idcard;?>">
                        </div>
                        <a title="修改" class="col-lg-2" style="margin-left:-15px" ng-if="!IdCardEditable" ng-click="changeEditability(1)"><span class="glyphicon glyphicon-pencil" style="padding-top: 15px;margin-left:0"></span></a>
                        <a role="button" class="btn btn-primary col-lg-2" style="margin-left:-10px" ng-if="IdCardEditable" ng-click="submitData(1)">保存</a>
                    </div>
                    <div class="form-group col-lg-8">
                        <label class="col-lg-3 control-label">绑定手机号</label>
                        <div class="col-sm-7">
                            <input id="tel_ipt" type="text" class="form-control" ng-readonly="!TelEditable" value="<? echo $result_tel;?>">
                        </div>
                        <a title="修改" class="col-lg-1" style="margin-left:-15px" ng-if="!TelEditable" ng-click="changeEditability(2)"><span class="glyphicon glyphicon-pencil" style="padding-top: 15px;margin-left:0"></span></a>
                        <a role="button" class="btn btn-primary col-lg-2" style="margin-left:-10px" ng-if="TelEditable" ng-click="submitData(2)">保存</a>
                    </div>
                    <div class="form-group col-lg-8">
                        <label class="col-lg-3 control-label">绑定邮箱</label>
                        <div class="col-lg-7">
                            <input id="email_ipt" type="text" class="form-control" ng-readonly="!EmailEditable" value="<? echo $result_email;?>">
                        </div>
                        <a title="修改" class="col-lg-1" style="margin-left:-15px" ng-if="!EmailEditable" ng-click="changeEditability(3)"><span class="glyphicon glyphicon-pencil" style="padding-top: 15px;margin-left:0"></span></a>
                        <a role="button" class="btn btn-primary col-lg-2" style="margin-left:-10px" ng-if="EmailEditable" ng-click="submitData(3)">保存</a>
                    </div>
                </div><!--End of a boat-->

            </form>


        </div><!--End of leftpart-->
    </div><!--End of row-->
    <hr>
    <? echo $footer;?>



</div>
