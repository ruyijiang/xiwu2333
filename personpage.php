<?php
require("library/xwBE-0.0.1/connectDB.php");
require("library/xwBE-0.0.1/all.php");
include("library/xwFE-0.0.1/FEM.php");
?>
<div class="container" ng-controller="homepagecontroller" style="margin-top:100px">
    <div class="row">
        <div class="leftpart col-lg-3 col-md-4 col-sm-4 col-xs-8">
            <div>
                <img ng-src="{{UserData.avatar}}" class="img-rounded" width="198" height="198"/>
                <div>
                    <strong style="display:inline-block;font-size:18px;margin-top:15px">{{UserData.name}}</strong>
                    <i ng-if="UserData.gender == '0'" class="iconfont icon-nan" style="font-size:32px;color:#346ea1" title="男"></i>
                    <i ng-if="UserData.gender == '1'" class="iconfont icon-nvhai" style="font-size:32px;color:#FF6699" title="女"></i>
                </div>
                <p style="color:#999">{{UserData.slogan}}</p>
                <hr>
            </div>
            <div ng-if="UserData.callingcard_content !== ''">
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
                <tr ng-if="UserData.province!=='' || UserData.city!==''">
                    <td><i class="iconfont icon-dingwei"></i></td>
                    <td>地区：</td>
                    <td>
                        <span>{{UserData.province}}</span><span ng-if="UserData.province!=='' && UserData.city!==''">，</span><span>{{UserData.city}}</span>
                    </td>
                </tr>
                <tr>
                    <td><i class="iconfont icon-score"></i></td>
                    <td>评分：</td>
                    <td>
                        <span ng-if="UserData.score!=='' && UserData.score!=='0'" ng-class="{'label-success':UserData.score>=80,'label-warning':UserData.score<80&&UserData.score>=60,'label-danger':UserData.score<60}" class="label" style="font-weight:bold;font-style:italic">{{UserData.score}}</span>
                        <span ng-if="UserData.score=='' || UserData.score=='0'" ng-class="{'label-success':UserData.score>=80,'label-warning':UserData.score<80&&UserData.score>=60,'label-danger':UserData.score<60}" class="label" style="font-weight:bold;font-style:italic">暂无数据</span>
                    </td>
                </tr>
                <tr ng-if="UserData.server.length > 0">
                    <td><i class="iconfont icon-leibie"></i></td>
                    <td>服务器：</td>
                    <td>
                        <span class="label label-default" ng-if="UserData.server.length > 2" style="margin-right:3px">{{UserData.server_bigarea}}</span>
                        <span class="label label-default pull-left" ng-repeat="xserver in UserData.server" ng-if="UserData.server.length <= 2" style="margin-right:3px;margin-bottom:3px">{{xserver}}</span>
                    </td>
                </tr>
                <tr ng-if="UserData.liveplain!==''">
                    <td><i class="iconfont icon-live"></i></td>
                    <td>直播间：</td>
                    <td>
                        <a ng-href="{{UserData.liveplain}}" target="_blank" class="btn btn-default btn-sm" style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;max-width:160px">{{UserData.liveplain}}</a>
                    </td>
                </tr>
                <tr ng-if="UserData.qq!==''">
                    <td><i class="iconfont icon-qq2"></i></td>
                    <td>QQ：</td>
                    <td><span>{{UserData.qq}}</span></td>
                </tr>
                <tr ng-if="UserData.weibo!==''">
                    <td><i class="iconfont icon-weibo2"></i></td>
                    <td>微博：</td>
                    <td><a>{{UserData.weibo}}</a></td>
                </tr>
            </table>
        </div>
        <div class="rightpart col-lg-9 col-md-8 col-sm-8 col-xs-12">
            <ul class="nav nav-tabs" style="margin-top:20px;">
                <li ng-class="{active:TabShowPage === 1}"><a ng-click="Tabshow(1)">动态</a></li>
                <li ng-class="{active:TabShowPage === 2}"><a ng-click="Tabshow(2)">文章</a></li>
                <!--<li ng-class="{active:TabShowPage === 3}"><a ng-click="Tabshow(3)">评论</a></li>-->
            </ul>


            <div class="liveness-sheet panel panel-default" style="margin-top:15px;" ng-show="TabShowPage == 1">
                <div class="panel-heading">活跃曲线</div>
                <div class="panel-body" id="liveness-chart-body" style="height:260px;"></div>
            </div>
            <!--<div ng-if="TabShowPage == 1">
                <h5><strong>最新动态</strong></h5>
                <p>发表了&nbsp;<a href=""><span class="glyphicon glyphicon-file"></span>我的3月23日DOTA2一日游</a>&nbsp;一文</p><span></span>
                <p>评价了&nbsp;<a href=""><span class="glyphicon glyphicon-user"></span>Zxc</a></p>
                <p>评价了&nbsp;<a href=""><span class="glyphicon glyphicon-user"></span>MARTIN</a></p>
            </div>-->

            <div class="article-sheet form-inline" style="margin-top:15px;" ng-show="TabShowPage == 2">
                <a ng-if="UidEqu==true" class="btn btn-danger form-group" role="button" style="padding-left:35px;padding-right:45px;" ui-sref="writeblog"><span class="glyphicon glyphicon-pencil spanicon"></span>写文章</a>
                <div class="dropdown form-group" ng-if="UidEqu==true">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                        每页显示
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1" style="min-width:120px">
                        <li role="presentation" ng-class="{active:a_num_onepage==3}">
                            <a role="menuitem" tabindex="-1" ng-click="changePage_num(3)">3篇</a>
                        </li>
                        <li role="presentation" ng-class="{active:a_num_onepage==5}">
                            <a role="menuitem" tabindex="-1" ng-click="changePage_num(5)">5篇</a>
                        </li>
                        <li role="presentation"ng-class="{active:a_num_onepage==10}">
                            <a role="menuitem" tabindex="-1" ng-click="changePage_num(10)">10篇</a>
                        </li>
                    </ul>
                </div>

                <hr>
                <div ng-repeat="xarticle in ArticleDataArr">
                    <div class="article clearfix">
                        <a ng-href="/#/blog?aid={{xarticle.aid}}"><h4><strong>{{xarticle.title}}</strong></h4></a>
                        <blockquote><h5>{{xarticle.abstract}}<span>...</span></h5></blockquote>
                        <small class="pull-right"><time>{{xarticle.time}}</time></small>
                    </div>
                    <hr>
                </div>
                <div ng-if="UserData.gender == '0' && ArticleDataArr.length < 1 && ArticleStatus==undefined">他还没有发表过文章...</div>
                <div ng-if="UserData.gender == '1' && ArticleDataArr.length < 1 && ArticleStatus==undefined">她还没有发表过文章...</div>
                <div class="col-lg-12 text-center" ng-if="ArticleDataArr.length >= 1">
                    <nav>
                        <ul class="pagination">
                            <li ng-if="ListActive!==1">
                                <a aria-label="Previous" ng-click="changeShowPage(1,UserData.uid)">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li ng-repeat="xpag in ArticlePageListInfo" ng-class="{active:ListActive==xpag}" ng-disabled="ListActive==xpag" ng-if="xpag >= xpag - 3 && xpag <= xpag + 3"><a ng-click="changeShowPage(xpag,UserData.uid)">{{xpag}}</a></li>
                            <li ng-if="ListActive!==maxPageNum">
                                <a aria-label="Next" ng-click="changeShowPage(maxPageNum,UserData.uid)">
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
                        <a class="pull-left" data-toggle="tooltip" data-placement="bottom" data-original-title="Yado"><img class="img-responsive" style="height:42px;width:42px;"/></a>
                        <h5 class="pull-left" style="margin-left:20px;">这个人好坑的...</h5>
                    </blockquote>
                    <small class="pull-right"><time>3min 前</time></small>
                </div>
                <div class="article">
                    <blockquote class="clearfix">
                        <a class="pull-left" data-toggle="tooltip" data-placement="bottom" data-original-title="shy"><img class="img-responsive" style="height:42px;width:42px;"/></a>
                        <h5 class="pull-left" style="margin-left:20px;">这个人好坑的...</h5>
                    </blockquote>
                    <small class="pull-right"><time>3min 前</time></small>
                </div>
            </div>




        </div><!--rightpart-->
    </div><!--row-->

    <dialog ng-if="dialog.open" duration="1100" fixed close="dialog.open=false">
        <div dialog-content>{{dialog.content}}</div>
    </dialog>
    <hr>
    <?php echo $footer;?>
</div><!--container-->
