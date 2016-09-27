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
            <div class="main-leftpart col-lg-8 col-md-8" style="background-color:white;padding-bottom:35px;min-height:705px">
                <!-- 热门推荐 -->
                <div class="topic_container">
                    <h3 class="text-left">
                        <span class="glyphicon glyphicon-align-left"></span>讲道理的话，你们觉得哪个女主播最漂亮？
                        <small>2016/09/06 13:43</small>
                    </h3>

                        <h4 style="display: inline-block;color:#777;">
                            <span style="line-height:1.6em;">如果只有一个机会，你会看谁的直播呢？（这是导语，只在讨论发言情况下出现）如果只有一个机会，你会看谁的直播呢？（这是导语，只在讨论发言情况下出现）</span>
                        </h4>
                    <div>
                        <h6 style="display: inline-block"><span class="glyphicon glyphicon-user"></span>话题发起人：</h6>
                        <a><img src="img/user_img/avatar/default/default_female2.png" class="img-circle" width="26" height="26" style="margin-right:3px;">攻略写手 - shy</a>
                    </div>
                    <div>
                        <h6 style="display: inline-block"><span class="glyphicon glyphicon-tags"></span>标签：</h6>
                        <div class="label label-primary ng-scope"><span class="glyphicon glyphicon-tag"></span>直播</div>
                        <div class="label label-primary ng-scope"><span class="glyphicon glyphicon-tag"></span>女主播</div>
                        <div class="label label-primary ng-scope"><span class="glyphicon glyphicon-tag"></span>Dota2</div>
                        <div class="label label-primary ng-scope"><span class="glyphicon glyphicon-tag"></span>英雄联盟</div>
                    </div>

                    <div class="topic_content">
                        <form ng-submit="saveData()">
                            <ol>
                                <li>
                                    <label class="btn_forer"><input class="topic_radio" type="radio" name="most_beautiful" value="1" i-check prop="topic_radio" ng-model="topic_radio">冷冷</label>
                                </li>
                                <li>
                                    <label class="btn_forer"><input class="topic_radio" type="radio" name="most_beautiful" value="2" i-check prop="topic_radio" ng-model="topic_radio">Mik</label>
                                </li>
                                <li>
                                    <label class="btn_forer"><input class="topic_radio" type="radio" name="most_beautiful" value="3" i-check prop="topic_radio" ng-model="topic_radio">Miss</label>
                                </li>
                                <li>
                                    <label class="btn_forer"><input class="topic_radio" type="radio" name="most_beautiful" value="4" i-check prop="topic_radio" ng-model="topic_radio">张天鸽</label>
                                </li>
                            </ol>
                            <ol style="display:none">
                                <li>
                                    <label class="btn_forer"><input class="topic_checkbox" type="checkbox" i-check prop="test1" ng-click="checkbox_choose(0)">冷冷</label>
                                </li>
                                <li>
                                    <label class="btn_forer"><input class="topic_checkbox" type="checkbox" i-check prop="test2" ng-click="checkbox_choose(1)">Mik</label>
                                </li>
                                <li>
                                    <label class="btn_forer"><input class="topic_checkbox" type="checkbox" i-check prop="test3" ng-click="checkbox_choose(2)">Miss</label>
                                </li>
                                <li>
                                    <label class="btn_forer"><input class="topic_checkbox" type="checkbox" i-check prop="test4" ng-click="checkbox_choose(3)">张天鸽</label>
                                </li>
                                <li>
                                    <label class="btn_forer"><input class="topic_checkbox" type="checkbox" i-check prop="test5" ng-click="checkbox_choose(4)">时尚</label>
                                </li>
                            </ol>
                            <div style="padding:15px 0;display:none">
                                <textarea class="form-control" rows="4" style="resize: vertical;max-height:600px;padding-top:11px;"></textarea>
                            </div>
                            <input type="submit" class="btn btn-primary center-block">
                        </form>
                    </div>

                    <hr>
                </div>

                <!-- 赛事链接,3期做赛事链接，4期做详细内容 -->
                <ul class="topic_comments list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-1">
                                <img ng-src="img/user_img/avatar/default/default_female.png" class="img-rounded" width="54" height="54" src="img/user_img/avatar/default/default_female.png">
                            </div>
                            <div class="col-lg-11 col-md-11 col-sm-10 col-xs-11">
                                <a style="font-weight:600" ng-href="/#/person?uid=10000001" class="ng-binding" href="/#/person?uid=10000001">Milo</a>
                                <span style="font-size:13px;margin-left:5px" class="ng-binding">- 2016/09/04 23:41:44</span>
                                <p style="margin-top:6px" class="ng-binding"><!-- ngIf: xcom.to_id -->55555</p>
                            </div>
                        </div>
                        <div class="row comment_shower_scul">
                            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-1"></div>
                            <div class="col-lg-11 col-md-11 col-sm-10 col-xs-11">
                                <div class="comment_shower_buttons clearfix">
                                    <a ng-class="{active:commentAreaShower == $index}" ng-click="commentthis($index)" class=""><span class="glyphicon glyphicon-comment"></span>评论</a>
                                </div>
                                <form class="clearfix ng-pristine ng-valid ng-hide" role="form" style="padding-bottom:10px" ng-show="commentAreaShower == $index">
                                    <textarea class="form-control ng-pristine ng-untouched ng-valid" style="resize:vertical;padding:8px;font-size:13px" rows="2" ng-model="xcom.new_content"></textarea>
                                    <a class="btn btn-primary pull-right" style="margin-top:3px;padding:5px 20px" ng-init="xcom.new_content=''" ng-disabled="xcom.new_content==''" ng-click="sendcomment(xcom.from_uid,xcom.new_content)" disabled="disabled">评论</a>
                                </form>
                            </div>
                        </div>
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

            <div class="main-rightpart col-lg-4 col-md-4">
                <!--人物-->
                <div class="others_topics">
                    <h4 style="margin-top:20px;" class="text-left"><span class="glyphicon iconfont icon-huati" style="font-size:24px;"></span>相关话题</h4>
                    <hr style="border-top:solid 1px #c3c3c3">

                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge" style="margin-top:3%">21</span>
                            <h4 class="list-group-item-heading">
                                <a>本届Ti发挥最优异的选手是哪位？</a>
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

                <div class="latest_comments" style="margin-top:35px;">
                    <h4 style="margin-top:20px;" class="text-left"><span class="glyphicon iconfont icon-huati" style="font-size:24px;"></span>最新发表</h4>
                    <hr style="border-top:solid 1px #c3c3c3">

                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge" style="margin-top:3%">21</span>
                            <h4 class="list-group-item-heading">
                                <a>本届Ti发挥最优异的选手是哪位？</a>
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



