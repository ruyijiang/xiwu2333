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
</style>
<div class="container" ng-controller="searchController" style="margin-top:130px;">
    <div class="row">
        <div class="boat clear-fix">
            <div class="row">
                <div class="col-lg-3" style="margin-left:25px">
                    <img class="center-block" width="162px" height="54px"/>
                </div>
                <div class="col-lg-6">
                    <div class="col-lg-12">
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
                <div class="col-lg-3 col-sm-3 col-xs-12 text-center">
                    <div class="per_s-leftpart  boat" style="padding: 0px">
                        <ul class="nav nav-pills nav-stacked">
                            <li ng-class="{active:leftNavIndex == 1}">
                                <a ng-click="alertPri('user')">玩家<span class="badge">3</span></a>
                            </li>
                            <li ng-class="{active:leftNavIndex == 2}">
                                <a ng-click="alertPri('competition')">比赛<span class="badge">4</span></a>
                            </li>
                            <li ng-class="{active:leftNavIndex == 3}">
                                <a ng-click="alertPri('article')">文章<span class="badge">0</span></a>
                            </li>
                        </ul>
                    </div><!--End of leftpart-->
                </div>

                <div class="col-lg-9" style="font-size:16px;">
                    <div class="col-lg-11">
                        <div class="search_content-toppart">
                            <a>隐私声明</a>
                            <blockquote style="margin-top:15px"><h6>我们收集哪些信息 关于您的个人信息 Cookie的使用 关于免责说明 <span>...</span></h6></blockquote>
                            <div class="pull-right cultivation" style="font-size:12px">
                                <a><i class="iconfont icon-heart"></i>2</a>
                                <a><i class="iconfont icon-comment"></i>12</a>
                            </div>
                        </div>
                        <div class="search_content-botpart">
                            <span style="font-size:13px">2016-06-06 14:52 | <a class="author"><span class="glyphicon glyphicon-user"></span>milo</a></span>
                        </div>
                        <hr>
                    </div>
                    <div class="col-lg-11" style="font-size:16px;">
                        <div class="search_content-toppart">
                            <a>免责声明</a>
                            <blockquote style="margin-top:15px"><h6>我们收集哪些信息 关于您的个人信息 Cookie的使用 关于免责说明 <span>...</span></h6></blockquote>
                        </div>
                        <div class="search_content-botpart">
                            <div class="pull-right cultivation" style="font-size:12px">
                                <a><i class="iconfont icon-heart"></i>2</a>
                                <a><i class="iconfont icon-comment"></i>12</a>
                            </div>
                            <span style="font-size:13px">2016-06-06 14:52 | <a class="author"><span class="glyphicon glyphicon-user"></span>DDC</a></span>
                        </div>
                        <hr>
                    </div>
                    <div class="col-lg-11" style="font-size:16px;">
                        <div class="search_content-toppart">
                            <a>免责声明</a>
                            <blockquote style="margin-top:15px"><h6>我们收集哪些信息 关于您的个人信息 Cookie的使用 关于免责说明 <span>...</span></h6></blockquote>
                            <div class="pull-right cultivation" style="font-size:12px">
                                <a><i class="iconfont icon-heart"></i>2</a>
                                <a><i class="iconfont icon-comment"></i>12</a>
                            </div>
                        </div>
                        <div class="search_content-botpart">
                            <span style="font-size:13px">2016-06-06 14:52 | <a class="author"><span class="glyphicon glyphicon-user" style="color:#FF6699"></span>Maybe</a></span>
                        </div>
                        <hr>
                    </div>
                    <div class="col-lg-11" style="font-size:16px;">
                        <div class="search_content-toppart">
                            <a>免责声明</a>
                            <blockquote style="margin-top:15px"><h6>我们收集哪些信息 关于您的个人信息 Cookie的使用 关于免责说明 <span>...</span></h6></blockquote>
                            <div class="pull-right cultivation" style="font-size:12px">
                                <a><i class="iconfont icon-heart"></i>2</a>
                                <a><i class="iconfont icon-comment"></i>12</a>
                            </div>
                        </div>
                        <div class="search_content-botpart">
                            <span style="font-size:13px">2016-06-06 14:52 | <a class="author"><span class="glyphicon glyphicon-user" style="color:#FF6699"></span>Maybe</a></span>
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
                    </div>

                </div>
            </div>





        </div><!--End of boat-->
    </div><!--End of row-->
    <hr>
    <?php echo $footer;?>
</div>
