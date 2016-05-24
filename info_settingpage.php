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
                <li class="active">
                    <a>资料设置</a>
                </li>
                <li>
                    <a>修改密码</a>
                </li>
                <li>
                    <a>开放组队设置</a>
                </li>
                <li>
                    <a>实名验证</a>
                </li>
            </ul>
        </div><!--End of leftpart-->


        <div class="per_s-rightpart col-lg-9 col-sm-9 col-xs-12 row" style="min-height:300px;border-radius:4px;">
                <form class="form-horizontal" role="form">
                    <div class="row boat">
                        <div class="per_s_content-basicinfo col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-3 control-label">数字id</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static dischangable-text">email@example.com</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputNickname" class="col-lg-3 control-label">昵称</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputNickname"
                                           placeholder="请输入昵称">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">邮箱</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static dischangable-text">1444828173@qq.com</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">性别</label>
                                <div class="btn-group col-lg-9 btn-group-sm" role="group" aria-label="...">
                                    <button type="button" class="btn btn-default active">男</button>
                                    <button type="button" class="btn btn-default">女</button>
                                </div>
                            </div>
                        </div><!--End of basicinfo-->

                        <div class="per_s_content-avatar col-lg-6">
                            <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" class="img-circle center-block" width="198" style="cursor: pointer;"/>
                        </div><!--End of avatar-->
                    </div><!--End of a boat-->

                    <div class="row boat">
                        <div class="per_s_content-extrainfo">

                            <div class="extrarow-2 row">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">常驻服务器</label>
                                    <div class="btn-group col-lg-9 btn-group-sm" role="group" aria-label="...">
                                        <button type="button" class="btn btn-default active">电信（上海）</button>
                                        <button type="button" class="btn btn-default active">电信（浙江）</button>
                                        <button type="button" class="btn btn-default active">电信（广东）</button>
                                        <button type="button" class="btn btn-default">电信（华中）</button>
                                        <button type="button" class="btn btn-default">联通</button>
                                    </div>
                                </div>
                            </div><!--End of extrarow-x-->

                            <div class="extrarow-1 col-lg-12 row">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="select_city">所在地</label>
                                    <div class="btn-group col-lg-2 btn-group-sm" role="group" aria-label="...">
                                        <select class="form-control">
                                            <option>中国</option>
                                            <option>美国</option>
                                            <option>日本</option>
                                            <option>韩国</option>
                                            <option>英国</option>
                                            <option>土耳其</option>
                                            <option>柬埔寨</option>
                                        </select>
                                    </div>
                                    <p class="pull-left" style="padding-top:5px;">-</p>
                                    <div class="btn-group col-lg-2 btn-group-sm" role="group" aria-label="...">
                                        <select class="form-control" id="select_city">
                                            <option>天津</option>
                                            <option>北京</option>
                                            <option>上海</option>
                                            <option>广州</option>
                                            <option>重庆</option>
                                        </select>
                                    </div>
                                    <p class="pull-left" style="padding-top:5px;">-</p>
                                    <div class="btn-group col-lg-2 btn-group-sm" role="group" aria-label="...">
                                        <select class="form-control">
                                            <option>河西区</option>
                                            <option>和平区</option>
                                            <option>南开区</option>
                                            <option>河北区</option>
                                            <option>红桥区</option>
                                            <option>河东区</option>
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
                                            <input type="text" class="form-control" id="telnum">
                                        </div>
                                    </div>
                                </div>
                            </div><!--End of extrarow-x-->

                            <div class="extrarow-4 col-lg-12 row">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="qqnum">QQ</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" placeholder="" id="qqnum">
                                    </div>
                                    <a><span class="glyphicon glyphicon-plus-sign" style="padding-top: 15px;margin-left:0"></span></a>
                                </div>
                            </div><!--End of extrarow-x-->

                            <div class="extrarow-5 col-lg-12 row">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="wechat_name">微信</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" placeholder="" id="wechat_name">
                                    </div>
                                </div>
                            </div><!--End of extrarow-x-->

                            <div class="extrarow-3 col-lg-12 row">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="weibo_url">新浪微博</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" placeholder="" id="weibo_url">
                                    </div>
                                </div>
                            </div><!--End of extrarow-x-->

                            <div class="extrarow-5 col-lg-12 row">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="liveplain_url">直播平台</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"></span>
                                            <input type="text" class="form-control" placeholder="在此输入您直播间的网址链接（URL）" id="liveplain_url">
                                        </div>
                                    </div>
                                    <a><span class="glyphicon glyphicon-plus-sign" style="padding-top: 15px;margin-left:0"></span></a>
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
