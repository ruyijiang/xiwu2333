<?php
require("library/xwBE-0.0.1/connectDB.php");
require("library/xwBE-0.0.1/all.php");
include("library/xwFE-0.0.1/FEM.php");
?>
<style>body{background-color:#dadada}.carousel{height:451px;}.carousel-caption{z-index:10}.carousel .item{height:451px;background-color:#333}.carousel-inner>.item>img{position:absolute;top:0;left:15%;width:70%;height:451px;border-bottom:solid 1px black}.marketing h2{font-weight:400}.marketing .col-lg-4 p{margin-right:10px;margin-left:10px}@media (min-width:768px){.carousel-caption p{margin-bottom:20px;font-size:21px;line-height:1.4}
        ul.list-group li.list-group-item.active a{color:white}
</style>
<div ng-controller="communityController">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class=""></li>
            <li data-target="#myCarousel" data-slide-to="1" class=""></li>
            <li data-target="#myCarousel" data-slide-to="2" class="active"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="item">
                <img class="first-slide center-block" src="/img/main_bg/0e8fb0cd23e0d07f129f87067f4a3b4f8f92f23317219b-coNiZ0_fw658.gif" alt="First slide">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>TI6 中国Wings战队夺冠！</h1>
                        <p>Note: If you're viewing this page via a <code>file://</code> URL, the "next" and "previous" Glyphicon buttons on the left and right might not load/display properly due to web browser security rules.</p>
                        <p><a class="btn btn-lg btn-primary" role="button">查看原文</a></p>
                    </div>
                </div>
            </div>
            <div class="item">
                <img class="second-slide" src="/img/main_bg/7a425521gw1eiiixmi2jij21hc0qagyf.jpg" alt="Second slide">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Another example headline.</h1>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        <p><a class="btn btn-lg btn-primary" role="button">Learn more</a></p>
                    </div>
                </div>
            </div>
            <div class="item active">
                <img class="third-slide" src="/img/main_bg/20130428100656532.jpg" alt="Third slide">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>One more for good measure.</h1>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        <p><a class="btn btn-lg btn-primary" role="button">Browse gallery</a></p>
                    </div>
                </div>
            </div>
        </div>
        <a class="left carousel-control" role="button" data-slide="prev" ng-href="/#/square#myCarousel">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">上一个</span>
        </a>
        <a class="right carousel-control" role="button" data-slide="next" ng-href="/#/square#myCarousel">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">下一个</span>
        </a>
    </div>
    <!--End of 轮播-->

    <div class="container" style="padding-top:35px">
        <div role="main" class="row main community-main" style="background-color:#efefef;box-shadow: 0px 0px 3px #999;padding:0">
            <div class="main-leftpart col-lg-8 col-md-8" style="background-color:white;padding-bottom:35px">
                <!-- 热门推荐 -->
                <div class="hotarticles">
                    <h4 style="margin-top:20px;" class="text-left"><span class="glyphicon glyphicon-fire"></span>热门推荐</h4>
                    <hr>
                    <div class="row featurette">
                        <div class="col-md-7">
                            <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It'll blow your mind.</span></h2>
                            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
                        </div>
                        <div class="col-md-5">
                            <img class="featurette-image img-responsive center-block" src="/img/main_bg/0e8fb0cd23e0d07f129f87067f4a3b4f8f92f23317219b-coNiZ0_fw658.gif" alt="Generic placeholder image">
                        </div>
                    </div>
                    <div class="row featurette">
                        <div class="col-md-7 col-md-push-5">
                            <h2 class="featurette-heading">Oh yeah, it's that good. <span class="text-muted">See for yourself.</span></h2>
                            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
                        </div>
                        <div class="col-md-5 col-md-pull-7">
                            <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
                        </div>
                    </div>
                    <div class="row featurette">
                        <div class="col-md-7">
                            <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It'll blow your mind.</span></h2>
                            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
                        </div>
                        <div class="col-md-5">
                            <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
                        </div>
                    </div>
                </div>

                <!-- 最新文章 -->
                <div class="lastedtarticles text-center clearfix">
                    <h4 style="margin-top:20px;" class="text-left"><span class="glyphicon glyphicon-time"></span>最新发表</h4>
                    <hr>
                    <div class="col-lg-4">
                        <div>
                            <img class="img-circle" src="/img/main_bg/0e8fb0cd23e0d07f129f87067f4a3b4f8f92f23317219b-coNiZ0_fw658.gif" alt="Generic placeholder image" width="98" height="98">
                        </div>
                        <h2 class="lasted_title">那年十八，站如喽啰</h2>
                        <p class="lasted_content">Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
                        <p><a class="btn btn-default" href="#" role="button">查看原文 »</a></p>
                    </div>
                    <div class="col-lg-4">
                        <div>
                            <img class="img-circle" src="/img/main_bg/0e8fb0cd23e0d07f129f87067f4a3b4f8f92f23317219b-coNiZ0_fw658.gif" alt="Generic placeholder image" width="98" height="98">
                        </div>
                        <h2 class="lasted_title">那年十八，站如喽啰</h2>
                        <p class="lasted_content">Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
                        <p><a class="btn btn-default" href="#" role="button">查看原文 »</a></p>
                    </div>
                    <div class="col-lg-4">
                        <div>
                            <img class="img-circle" src="/img/main_bg/0e8fb0cd23e0d07f129f87067f4a3b4f8f92f23317219b-coNiZ0_fw658.gif" alt="Generic placeholder image" width="98" height="98">
                        </div>
                        <h2 class="lasted_title">那年十八，站如喽啰</h2>
                        <p class="lasted_content">Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
                        <p><a class="btn btn-default" href="#" role="button">查看原文 »</a></p>
                    </div>
                </div>

                <!-- 赛事链接,3期做赛事链接，4期做详细内容 -->
                <div class="tournaments text-center clearfix">
                    <h4 style="margin-top:20px;" class="text-left"><span class="glyphicon iconfont icon-bisai" style="font-size:24px;font-weight:600"></span>联赛信息</h4>

                    <hr>
                    <div class="col-lg-4">
                        <div>
                            <img class="img-rounded" src="/img/main_bg/0e8fb0cd23e0d07f129f87067f4a3b4f8f92f23317219b-coNiZ0_fw658.gif" alt="Generic placeholder image" width="128" height="128">
                        </div>
                        <h2 class="tournament_title">那年十八，站如喽啰</h2>
                        <p class="tournament_content">Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
                        <p><a class="btn btn-default" href="#" role="button">查看原文 »</a></p>
                    </div>
                    <div class="col-lg-4">
                        <div>
                            <img class="img-rounded" src="/img/main_bg/0e8fb0cd23e0d07f129f87067f4a3b4f8f92f23317219b-coNiZ0_fw658.gif" alt="Generic placeholder image" width="128" height="128">
                        </div>
                        <h2 class="tournament_title">那年十八，站如喽啰</h2>
                        <p class="tournament_content">Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
                        <p><a class="btn btn-default" href="#" role="button">查看原文 »</a></p>
                    </div>
                    <div class="col-lg-4">
                        <div>
                            <img class="img-rounded" src="/img/main_bg/0e8fb0cd23e0d07f129f87067f4a3b4f8f92f23317219b-coNiZ0_fw658.gif" alt="Generic placeholder image" width="128" height="128">
                        </div>
                        <h2 class="tournament_title">那年十八，站如喽啰</h2>
                        <p class="tournament_content">Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
                        <p><a class="btn btn-default" href="#" role="button">查看原文 »</a></p>
                    </div>
                </div>
            </div>

            <div class="main-rightpart col-lg-4 col-md-4">
                <!--人物-->
                <div class="topics">
                    <h4 style="margin-top:20px;" class="text-left"><span class="glyphicon iconfont icon-huati" style="font-size:24px;"></span>话题</h4>
                    <hr style="border-top:solid 1px #c3c3c3">

                    <ul class="list-group">
                        <li class="list-group-item" ng-class="{active:xHT.remark=='hotest'}" ng-repeat="xHT in pageData_HotTopics">
                            <span class="badge" style="margin-top:3%">21</span>
                                <h4 class="list-group-item-heading">
                                    <i class="iconfont icon-hot" style="color:#df4239;font-size:18px;font-weight:100;display:inline" ng-if="xHT.remark == 'hotest'"></i>
                                    <a ng-href="/#/topic/{{xHT.topic_id}}">{{xHT.title}}</a>
                                </h4>

                            <p class="list-group-item-text">
                                {{xHT.subtitle}}
                            </p>
                        </li>
                    </ul>

                    <div class="list-group">
                    </div>
                </div>
                <!--话题-->
                <div class="figures" style="margin-top:35px">
                    <h4 style="margin-top:20px;" class="text-left"><span class="glyphicon iconfont icon-renwu" style="font-size:24px;"></span>人物</h4>
                    <hr style="border-top:solid 1px #c3c3c3">
                    <div class="figures_container">
                        <a ng-repeat="xHP in pageData_HotPersons" ng-href="/#/person?uid={{xHP.uid}}" title="{{xHP.title}}">
                            <img class="col-lg-3 col-md-4 col-sm-4 col-xs-6" ng-src="{{xHP.avatar}}" width/>
                        </a>
                    </div>
                </div><!--End of figures-->
                <!--返回头部-->
                <hr style="border-top:solid 1px #c3c3c3;">
            </div><!--End of rightpart-->
        </div>

        <hr style="border-top:solid 1px #c3c3c3;">
        <?php echo $footer;?>
    </div>
</div>