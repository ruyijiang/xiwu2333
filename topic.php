<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/9/5
 * Time: 21:07
 */
require("library/xwBE-0.0.1/connectDB.php");
require("library/xwBE-0.0.1/all.php");
include("library/xwFE-0.0.1/FEM.php");
?>
<style>
    body{background-color:#dadada}
</style>

<div ng-controller="topicController" style="margin-top:110px">

    <div class="container">
        <div role="main" class="row main community-main" style="background-color:#efefef;box-shadow: 0px 0px 3px #999;padding:0">
            <div class="main-leftpart col-lg-8 col-md-8" style="background-color:white;padding-bottom:35px">
                <!-- 热门推荐 -->
                <div class="topic_container">
                    <h3 style="margin-top:20px;" class="text-left">
                        <span class="glyphicon glyphicon-align-left"></span>讲道理的话，你们觉得哪个女主播最漂亮？
                    </h3>
                    <h6 style="display: inline-block">标签：</h6>
                    <div class="label label-primary ng-scope"><span class="glyphicon glyphicon-tag"></span>直播</div>
                    <div class="label label-primary ng-scope"><span class="glyphicon glyphicon-tag"></span>女主播</div>
                    <div class="label label-primary ng-scope"><span class="glyphicon glyphicon-tag"></span>Dota2</div>
                    <div class="label label-primary ng-scope"><span class="glyphicon glyphicon-tag"></span>英雄联盟</div>

                    <div class="topic_content">
                        <label><input type="radio" name="most_beautiful">冷冷</label>
                        <label><input type="radio" name="most_beautiful">Mik</label>
                        <label><input type="radio" name="most_beautiful">Miss</label>
                    </div>

                    <hr>
                </div>


                <!-- 赛事链接,3期做赛事链接，4期做详细内容 -->
                <div class="tournaments text-center clearfix">
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
                <div class="others_topics">
                    <h4 style="margin-top:20px;" class="text-left"><span class="glyphicon iconfont icon-huati" style="font-size:24px;"></span>相关话题</h4>
                    <hr style="border-top:solid 1px #c3c3c3">

                    <ul class="list-group">
                        <li class="list-group-item active">
                            <span class="badge" style="margin-top:3%">21</span>
                            <h4 class="list-group-item-heading">
                                <i class="iconfont icon-hot" style="color:#df4239;font-size:18px;font-weight:100;display:inline"></i>
                                <a style="color:white">本届Ti发挥最优异的选手是哪位？</a>
                            </h4>

                            <p class="list-group-item-text">
                                您将通过网页进行免费域名注册。
                            </p>
                        </li>
                        <li class="list-group-item">
                            <span class="badge" style="margin-top:3%">9</span>
                            <a>
                                <h4 class="list-group-item-heading">
                                    剑圣六神对单是否打得过幽鬼？
                                </h4>
                            </a>
                            <p class="list-group-item-text">
                                我们提供 24*7 支持。
                            </p>
                        </li>
                        <li class="list-group-item">
                            <span class="badge" style="margin-top:3%">9</span>
                            <a>
                                <h4 class="list-group-item-heading">
                                    讲道理哪位女主播最漂亮？
                                </h4>
                            </a>
                            <p class="list-group-item-text">
                                我们提供 24*7 支持。
                            </p>
                        </li>
                        <li class="list-group-item">
                            <span class="badge" style="margin-top:3%">4</span>
                            <a>
                                <h4 class="list-group-item-heading">
                                    24*7 支持
                                </h4>
                            </a>
                            <p class="list-group-item-text">
                                我们提供 24*7 支持。
                            </p>
                        </li>
                    </ul>
                </div>

                <div class="others_topics" style="margin-top:35px">
                    <h4 style="margin-top:20px;" class="text-left"><span class="glyphicon iconfont icon-huati" style="font-size:24px;"></span>最新发表</h4>
                    <hr style="border-top:solid 1px #c3c3c3">

                    <ul class="list-group">
                        <li class="list-group-item active">
                            <span class="badge" style="margin-top:3%">21</span>
                            <h4 class="list-group-item-heading">
                                <i class="iconfont icon-hot" style="color:#df4239;font-size:18px;font-weight:100;display:inline"></i>
                                <a style="color:white">本届Ti发挥最优异的选手是哪位？</a>
                            </h4>

                            <p class="list-group-item-text">
                                您将通过网页进行免费域名注册。
                            </p>
                        </li>
                        <li class="list-group-item">
                            <span class="badge" style="margin-top:3%">9</span>
                            <a>
                                <h4 class="list-group-item-heading">
                                    剑圣六神对单是否打得过幽鬼？
                                </h4>
                            </a>
                            <p class="list-group-item-text">
                                我们提供 24*7 支持。
                            </p>
                        </li>
                        <li class="list-group-item">
                            <span class="badge" style="margin-top:3%">9</span>
                            <a>
                                <h4 class="list-group-item-heading">
                                    讲道理哪位女主播最漂亮？
                                </h4>
                            </a>
                            <p class="list-group-item-text">
                                我们提供 24*7 支持。
                            </p>
                        </li>
                        <li class="list-group-item">
                            <span class="badge" style="margin-top:3%">4</span>
                            <a>
                                <h4 class="list-group-item-heading">
                                    24*7 支持
                                </h4>
                            </a>
                            <p class="list-group-item-text">
                                我们提供 24*7 支持。
                            </p>
                        </li>
                    </ul>
                </div>
            </div><!--End of rightpart-->
        </div>

        <hr style="border-top:solid 1px #c3c3c3;">
        <?php echo $footer;?>
    </div>
</div>



