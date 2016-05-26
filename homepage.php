<?php
require("library/xwBE-0.0.1/connectDB.php");
require("library/xwBE-0.0.1/all.php");
include("library/xwFE-0.0.1/FEM.php");
?>
<div class="container" ng-controller="homepagecontroller" style="margin-top:100px">
        <div class="row">
                <div class="leftpart col-lg-3">
                    <div>
                        <img ng-src="{{UserData.avatar}}" class="img-responsive center-block" width="186"/>
                        <h2>
                            <strong>shy</strong>
                            <i ng-if="UserData.gender == '0'" class="iconfont icon-nan" style="font-size:32px;color:#346ea1" title="男"></i>
                            <i ng-if="UserData.gender == '1'" class="iconfont icon-nvhai" style="font-size:32px;color:#b76d8a" title="女"></i>
                        </h2>
                        <p>一个DOTA爱好者</p>
                        <hr>
                    </div>
                    <div ng-if="callingcard_content !== ''">
                        <table class="id_info">
                            <tr>
                                <td><i class="iconfont icon-renzheng" style="font-size:28px;color:#d87f00"></i></td>
                                <td style="font-size:18px">{{UserData.callingcard_content}}</td>
                            </tr>
                        </table>
                        <hr>
                    </div>

                    <table class="userp_info">
                        <tr>
                            <td><i class="iconfont icon-shuziliu"></i></td>
                            <td width="25%">UID：</td>
                            <td><span>{{UserData.uid}}</span></td>
                        </tr>
                        <tr>
                            <td><i class="iconfont icon-dingwei"></i></td>
                            <td>地区：</td>
                            <td><span>{{UserData.province}}</span>，<span>{{UserData.city}}</span></td>
                        </tr>
                        <tr>
                            <td><i class="iconfont icon-shujufenxi"></i></td>
                            <td>天梯：</td>
                            <td><span>{{UserData.ladderscore}}</span></td>
                        </tr>
                        <tr>
                            <td><i class="iconfont icon-score"></i></td>
                            <td>评分：</td>
                            <td>
                                <span ng-class="{'label-success':UserData.score>=80,'label-warning':UserData.score<80&&UserData.score>=60,'label-danger':UserData.score<60}" class="label" style="font-weight:bold;font-style:italic">{{UserData.score}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td><i class="iconfont icon-leibie"></i></td>
                            <td>服务器：</td>
                            <td>
                                <span class="label label-default" ng-repeat="xserver in UserData.server" style="margin-right:3px">{{xserver}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td><i class="iconfont icon-leibie"></i></td>
                            <td>直播间：</td>
                            <td>
                                <a ng-href="{{UserData.liveplain}}" target="_blank" class="btn btn-default btn-sm" style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;max-width:160px">{{UserData.liveplain}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td><i class="iconfont icon-qq-copy"></i></td>
                            <td>QQ：</td>
                            <td><span>{{UserData.qq}}</span></td>
                        </tr>
                        <tr>
                            <td><i class="iconfont icon-weixin"></i></td>
                            <td>微信：</td>
                            <td>
                                <span class="glyphicon glyphicon-qrcode thisQR" style="">
                                    <img src="img/user_img/qrcode/1_1341237641.jpg" class="qrcodeimg"/>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td><i class="iconfont icon-weixin"></i></td>
                            <td>微博：</td>
                            <td><a>马子航milo</a></td>
                        </tr>
                    </table>
                    <hr>
                    <h5><strong>他的房间</strong></h5>
                    <a href=""><img src="img/room_img/20130428100656532.jpg" class="img-responsive" data-toggle="tooltip" data-placement="top" data-original-title="烧花鸭的春夏秋冬"/></a>
                </div>
                <div class="rightpart col-lg-9">
                    <ul class="nav nav-tabs" style="margin-top:20px;">
                       <li ng-class="{active:TabShowPage === 1}"><a ng-click="Tabshow(1)">动态</a></li>
                       <li ng-class="{active:TabShowPage === 2}"><a ng-click="Tabshow(2)">文章</a></li>
                       <li ng-class="{active:TabShowPage === 3}"><a ng-click="Tabshow(3)">获得评价</a></li>
                    </ul>

                    <!--php

                        @$TabContext = $_GET["tab"];
                        if(!isset($TabContext)){$TabContext = "pulse";}
                        if($TabContext == "pulse"){
                            echo $HomePageView_Pulse;
                        }else if($TabContext == "article"){
                            echo $HomePageView_Article;
                        }else if($TabContext == "assess"){
                            echo $HomePageView_Assess;
                        }

                    -->


                    <div class="liveness-sheet panel panel-default" style="margin-top:15px;" ng-show="TabShowPage == 1">
                    	<div class="panel-heading">活跃曲线</div>
                        <div class="panel-body" id="liveness-chart-body" style="height:260px;">
                                             	
                        </div>
                    </div>
                    <div ng-if="TabShowPage == 1">
                        <h5><strong>最新动态</strong></h5>
                        <p>发表了&nbsp;<a href=""><span class="glyphicon glyphicon-file"></span>我的3月23日DOTA2一日游</a>&nbsp;一文</p><span></span>
                        <p>评价了&nbsp;<a href=""><span class="glyphicon glyphicon-user"></span>Zxc</a></p>
                        <p>评价了&nbsp;<a href=""><span class="glyphicon glyphicon-user"></span>MARTIN</a></p>
                    </div>

                    <div class="article-sheet" style="margin-top:15px;" ng-show="TabShowPage == 2">
                    	   <a class="btn btn-danger pull-left" role="button" style="margin-right:5px;"><span class="glyphicon glyphicon-pencil spanicon"></span>写文章</a>
                    	<form>
                        	<div class="input-group-container">
                                <div class="input-group col-lg-5">
                                  <input type="text" class="form-control" placeholder="搜索">
                                  <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                                  </span>
                                </div>
                            </div>
                        </form>
                        <h5 class="pull-left" style="width:75px;padding-top:2px;color:#CCC">文章列表</h5>
                        <hr>
                        <div class="article clearfix">
                        	<a href=""><h4><strong>我的3月23日DOTA2一日游</strong></h4></a>
                            <blockquote><h5>2016年3月24日，一个明媚的早晨<span>...</span></h5></blockquote>
                            <small class="pull-right"><time>3min 前</time></small>
                        </div>
                        <hr>
                        <div class="article clearfix">
                        	<a href=""><h4><strong>我的3月24日DOTA2一日游</strong></h4></a>
                            <blockquote><h5>2016年3月24日，一个明媚的早晨<span>...</span></h5></blockquote>
                            <small class="pull-right"><time>昨天 16:24</time></small>
                        </div>
                        <hr>


                        <div class="col-lg-12 text-center">
                            <nav>
                              <ul class="pagination">
                                <li>
                                  <a href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                  </a>
                                </li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li>
                                  <a href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                  </a>
                                </li>
                              </ul>
                            </nav>
                        </div>
                    </div>

                    <div class="comment-sheet" style="margin-top:15px;" ng-show="TabShowPage == 3">
                        <div class="article">                        	
                            <blockquote class="clearfix">
                            	<a href="" class="pull-left" data-toggle="tooltip" data-placement="bottom" data-original-title="Yado"><img src="img/user_img/avatar/622762d0f703918f331290f3523d269758eec4cc.jpg" class="img-responsive" style="height:42px;width:42px;"/></a>
                                <h5 class="pull-left" style="margin-left:20px;">这个人好坑的...</h5>
                            </blockquote>
                            <small class="pull-right"><time>3min 前</time></small>
                        </div>
                        <div class="article">                        	
                            <blockquote class="clearfix">
                            	<a href="" class="pull-left" data-toggle="tooltip" data-placement="bottom" data-original-title="shy"><img src="img/user_img/avatar/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" class="img-responsive" style="height:42px;width:42px;"></img></a>
                                <h5 class="pull-left" style="margin-left:20px;">这个人好坑的...</h5>
                            </blockquote>
                            <small class="pull-right"><time>3min 前</time></small>
                        </div>
                    </div>

                    
                    
                </div><!--rightpart-->
        </div><!--row-->
    <hr>
    <?php echo $footer;?>
    </div><!--container-->