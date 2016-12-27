<?php
require("library/xwBE/connectDB.php");
require("library/xwBE/all.php");
include("library/xwFE/FEM.php");
?>
<div class="container" ng-controller="homepagecontroller" style="margin-top:115px">
    <div class="row">
        <div class="leftpart col-lg-3 col-md-4 col-sm-4 col-xs-8">
            <div>
                <img ng-src="{{UserData.avatar}}" class="img-rounded center-block" width="198" height="198"/>
                <div class="text-center">
                    <strong style="display:inline-block;font-size:18px;margin-top:15px">{{UserData.name}}</strong>
                    <i ng-if="UserData.gender == '0'" class="iconfont icon-nan" style="font-size:23px;color:#346ea1" title="男"></i>
                    <i ng-if="UserData.gender == '1'" class="iconfont icon-nvhai" style="font-size:23px;color:#FF6699" title="女"></i>
                </div>
                <p style="color:#999;font-size:12px;margin-top:5px">{{UserData.slogan}}</p>
                <hr style="margin-bottom:0px">
            </div>
            <div class="text-center" style="padding:7px 0" ng-if="UserData.callingcard_content !== ''">
                <i class="iconfont icon-renzheng" style="font-size:20px;color:#d87f00;"></i>
                {{UserData.callingcard_content}}
            </div>
            <hr style="margin-top:0px">

            <table class="userp_info">
                <tr>
                    <td><i class="iconfont icon-shuziliu"></i></td>
                    <td width="25%">游戏ID：</td>
                    <td><span>{{UserData.dota2_uid}}</span></td>
                </tr>
                <tr ng-if="UserData.province!=='' || UserData.city!==''">
                    <td><i class="iconfont icon-dingwei"></i></td>
                    <td>地区：</td>
                    <td>
                        <span>{{UserData.province}}</span><span ng-if="UserData.province!=='' && UserData.city!==''">，</span><span>{{UserData.city}}</span>
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
                        <a style="display:inline-block;width:160px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;" ng-href="{{UserData.liveplain}}" target="_blank" class="btn btn-default btn-sm" style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;max-width:160px">{{UserData.liveplain}}</a>
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
                    <td><a style="display:inline-block;width:160px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">{{UserData.weibo}}</a></td>
                </tr>
            </table>
        </div>
        <div class="rightpart col-lg-9 col-md-8 col-sm-8 col-xs-12">
            <ul class="nav nav-tabs" style="margin-top:20px;">
                <li ng-class="{active:TabShowPage === 1}"><a ng-click="Tabshow(1)" style="font-size:13px"><i class="iconfont icon-chart" style="font-size:16px;margin-right:5px"></i>动态</a></li>
                <li ng-class="{active:TabShowPage === 2}"><a ng-click="Tabshow(2)"><i class="iconfont icon-article" style="font-size:16px;margin-right:5px"></i>文章</a></li>
            </ul>

            <div ng-show="TabShowPage == 1" class="dota2-thermodynamic-sheet panel panel-default" style="margin-top:15px;position: relative">
                <div ng-if="dota2panelmaskshow == 1" style="position: absolute;top:0;left:0;width:100%;height:100%;background-color:rgba(0,0,0,0.7);z-index:9;border-radius:3px">
                    <div style="width:32px;top:45%;left:47%;position:absolute">
                        <img src="img/fragments/loading/5-121204193955-50.gif">
                    </div>
                    <p style="width:32%;left:40%;top:55%;position:absolute;color:white;">正在读取数据，请稍候...</p>
                    <p style="width:70%;left:18%;top:62%;position:absolute;color:white;">（如果长时间没有反应，可能是STEAM服务器连接超时所引起的，请尝试刷新页面）</p>
                </div>
                <div class="panel-heading">
                    <i class="iconfont icon-icon-dota2" style="font-size:17px;color:white;margin-right:3px;"></i>
                    游戏活跃分布<small style="color:red" ng-if="!Dota2LivenessShower"> &nbsp;<i class="iconfont icon-alert"></i>该用户尚未关联dota2数字id，或者STEAM服务器连接出错，无法获取游戏活跃度。</small>
                </div>
                <div ng-if="Dota2LivenessShower" class="panel-body" id="dota2-thermodynamic-sheet-chart-body" style="height:260px;"></div>
            </div>

            <div class="liveness-sheet panel panel-default" style="margin-top:15px;" ng-show="TabShowPage == 1">
                <div class="panel-heading">
                    <img width="21" height="21" style="margin-top:-6px;margin-right:3px;display:inline;" alt="Dota2ImgThumbnail32^2" src="img/fragments/logo/xiwu_circle.png"/>
                    喜屋活跃曲线
                </div>
                <div class="panel-body" id="liveness-chart-body" style="height:260px;"></div>
            </div>

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
                <hr ng-if="UidEqu==true">
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
                            <li ng-repeat="xpag in ArticlePageListInfo" ng-class="{active:ListActive==xpag}" ng-disabled="ListActive==xpag" ng-if="xpag >= ListActive - 3 && xpag <= ListActive + 3"><a ng-click="changeShowPage(xpag,UserData.uid)">{{xpag}}</a></li>
                            <li ng-if="ListActive!==maxPageNum">
                                <a aria-label="Next" ng-click="changeShowPage(maxPageNum,UserData.uid)">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
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
