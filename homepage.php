<?php
require("library/xwBE-0.0.1/connectDB.php");
require("library/xwBE-0.0.1/all.php");
include("library/xwFE-0.0.1/FEM.php");
?>
<div class="container" ng-controller="homepagecontroller" style="margin-top:130px">
        <div class="row">
                <div class="leftpart col-lg-3">
                    <img src="img/user_img/avatar/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" class="img-responsive"/>
                    <h2><strong>shy</strong></h2>
                    <p>一个DOTA爱好者</p>
                    <hr>
                    <p class="native"><span class="glyphicon glyphicon-check"></span><span data-cate style="font-weight:400">实名登记</span></p>
                    <p class="native"><span class="glyphicon glyphicon-credit-card"></span><span data-cate>认证信息：</span><span>烧鸭</span></p>
                    <hr>
                    <p class="native"><span class="glyphicon glyphicon-barcode"></span><span data-cate>数字ID：</span><span>252556081</span></p>
                    <p class="native"><span class="glyphicon glyphicon-user"></span><span data-cate>性别：</span><span>男</span></p>
                    <p class="native"><span class="glyphicon glyphicon-map-marker"></span><span data-cate>地区：</span><span>中国</span>，<span>天津</span>，<span>天津</span></p>
                    <p class="native"><span class="qq-span spanicon"></span><span data-cate>qq：</span><span>1444828173</span></p>
                    <p class="native"><span class="wechat-span spanicon"></span><span data-cate>微信：</span><span><span class="glyphicon glyphicon-qrcode thisQR" style=""><img src="img/user_img/qrcode/1_1341237641.jpg" class="qrcodeimg"/></span></span></p>
                    <p class="native"><span class="glyphicon glyphicon-paperclip"></span><span data-cate>常驻：</span><span>电信(上海)</span></p>
                    <p class="native"><span class="glyphicon glyphicon-signal"></span><span data-cate>水平：</span><span>4500+</span></p>
                    <hr>
                    <h5><strong>他的房间</strong></h5>
                    <a href=""><img src="img/room_img/20130428100656532.jpg" class="img-responsive" data-toggle="tooltip" data-placement="top" data-original-title="烧花鸭的春夏秋冬"/></a>
                </div>
                <div class="rightpart col-lg-9">
                    <ul class="nav nav-tabs" style="margin-top:20px;">
                       <li class="active"><a ng-click="Tabshow(1)">动态</a></li>
                       <li><a ng-click="Tabshow(2)">文章</a></li>
                       <li><a ng-click="Tabshow(3)">获得评价</a></li>
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


                    <div class="liveness-sheet panel panel-default" style="margin-top:15px;"  ng-show="PulseShow">
                    	<div class="panel-heading">活跃曲线</div>
                        <div class="panel-body" id="liveness-chart-body" style="height:260px;">
                                             	
                        </div>
                    </div>
                    <hr>
                    <div  ng-show="PulseShow">
                        <h5><strong>最新动态</strong></h5>
                        <p>发表了&nbsp;<a href=""><span class="glyphicon glyphicon-file"></span>我的3月23日DOTA2一日游</a>&nbsp;一文</p><span></span>
                        <p>评价了&nbsp;<a href=""><span class="glyphicon glyphicon-user"></span>Zxc</a></p>
                        <p>评价了&nbsp;<a href=""><span class="glyphicon glyphicon-user"></span>MARTIN</a></p>
                    </div>

                    <div class="article-sheet" style="margin-top:15px;"  ng-show="ArticleShow">
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
                    
                    <div class="comment-sheet" style="margin-top:15px;" ng-show="AssessShow">
                        <div class="article">                        	
                            <blockquote class="clearfix">
                            	<a href="" class="pull-left" data-toggle="tooltip" data-placement="bottom" data-original-title="Yado"><img src="img/user_img/avatar/622762d0f703918f331290f3523d269758eec4cc.jpg" class="img-responsive" style="height:42px;width:42px;"></img></a>
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
    </div><!--container-->