<?php
require("library/xwBE-0.0.1/connectDB.php");
require("library/xwBE-0.0.1/all.php");
include("library/xwFE-0.0.1/FEM.php");

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
                <li>
                    <a ui-sref="createroom">房间设置</a>
                </li>
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
            $result_name = $row["name"];
            $result_email = $row["email"];
            $result_gender = $row["gender"];
            $result_server = $row["server"];
            $result_country = $row["country"];
            $result_province = $row["province"];
            $result_city = $row["city"];
            $result_tel = $row["tel"];
            $result_qq = $row["qq"];
            $result_weixin = $row["weixin"];
            $result_weibo = $row["weibo"];
            $result_liveplain = $row["liveplain"];
        ?>

        <div class="per_s-rightpart col-lg-9 col-sm-9 col-xs-12 row" style="min-height:300px;border-radius:4px;">
                <form class="form-horizontal" role="form" id="info_setting_form" name="info_setting_form" ng-submit="submitData()">
                    <div class="row boat">
                        <div class="per_s_content-basicinfo col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-3 control-label">数字id</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static dischangable-text"><?echo $uid;?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputNickname" class="col-lg-3 control-label">用户名</label>
                                <div class="col-sm-9">
                                    <input required type="text" class="form-control" name="inputname" id="inputname" placeholder="请输入昵称" ng-model="UserInfoData.name">
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
                            <img  ng-src="{{UserInfoData.avatar}}" class="img-circle center-block" width="198" style="border:dashed #999 1px;cursor: pointer;"/>
                        </div><!--End of avatar-->
                    </div><!--End of a boat-->

                    <div class="row boat">
                        <div class="per_s_content-extrainfo">

                            <div class="extrarow-2 row">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">常驻服务器</label>
                                    <div class="btn-group col-lg-9 btn-group-sm" role="group" aria-label="...">
                                        <button type="button" class="userserver btn btn-default" ng-class="{active:ServerList.UserServer_sh==1}" value="电信（上海）" ng-click="changeServer('sh')">电信（上海）</button>
                                        <button type="button" class="userserver btn btn-default" ng-class="{active:ServerList.UserServer_zj==1}" value="电信（浙江）" ng-click="changeServer('zj')">电信（浙江）</button>
                                        <button type="button" class="userserver btn btn-default" ng-class="{active:ServerList.UserServer_gd==1}" value="电信（广东）" ng-click="changeServer('gd')">电信（广东）</button>
                                        <button type="button" class="userserver btn btn-default" ng-class="{active:ServerList.UserServer_hz==1}" value="电信（华中）" ng-click="changeServer('hz')">电信（华中）</button>
                                        <button type="button" class="userserver btn btn-default" ng-class="{active:ServerList.UserServer_lt==1}" value="联通" ng-click="changeServer('lt')">联通</button>
                                    </div>
                                </div>
                            </div><!--End of extrarow-x-->

                            <div class="extrarow-1 col-lg-12 row">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="select_city">所在地</label>
                                    <div class="btn-group col-lg-2 btn-group-sm" role="group" aria-label="...">
                                        <select class="form-control" disabled="disabled" ng-model="UserInfoData.country">
                                            <option>中国</option>
                                        </select>
                                    </div>
                                    <p class="pull-left" style="padding-top:5px;">-</p>
                                    <!--省份信息select标签-->
                                    <div class="btn-group col-lg-2 btn-group-sm" role="group" aria-label="...">
                                        <select class="form-control" id="select_city" ng-change="onRegionSelected(UserInfoData.country,UserInfoData.province)" ng-model="UserInfoData.province">
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
                                            <!--<option>和平区</option>
                                            <option>南开区</option>
                                            <option>河北区</option>
                                            <option>红桥区</option>
                                            <option>河东区</option>-->
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
                                            <input type="text" class="form-control" id="telnum" name="telnum" ng-model="UserInfoData.tel">
                                        </div>
                                    </div>
                                </div>
                            </div><!--End of extrarow-x-->

                            <div class="extrarow-4 col-lg-12 row">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="qqnum">QQ</label>
                                    <div class="col-sm-4">
                                        <input type="text" required minlength="3" class="form-control" name="qqnum" id="qqnum" ng-model="UserInfoData.qq">
                                    </div>
                                    <!--<a><span class="glyphicon glyphicon-plus-sign" style="padding-top: 15px;margin-left:0"></span></a>-->
                                </div>
                            </div><!--End of extrarow-x-->

                            <div class="extrarow-5 col-lg-12 row">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="wechat_name">微信</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" placeholder="" id="wechat_name" ng-model="UserInfoData.weixin">
                                    </div>
                                </div>
                            </div><!--End of extrarow-x-->

                            <div class="extrarow-3 col-lg-12 row">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="weibo_url">新浪微博</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-weibo_origin iconfont"></i></span>
                                            <input type="url" class="form-control" placeholder="输入您新浪微博的网址链接（URL）" id="weibo_url" ng-model="UserInfoData.weibo">
                                        </div>
                                    </div>
                                </div>
                            </div><!--End of extrarow-x-->

                            <div class="extrarow-5 col-lg-12 row">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="liveplain">直播平台</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="spanicon" style="margin:0"></span></span>
                                            <input id="liveplain" type="url" class="form-control" placeholder="输入您直播间的网址链接（URL）" ng-model="UserInfoData.liveplain">
                                        </div>
                                    </div>
                                </div>
                            </div><!--End of extrarow-x-->





                        </div><!--End of extrainfo-->

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
