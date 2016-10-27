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
                        <span class="glyphicon glyphicon-align-left"></span>{{pageData.title}}
                        <small>{{pageData.regtime}}</small>
                    </h3>
                    <h4 style="color:#777;">
                        <span style="line-height:1.6em;word-wrap: break-word">{{pageData.topic_desc}}</span>
                    </h4>
                    <div>
                        <h6 style="display: inline-block"><span class="glyphicon glyphicon-user"></span>话题发起人：</h6>
                        <a ng-href="/#/person?uid={{pageData.uid}}"><img ng-src="{{pageData.user_avatar}}" class="img-circle" width="26" height="26" style="margin-right:3px;">{{pageData.user_name}}</a>
                    </div>
                    <div>
                        <h6 style="display: inline-block"><span class="glyphicon glyphicon-tags"></span>标签：</h6>
                        <div ng-repeat="xTag in pageData.tags" class="label label-primary ng-scope" style="margin-right:8px">
                            <span class="glyphicon glyphicon-tag"></span>{{xTag}}
                        </div>
                    </div>

                    <div class="topic_content">
                        <form ng-submit="saveData()">
                            <ol ng-if="pageData.topic_classification == 'radio'">
                                <li ng-repeat="xcho in pageData.topic_choices track by $index">
                                    <label class="btn_forer"><input class="topic_radio" type="radio" name="radio_choice" value="{{xcho.content}}" i-check prop="xcho.content" ng-model="choices">{{xcho.content}}</label>
                                </li>
                            </ol>
                            <ol ng-if="pageData.topic_classification == 'checkbox'">
                                <li ng-repeat="xcho in pageData.topic_choices">
                                    <label class="btn_forer"><input class="topic_checkbox" type="checkbox" i-check prop="xcho.content" ng-model="test1">{{xcho.content}}</label>
                                </li>
                            </ol>
                            <div style="padding:15px 0;" ng-if="pageData.topic_classification !== 'radio' && pageData.topic_classification !== 'checkbox'">
                                <textarea class="form-control" rows="4" style="resize: vertical;max-height:600px;padding-top:11px;"></textarea>
                            </div>
                            <input ng-if="pageData.topic_classification == 'radio' || pageData.topic_classification == 'checkbox'" type="submit" class="btn btn-primary" style="width:100%" value="提交投票">
                            <input ng-if="pageData.topic_classification !== 'radio' && pageData.topic_classification !== 'checkbox'" type="submit" class="btn btn-primary" style="width:100%" value="发表我的观点">
                        </form>
                        <form class="clearfix ng-pristine ng-valid" role="form" style="margin-top:15px">
                            <textarea ng-disabled="1==1" class="form-control ng-pristine ng-untouched ng-valid" style="resize:vertical;padding:8px;font-size:13px" rows="2" ng-model="comment_content"></textarea>
                            <input ng-disabled="comment_content == ''" type="submit" class="btn btn-primary" style="width:100%" value="发表评论">
                        </form>
                    </div>

                    <hr>
                </div>

                <div class="comments_shower col-lg-12 col-md-12 col-sm-12 col-xs-12" id="comments_shower">
                    <div ng-repeat="xcom in comments track by $index">
                        <div class="row comments_shower_con">
                            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-1">
                                <img ng-src="{{xcom.from_avatar}}" class="img-rounded" width="54" height="54"/>
                            </div>
                            <div class="col-lg-11 col-md-11 col-sm-10 col-xs-11">
                                <a style="font-weight:600" ng-href="/#/person?uid={{xcom.from_uid}}">{{xcom.from_name}}</a>
                                <span style="font-size:13px;margin-left:5px">- {{xcom.regtime}}</span>
                                <p style="margin-top:6px"><small ng-if="xcom.to_id">回复 <a ng-href="/#/person?uid={{xcom.to_id}}">{{xcom.to_name}}</a>：</small>{{xcom.content}}</p>
                            </div>
                        </div>
                        <div class="row comment_shower_scul">
                            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-1"></div>
                            <div class="col-lg-11 col-md-11 col-sm-10 col-xs-11">
                                <div class="comment_shower_buttons clearfix">
                                    <a ng-class="{active:commentAreaShower == $index}" ng-click="commentthis($index)"><span class="glyphicon glyphicon-comment"></span>评论</a>
                                </div>
                                <form class="clearfix" role="form" style="padding-bottom:10px" ng-show="commentAreaShower == $index">
                                    <textarea class="form-control" style="resize:vertical;padding:8px;font-size:13px" rows="2" ng-model="xcom.new_content"></textarea>
                                    <a class="btn btn-primary pull-right" style="margin-top:3px;padding:5px 20px" ng-init="xcom.new_content=''" ng-disabled="xcom.new_content==''" ng-click="sendcomment(xcom.from_uid,xcom.new_content)">评论</a>
                                </form>
                            </div>
                        </div>
                    </div><!--End of comment_1-->
                </div><!--Div#comments_shower-->

                <div class="col-lg-12 text-center">
                    <nav>
                        <ul class="pagination">
                            <li ng-if="ListActive!==1">
                                <a aria-label="Previous" ng-click="changeShowPage(1,A_aid)">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li ng-repeat="xpag in ArticlePageListInfo" ng-class="{active:ListActive==xpag}" ng-disabled="ListActive==xpag" ng-if="xpag >= ListActive - 3 && xpag <= ListActive + 3"><a ng-click="changeShowPage(xpag,A_aid)">{{xpag}}</a></li>
                            <li ng-if="ListActive!==maxPageNum">
                                <a aria-label="Next" ng-click="changeShowPage(maxPageNum,A_aid)">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="main-rightpart col-lg-4 col-md-4">
                <!--人物-->
                <div class="others_topics">
                    <h4 style="margin-top:20px;" class="text-left"><span class="glyphicon iconfont icon-huati" style="font-size:24px;"></span>相关话题</h4>
                    <hr style="border-top:solid 1px #c3c3c3">

                    <ul class="list-group">
                        <li class="list-group-item" ng-repeat="xRel in pageData.related_topics">
                            <span class="badge" style="margin-top:3%">21</span>
                            <h4 class="list-group-item-heading" style="text-overflow:ellipsis; white-space:nowrap; overflow:hidden;">
                                <a ng-href="/#/topic/{{xRel.customed_url}}">{{xRel.title}}</a>
                            </h4>

                            <p class="list-group-item-text" style="word-wrap: break-word">
                                {{xRel.topic_desc}}
                            </p>
                        </li>
                    </ul>
                </div>

                <div class="latest_comments" style="margin-top:35px;">
                    <h4 style="margin-top:20px;" class="text-left"><span class="glyphicon iconfont icon-huati" style="font-size:24px;"></span>最新发表</h4>
                    <hr style="border-top:solid 1px #c3c3c3">

                    <ul class="list-group">
                        <li class="list-group-item" ng-repeat="xLat in pageData.LatestTopicArr">
                            <span class="badge" style="margin-top:3%">21</span>
                            <h4 class="list-group-item-heading" style="text-overflow:ellipsis; white-space:nowrap; overflow:hidden;">
                                <a ng-href="/#/topic/{{xLat.customed_url}}">{{xLat.title}}</a>
                            </h4>

                            <p class="list-group-item-text" style="word-wrap: break-word">
                                {{xLat.topic_desc}}
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



