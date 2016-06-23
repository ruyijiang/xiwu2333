<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/6/6
 * Time: 15:42
 */
require("library/xwBE-0.0.1/connectDB.php");
require("library/xwBE-0.0.1/all.php");
include("library/xwFE-0.0.1/FEM.php");
?>
<?php
//---1，没有search参数
//---2，有
?>
<style>
    body{background-color:#f5f8fa}
    ul.nav-tabs.affix{
        top: 30px; /* Set the top position of pinned element */
    }
</style>
<div class="container" ng-controller="searchController" style="margin-top:130px;">
    <div class="row">
        <div class="boat clear-fix">
            <div class="row">
                <div class="col-lg-3 col-md-3" style="">
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="col-lg-12">
                        <img src="img/fragments/logo/xiwu_circle_blue.png" class="center-block" height="54" width="54" style="float:left;margin-right:20px;margin-top:-10px"/>
                        <form class="form-group" ng-submit="searchInPage()">
                            <div class="input-group-container">
                                <div class="input-group">
                                    <input type="text" class="form-control input" placeholder="" style="z-index:0;" ng-model="content">
                                  <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-search"></span></button>
                                  </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 text-center">
                    <div class="per_s-leftpart  boat" style="padding: 0px">
                        <ul class="nav nav-pills nav-stacked">
                            <li ng-class="{active:leftNavIndex == 1}">
                                <a ng-click="alertPri('user')">玩家<span ng-if="priority=='user'" class="badge"><span ng-if="SearchContentReq[0].statuscode=='0'">0</span><span ng-if="SearchContentReq[0].statuscode!=='0'">{{SearchContentReq.length}}</span></span></a>
                            </li>
                            <li ng-class="{active:leftNavIndex == 2}">
                                <a ng-click="alertPri('competition')">比赛<span ng-if="priority=='competition'" class="badge"><span ng-if="SearchContentReq[0].statuscode=='0'">0</span><span ng-if="SearchContentReq[0].statuscode!=='0'">{{SearchContentReq.length}}</span></span></a>
                            </li>
                            <li ng-class="{active:leftNavIndex == 3}">
                                <a ng-click="alertPri('article')">文章<span ng-if="priority=='article'" class="badge"><span ng-if="SearchContentReq[0].statuscode=='0'">0</span><span ng-if="SearchContentReq[0].statuscode!=='0'">{{SearchContentReq.length}}</span></span></a>
                            </li>
                        </ul>
                    </div><!--End of leftpart-->
                </div>


                <!--SearchConsequence--><div class="col-lg-8 col-md-9 col-xs-12 clearfix user_conse" ng-if="SearchContentReq[0].statuscode == 0">
                    没有搜索到与 “ {{thisContent}} ” 相关的<span ng-if="priority=='user'">玩家</span><span ng-if="priority=='competition'">比赛</span><span ng-if="priority=='article'">文章</span>。
                </div>

                <!--User--><div ng-if="priority=='user' && SearchContentReq[0].statuscode!=='0'" style="display:block;" class="col-lg-8 col-md-9 col-xs-12 search_user_container" style="font-size:16px;">
                    <div class="col-lg-12 clearfix user_conse" ng-repeat="xu in SearchContentReq">
                        <div class="search_content-leftpart pull-left" style="margin-top:5px">
                            <img class="img-rounded" src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="54"/>
                        </div>
                        <div class="search_content-rightpart pull-left" style="margin-left:10px">
                            <div class="search_content-toppart">
                                <a style="font-size:13px;font-weight:600">{{xu.name}}</a><small ng-if="xu.callingcardname !== ''">（{{xu.callingcardname}}）</small>
                                <h6 style="color:#999">{{xu.slogan}}</h6>
                            </div>
                            <div class="search_content-botpart">
                                <span class="sexuality" ng-if="xu.gender==0"><i class="iconfont icon-nan"></i> |</span>
                                <span class="sexuality" ng-if="xu.gender==1"><i class="iconfont icon-nvhai"></i> |</span>
                                <span class="position"><i class="iconfont icon-dingwei"></i>{{xu.province}}，{{xu.city}} |</span>
                                <span class="gameuid"><i class="iconfont icon-shuziliu"></i>{{xu.uid}} |</span>
                                <span class="score"><i class="iconfont icon-score"></i>{{xu.score}}</span>
                            </div>
                        </div>
                    </div><!--END OF DIV-->
                    <div class="row text-center">
                        <nav>
                            <ul class="pagination">
                                <li>
                                    <a aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="active"><a ng-click="changeShowPage(xpag,'')">1</a></li>
                                <li><a ng-click="changeShowPage(xpag,'')">2</a></li>
                                <li><a ng-click="changeShowPage(xpag,'')">3</a></li>
                                <li><a ng-click="changeShowPage(xpag,'')">4</a></li>
                                <li><a ng-click="changeShowPage(xpag,'')">5</a></li>
                                <li><a ng-click="changeShowPage(xpag,'')">6</a></li>
                                <li>
                                    <a aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div><!--End of pagination-->
                </div>

                <!--Competition--><div ng-if="priority=='competition'" style="display: none" class="col-lg-8 col-md-9 col-xs-12"><!--Competiton-->
                    <div class="col-lg-11 clearfix" style="padding: 15px;margin-bottom:10px;border-bottom:solid 1px #f1f1f1;">
                        <div class="search_content-leftpart pull-left" style="background-color:#e2e2e2">
                            <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="64" height="64"/>
                        </div>
                        <div class="search_content-rightpart pull-left">
                            <div class="search_content-toppart" style="margin-left:10px;font-size:12px">
                                <small><i class="iconfont icon-shuziliu"></i><font>数字id:</font><a>25255608123</a></small> |
                                <small><i class="iconfont icon-ladder"></i><font>技能等级:</font><span>Vh</span></small> |
                                <small><i class="iconfont icon-loudou"></i><font>游戏时长:</font><span>72分钟</span></small> |
                                <small><i class="iconfont icon-server"></i><font>服务器:</font><span>电信(华中)</span></small>
                            </div>
                            <div class="search_content-botpart" style="margin-left:10px;">
                                <div class="pull-left" style="margin-right:10px;">
                                    <span class="radient">
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                    </span>
                                    <i class="iconfont icon-vs"></i>
                                    <span class="diet">
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                    </span>
                                </div>
                                <div class="pull-left">
                                    <i class="iconfont icon-star" style="font-size:22px"></i>
                                </div>
                                <div class="pull-left" style="margin-left:0px">
                                    <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32">
                                </div>
                            </div>
                        </div>
                    </div><!--End of DIV1-->
                    <div class="col-lg-11 clearfix" style="padding: 15px;margin-bottom:10px;border-bottom:solid 1px #f1f1f1;">
                        <div class="search_content-leftpart pull-left" style="background-color:#e2e2e2">
                            <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="64" height="64"/>
                        </div>
                        <div class="search_content-rightpart pull-left">
                            <div class="search_content-toppart" style="margin-left:10px;font-size:12px">
                                <small><i class="iconfont icon-shuziliu"></i><font>数字id:</font><a>25255608123</a></small> |
                                <small><i class="iconfont icon-ladder"></i><font>技能等级:</font><span>Vh</span></small> |
                                <small><i class="iconfont icon-loudou"></i><font>游戏时长:</font><span>72分钟</span></small> |
                                <small><i class="iconfont icon-server"></i><font>服务器:</font><span>电信(华中)</span></small>
                            </div>
                            <div class="search_content-botpart" style="margin-left:10px;">
                                <div class="pull-left" style="margin-right:10px;">
                                    <span class="radient">
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                    </span>
                                    <i class="iconfont icon-vs"></i>
                                    <span class="diet">
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                    </span>
                                </div>
                                <div class="pull-left">
                                    <i class="iconfont icon-star" style="font-size:22px"></i>
                                </div>
                                <div class="pull-left" style="margin-left:0px">
                                    <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32">
                                </div>
                            </div>
                        </div>
                    </div><!--End of DIV1-->
                    <div class="col-lg-11 clearfix" style="padding: 15px;margin-bottom:10px;border-bottom:solid 1px #f1f1f1;">
                        <div class="search_content-leftpart pull-left" style="background-color:#e2e2e2">
                            <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="64" height="64"/>
                        </div>
                        <div class="search_content-rightpart pull-left">
                            <div class="search_content-toppart" style="margin-left:10px;font-size:12px">
                                <small><i class="iconfont icon-shuziliu"></i><font>数字id:</font><a>25255608123</a></small> |
                                <small><i class="iconfont icon-ladder"></i><font>技能等级:</font><span>Vh</span></small> |
                                <small><i class="iconfont icon-loudou"></i><font>游戏时长:</font><span>72分钟</span></small> |
                                <small><i class="iconfont icon-server"></i><font>服务器:</font><span>电信(华中)</span></small>
                            </div>
                            <div class="search_content-botpart" style="margin-left:10px;">
                                <div class="pull-left" style="margin-right:10px;">
                                    <span class="radient">
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                    </span>
                                    <i class="iconfont icon-vs"></i>
                                    <span class="diet">
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                        <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32"/>
                                    </span>
                                </div>
                                <div class="pull-left">
                                    <i class="iconfont icon-star" style="font-size:22px"></i>
                                </div>
                                <div class="pull-left" style="margin-left:0px">
                                    <img src="img/user_img/avatar/1/005ZSYD7jw8evwmt80xh8j30u00u0acx.jpg" width="32" height="32">
                                </div>
                            </div>
                        </div>
                    </div><!--End of DIV2-->
                </div>

                <!--article--><div ng-if="priority=='article' && SearchContentReq[0].statuscode!=='0'" class="col-lg-9 col-md-9 col-xs-12" style="font-size:16px;">
                    <div class="col-lg-11" style="font-size:16px;" ng-repeat="xa in SearchContentReq">
                        <div class="search_content-toppart">
                            <a ng-href="/#/blog?aid={{xa.aid}}">{{xa.title}}</a>
                            <blockquote style="margin-top:15px"><h6>{{xa.abstract}}<span>...</span></h6></blockquote>
                            <div class="pull-right cultivation" style="font-size:12px">
                                <a><i class="iconfont icon-heart"></i>2</a>
                                <a><i class="iconfont icon-comment"></i>12</a>
                            </div>
                        </div>
                        <div class="search_content-botpart">
                            <span style="font-size:13px">{{xa.time}} | <a class="author" style="font-weight:400;font-size:12px"><span class="glyphicon glyphicon-user"></span>{{xa.name}}</a></span>
                        </div>
                        <hr>
                    </div>
                    <div class="row text-center">
                        <nav>
                            <ul class="pagination">
                                <li>
                                    <a aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="active"><a ng-click="changeShowPage(xpag,'')">1</a></li>
                                <li><a ng-click="changeShowPage(xpag,'')">2</a></li>
                                <li><a ng-click="changeShowPage(xpag,'')">3</a></li>
                                <li><a ng-click="changeShowPage(xpag,'')">4</a></li>
                                <li><a ng-click="changeShowPage(xpag,'')">5</a></li>
                                <li><a ng-click="changeShowPage(xpag,'')">6</a></li>
                                <li>
                                    <a aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div><!--分页-->

                </div>
            </div>





        </div><!--End of boat-->
    </div><!--End of row-->
    <hr>
    <?php echo $footer;?>
</div>
