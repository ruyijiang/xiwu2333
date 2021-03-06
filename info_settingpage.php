<?php
require("library/xwBE/connectDB.php");
require("library/xwBE/all.php");
include("library/xwFE/FEM.php");
?>
<style>
    body{background-color:#f5f8fa}
    .boat ul li>a{border-radius: 1px}
    label.error{color:red;font-weight:normal;margin:15px 5px;cursor:pointer;}
</style>
<div class="container" ng-controller="info_SettingController" style="margin-top:130px;">

    <ol class="breadcrumb" style="background-color:white;border:solid 1px rgb(211, 224, 233)">
        <li><a ui-sref="info_setting">个人设置</a></li>
        <li class="active">资料设置</li>
    </ol>

    <div class="row">
        <div class="per_s-leftpart col-lg-3 col-sm-3 col-xs-12 boat" style="padding: 0px">
            <ul class="nav nav-pills nav-stacked ">
                <li class="active">
                    <a ui-sref="info_setting">资料设置</a>
                </li>
                <li>
                    <a ui-sref="m_password">修改密码</a>
                </li>
                <!--<li>
                    <a ui-sref="createroom">房间设置</a>
                </li>-->
                <li>
                    <a ui-sref="certification">实名验证</a>
                </li>
            </ul>
        </div><!--End of leftpart-->
        <?php
            @$uid = $_SESSION["uid"];
            $sql = "SELECT * FROM users WHERE uid = '$uid' ";
            $qry = $db->query($sql);
            $row = $qry->fetch_assoc();
            $result_email = $row["email"];
        ?>

        <div class="per_s-rightpart col-lg-9 col-sm-9 col-xs-12 row" style="min-height:300px;border-radius:4px;">
                <form class="form-horizontal form-horizontal demo-form" novalidate role="form" id="info_setting_form" name="info_settingForm">
                    <div class="row boat">
                        <div class="per_s_content-basicinfo col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-3 control-label">用户id</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static dischangable-text"><?echo $uid;?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputNickname" class="col-lg-3 control-label">用户名</label>
                                <div class="col-sm-9">
                                    <input validator="required" minlength="4" maxlength="26" type="text" class="form-control" name="inputname" id="inputname" placeholder="请输入昵称" ng-model="UserInfoData.name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">邮箱</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static dischangable-text"><?echo $result_email;?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">性别</label>
                                <div class="btn-group col-lg-9 btn-group-sm" role="group" aria-label="...">
                                    <button type="button" class="usergender btn btn-default" ng-class="{active:UserInfoData.gender=='0'}" ng-click="UserInfoData.gender='0'" value="男">男</button>
                                    <button type="button" class="usergender btn btn-default" ng-class="{active:UserInfoData.gender=='1'}" ng-click="UserInfoData.gender='1'" value="女">女</button>
                                </div>
                            </div>
                            <div id="reminder_div" style="background-color:#f8f8f8;width:500px;"></div>
                            <div id="reminder_div2" style="background-color:#999;width:500px;"></div>
                        </div><!--End of basicinfo-->

                        <div class="per_s_content-avatar col-lg-6">
                            <img title="点击修改头像" ng-src="{{UserInfoData.avatar}}" class="img-circle center-block" width="198" height="198" style="border:dashed #999 1px;cursor: pointer;" ng-click="uploadAvatarDialog={open: true}"/>
                        </div><!--End of avatar-->
                    </div><!--End of a boat-->

                    <div class="row boat">
                        <div class="per_s_content-extrainfo">


                            <div class="extrarow-2 row">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">常驻服务器</label>
                                    <div class="btn-group col-lg-9 btn-group-sm" role="group">
                                        <button type="button" class="userserver btn btn-default" ng-class="{active:ServerList.UserServer_sh==1}" value="电信（上海）" ng-click="changeServer('sh')">电信（上海）</button>
                                        <button type="button" class="userserver btn btn-default" ng-class="{active:ServerList.UserServer_zj==1}" value="电信（浙江）" ng-click="changeServer('zj')">电信（浙江）</button>
                                        <button type="button" class="userserver btn btn-default" ng-class="{active:ServerList.UserServer_gd==1}" value="电信（广东）" ng-click="changeServer('gd')">电信（广东）</button>
                                        <button type="button" class="userserver btn btn-default" ng-class="{active:ServerList.UserServer_hz==1}" value="电信（华中）" ng-click="changeServer('hz')">电信（华中）</button>
                                        <button type="button" class="userserver btn btn-default" ng-class="{active:ServerList.UserServer_lt==1}" value="联通" ng-click="changeServer('lt')">联通</button>
                                    </div>
                                </div>
                            </div><!--End of extrarow-x-->


                            <div class="extrarow-6 col-lg-12 row">
                                <div class="form-group">
                                    <label class="col-sm-2 col-lg-2 control-label" for="dota2id">Dota2数字ID</label>
                                    <div class="col-sm-4 col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="iconfont icon-dota2" style="color:#942f24;"></i></span>
                                            <input validator="dota2Uid" minlength="5" maxlength="10" type="text" class="form-control" message-id="dota2id_span" id="dota2id" name="dota2id" ng-model="UserInfoData.dota2_uid">
                                        </div>
                                        <span id="dota2id_span"></span>
                                    </div>
                                    <div class="col-sm-6 col-lg-6 text-left" style="padding-top:5px;margin-left:-15px">
                                        <i class="iconfont icon-alert" style="color:#337ab7;cursor:pointer;" id="dota2uid_reminder" ng-click="showTooltips()"></i>
                                    </div>

                                    <dialog ng-if="tooltips.open" for="dota2uid_reminder" align="top" close="tooltips.open=false">
                                        <div dialog-title>建议填写</div>
                                        <div dialog-content>如果您不填写此项，我们将无法获取您的Dota2游戏信息。</div>
                                    </dialog>

                                </div>
                            </div><!--End of extrarow-x-->


                            <div class="extrarow-1 col-lg-12 row">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="select_city">所在地</label>
                                    <div class="btn-group col-lg-2 btn-group-sm" role="group" aria-label="...">
                                        <select class="form-control" ng-disabled="1==1" readonly="readonly" ng-model="UserInfoData.country">
                                            <option ng-selected="1==1">中国</option>
                                        </select>
                                    </div>
                                    <p class="pull-left" style="padding-top:5px;">-</p>
                                    <!--省份信息select标签-->
                                    <div class="btn-group col-lg-2 btn-group-sm" role="group" aria-label="...">
                                        <select class="form-control" id="select_city" name="select_city" ng-change="onRegionSelected('中国',UserInfoData.province)" ng-model="UserInfoData.province">
                                            <option>北京市</option>
                                            <option>上海市</option>
                                            <option>天津市</option>
                                            <option>重庆市</option>
                                            <option>江苏省</option>
                                            <option>浙江省</option>
                                            <option>广东省</option>
                                            <option>湖南省</option>
                                        <?php
                                            $sql2 = "SELECT REGION_NAME FROM region WHERE PARENT_ID = '1' ";
                                            $qry2 = $db->query($sql2);
                                            while($row2 = $qry2->fetch_assoc()){
                                                $result2 = $row2["REGION_NAME"];
                                                if($result2 !== "北京市" && $result2 !== "上海市" && $result2 !== "天津市" && $result2 !== "重庆市" && $result2 !== "江苏省" && $result2 !== "浙江省" && $result2 !== "湖南省" && $result2 !== "广东省"){
                                                    echo '<option>'.$result2.'</option>';
                                                }
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <!--End of 省份select标签-->

                                    <p ng-if="UserInfoData.province !== ''" class="pull-left" style="padding-top:5px;">-</p>
                                    <div class="btn-group col-lg-2 btn-group-sm" role="group" aria-label="...">
                                        <select class="form-control" ng-if="UserInfoData.province !== ''" ng-model="UserInfoData.city">
                                            <option ng-repeat="city in CityListArr" ng-if="city !== '' ">{{city}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div><!--End of extrarow-x-->

                            <div class="extrarow-6 col-lg-12 row">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="telnum">绑定手机</label>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">+86</span>
                                            <input validator="newtelnumber" maxlength="11" type="text" class="form-control" message-id="telnum_span" id="telnum" name="telnum" ng-model="UserInfoData.tel">
                                        </div>
                                        <span id="telnum_span"></span>
                                    </div>
                                </div>
                            </div><!--End of extrarow-x-->

                            <div class="extrarow-4 col-lg-12 row">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="qqnum">QQ</label>
                                    <div class="col-sm-4">
                                        <input validator="newqq" minlength="4" maxlength="11" type="text" class="form-control" name="qqnum" id="qqnum" ng-model="UserInfoData.qq">
                                    </div>
                                    <!--<a><span class="glyphicon glyphicon-plus-sign" style="padding-top: 15px;margin-left:0"></span></a>-->
                                </div>
                            </div><!--End of extrarow-x-->

                            <div class="extrarow-5 col-lg-12 row">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="wechat_name">微信</label>
                                    <div class="col-sm-4">
                                        <input validator="newwechat" type="text" class="form-control" id="wechat_name" name="wechat_name" ng-model="UserInfoData.weixin">
                                    </div>
                                </div>
                            </div><!--End of extrarow-x-->

                            <div class="extrarow-3 col-lg-12 row">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="weibo_url">新浪微博</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-weibo_origin iconfont"></i></span>
                                            <input validator="newurl" message-id="weibo_url_span" id="weibo_url" name="weibo_url" type="url" class="form-control" placeholder="输入您新浪微博的网址链接（URL）" ng-model="UserInfoData.weibo">
                                        </div>
                                        <span id="weibo_url_span"></span>
                                    </div>
                                </div>
                            </div><!--End of extrarow-x-->

                            <div class="extrarow-5 col-lg-12 row">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="liveplain">直播平台</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="spanicon" style="margin:0"></span></span>
                                            <input validator="newurl" message-id="liveplain_url_span" id="liveplain" name="liveplain" type="url" class="form-control" placeholder="输入您直播间的网址链接（URL）" ng-model="UserInfoData.liveplain">
                                        </div>
                                        <span id="liveplain_url_span"></span>
                                    </div>
                                </div>
                            </div><!--End of extrarow-x-->
                        </div><!--End of extrainfo-->

                    </div><!--End of a boat-->

                    <div class="row boat" style="padding:0">
                        <input validation-submit="info_settingForm" ng-click="form.submit()" type="submit" class="btn btn-lg btn-primary btn-block" value="完成提交">
                    </div>
                </form>


        </div><!--End of leftpart-->
    </div><!--End of row-->

    <!--ng-popup-->
    <dialog ng-if="dialog.open" duration="700" fixed close="dialog.open=false">
        <div dialog-content>{{dialog.content}}</div>
    </dialog>

    <!--上传头像-->
    <dialog ng-if="uploadAvatarDialog.open" modal close="uploadAvatarDialog.open=false">
        <div dialog-title>修改头像</div>
        <div dialog-content>
            <small>三种尺寸的预览：</small>
            <form id="submit_form" method="POST" ng-submit="checkBtnStatus()" action="library/xwBE/php/uploadavatar_action.php" target="uploadAvatar" enctype="multipart/form-data">
                <table style="text-align: center;">
                    <tr>
                        <td style="padding:10px">
                            <div class="apreview_container">
                                <img id="newavatar_198c" ng-src="{{UserInfoData.avatar}}" class="img-circle newavatar_198 apreview_img" width="198" height="198"/>
                                <div style="font-weight:600;font-size:12px;margin-top:15px">198x198 圆型</div>
                            </div>
                        </td>
                        <td style="padding:10px" colspan="2">
                            <div style="margin-bottom:15px" class="apreview_container">
                                <img id="newavatar_36r" ng-src="{{UserInfoData.avatar}}" class="img-circle newavatar_36r apreview_img" width="36" height="36"/>
                                <div style="font-weight:600;font-size:12px;margin-top:15px">36x36 圆型</div>
                            </div>
                            <div class="apreview_container">
                                <img id="newavatar_36c" ng-src="{{UserInfoData.avatar}}" class="img-rounded newavatar_36c apreview_img" width="54" height="54"/>
                                <div style="font-weight:600;font-size:12px;margin-top:15px">54x54 方型</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <hr><input name="avatar" accept=".jpg,.jpeg,.png" onchange="javascript:setImagePreview(this,$('.apreview_container'),$('.apreview_img'));" type="file" id="uploadbtn"/>
                        </td>
                        <td>
                            <hr><input disabled="disabled" id="uploadavatarbtn" type="submit" class="btn btn-primary" value="{{UploadBtnContent}}"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </dialog>

    <!--上传头像真正上传到的地址-->
    <iframe id="uploadAvatar" name="uploadAvatar" style="display:none" src="library/xwBE/php/uploadavatar_action.php"></iframe>

    <!--收录数据-->
    <dialog ng-if="recordPlayerInfo.open" modal fixed>
        <div dialog-title>{{recordPlayerInfo.title}}</div>
        <div dialog-content>
            <div class="progress progress-striped active" style="width:400px;">
                <div class="progress-bar" ng-class="{'progress-bar-success':recordPlayerInfoComplete,'progress-bar-danger':recordPlayerInfoError}" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: {{RecordProcession}}%;">
                </div>
            </div>
            <button ng-if="recordPlayerInfoError || recordPlayerInfoComplete" class="btn btn-primary center-block" role="button" ng-click="closeThisDialog()">知道了</button>
        </div>
    </dialog>

    <hr>
    <? echo $footer;?>


</div>
