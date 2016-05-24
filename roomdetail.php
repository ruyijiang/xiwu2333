<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/5/4
 * Time: 0:00
 */
require("library/xwBE-0.0.1/connectDB.php");
require("library/xwBE-0.0.1/all.php");
include("library/xwFE-0.0.1/FEM.php");
?>
<?php

?>

<style xmlns="http://www.w3.org/1999/html">
    body{background-color:#f5f8fa}
    .boat ul li>a{border-radius: 1px}
    input[type='checkbox'],input[type='radio']{
        vertical-align:top;
        margin-top:2px;
        margin-right:3px
    }
    label{padding-top:10px}
</style>
<div class="container" ng-controller="createroomcontroller" style="margin-top:130px;">
    <div class="row">
        <div class="per_s-leftpart col-lg-3 col-sm-3 col-xs-12 boat" style="padding: 0px">
            <ul class="nav nav-pills nav-stacked ">
                <li class="active">
                    <a>发布房间</a>
                </li>
                <li>
                    <a>隐藏房间</a>
                </li>
            </ul>
        </div><!--End of leftpart-->


        <div class="per_s-rightpart col-lg-9 col-sm-9 col-xs-12 row" style="min-height:300px;border-radius:4px;">
            <form class="form-horizontal center-block" role="form" >
                <div class="row boat" style="">

                    <div class="per_s_content-avatar col-lg-12 center-block" style="margin-bottom:25px;">
                        <label class="control-label">展示图片</label>
                        <img src="img/room_img/5506ef197f231twomwebsitescreensho.jpg" class="center-block " width="100%" height="318"  style="cursor: pointer;"/>
                    </div><!--End of bg-->

                    <div class="per_s_content-basicinfo col-lg-8">
                        <div class="form-group">
                            <label class="col-lg-3 control-label" for="room_name">房间id</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="room_name" placeholder="" autocomplete="off" disabled="disabled" value="cad27590311">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label" for="room_name">房间名</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="room_name" placeholder="" autocomplete="off" autofocus="autofocus">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label" for="room_desc">房间说明</label>
                            <div class="btn-group col-lg-9 btn-group-sm" role="group" aria-label="...">
                                <textarea class="form-control" rows="3" id="room_desc" placeholder="例如：中国Dota2玩家联盟群内战，接箭速来！"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-lg-3 control-label">开放房间</label>
                            <div class="col-sm-9">
                                <small style="margin-right:15px;margin-top:15px"><label style="font-weight:normal;cursor:pointer"><input type="radio" name="open_room_rule">随意进入</label></small>
                                <small style="margin-right:15px;margin-top:15px"><label style="font-weight:normal;cursor:pointer"><input type="radio" name="open_room_rule">设置密码</label></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label" for="room_password">设置密码</label>
                            <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="password" class="form-control">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button" title="密码可见"><span class="glyphicon glyphicon-eye-open"></span></button>
                                        </span>
                                    </div><!-- /input-group -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label" for="pw_reminder">密码提示</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" autocomplete="off" id="pw_reminder">
                            </div>
                        </div>

                        <div class="extrarow-2 row" style="padding-left:12px">
                            <div class="form-group">
                                <label class="col-lg-3 control-label">常驻服务器</label>
                                <div class="btn-group col-lg-9 btn-group-xs" role="group" aria-label="...">
                                    <button type="button" class="btn btn-default active">电信（上海）</button>
                                    <button type="button" class="btn btn-default active">电信（浙江）</button>
                                    <button type="button" class="btn btn-default active">电信（广东）</button>
                                    <button type="button" class="btn btn-default">电信（华中）</button>
                                    <button type="button" class="btn btn-default">联通</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">人数限制</label>
                            <div class="btn-group col-lg-9 btn-group-sm" role="group" aria-label="...">
                                <input id="ex6" type="text" data-slider-min="2" data-slider-max="16" data-slider-step="1" data-slider-value="5">
                                <span id="ex6CurrentSliderValLabel" style="margin-left:10px"><small>房间最多容纳: </small><span id="ex6SliderVal" style="font-weight:bold">5</span>人</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword" class="col-lg-3 control-label">允许加入条件</label>
                            <div class="col-sm-9">
                                <small style="margin-right:15px;margin-top:15px"><label style="font-weight:normal;cursor:pointer"><input type="checkbox">天梯分数</label></small>
                                <small style="margin-right:15px;margin-top:15px"><label style="font-weight:normal;cursor:pointer"><input type="checkbox">胜率</label></small>
                                <small style="margin-right:15px;margin-top:15px"><label style="font-weight:normal;cursor:pointer"><input type="checkbox">评分</label></small>
                                <small style="margin-right:15px;margin-top:15px"><label style="font-weight:normal;cursor:pointer"><input type="checkbox">黑名单</label></small>
                            </div>
                        </div>

                        <fieldset style="margin-bottom:25px;padding:15px;background-color:#f7f7f7" class="row">
                            <small><legend style="font-size:12px;font-weight:bold">数据限制</legend></small>
                            <div class="form-group col-lg-5">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">天梯分数<span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">高于</a></li>
                                                <li><a href="#">低于</a></li>
                                            </ul>
                                        </div><!-- /btn-group -->
                                        <input type="text" class="form-control" aria-label="..." maxlength="4">
                                    </div><!-- /input-group -->
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">胜率<span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">高于</a></li>
                                                <li><a href="#">低于</a></li>
                                            </ul>
                                        </div><!-- /btn-group -->
                                        <input type="text" class="form-control" aria-label="..." maxlength="2">
                                    </div><!-- /input-group -->
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">评分<span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">高于</a></li>
                                                <li><a href="#">低于</a></li>
                                            </ul>
                                        </div><!-- /btn-group -->
                                        <input type="text" class="form-control" aria-label="..." maxlength="2">
                                    </div><!-- /input-group -->
                                </div>
                            </div>

                            <small><legend style="font-size:12px;font-weight:bold">黑名单<span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" data-original-title="不会告知列表里的用户"></span></legend></small>
                            <textarea class="form-control" id="room_tags" autocomplete="off" resize="vertical"></textarea>
                        </fieldset>

                        <div class="form-group">
                            <label class="col-lg-3 control-label" for="room_tags">房间标签</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="room_tags" autocomplete="off"></textarea>
                            </div>
                        </div>


                    </div><!--End of roomsetting-->
                </div><!--End of a boat-->


                <div class="row boat" style="padding:0">
                    <input type="submit" class="btn btn-lg btn-primary btn-block" value="发布房间">
                </div>
            </form>


        </div><!--End of leftpart-->
    </div><!--End of row-->
    <hr>
    <? echo $footer;?>



</div>

