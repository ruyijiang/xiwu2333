<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/9/9
 * Time: 14:15
 */
require("library/xwBE-0.0.1/connectDB.php");
require("library/xwBE-0.0.1/all.php");
include("library/xwFE-0.0.1/FEM.php");
?>
<style>
    body{background-color:#dadada}
    .topic_container{margin-top:25px;}
</style>

<div ng-controller="writeTopicController" style="margin-top:110px">

    <div class="container">
        <div role="main" class="row main community-main" style="background-color:#efefef;box-shadow: 0px 0px 3px #999;padding:0">
            <div class="main-leftpart col-lg-8 col-md-8" style="background-color:white;padding-bottom:35px;min-height:705px">
                <!-- 热门推荐 -->
                <div class="topic_container">
                    <form ng-submit="saveData()">
                        <div class="topic_editor_content">
                            <legend style="padding:6px 0">
                                <span class="glyphicon glyphicon-link" style="font-size:20px"></span>自定义链接
                            </legend>
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <p>URL链接预览：http://www.xiwu2333.com/#/topic/<span style="font-weight:bold">{{pageData.customUrl}}</span></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" style="font-weight:bold" name="customUrl" id="customUrl" ng-model="pageData.customUrl">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button" id="d_clip_button" data-clipboard-target="customUrl" ng-disabled="!pageData.customUrl || pageData.customUrl == ''">
                                                <i class="iconfont icon-copy" style="font-size:12px;margin-right:4px"></i>复制URL链接
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-12 col-sm-12 col-xs-12">
                                    <span ng-if="urlReminder == 0" style="display:block"><span class="glyphicon glyphicon-remove" style="color:#d9534f;font-size:12px;"></span>该自定义链接不符合要求或已被占用</span>
                                    <span ng-if="urlReminder == 1" style="display:block"><span class="glyphicon glyphicon-ok" style="color:#57d718;font-size:12px;"></span>可以使用</span>
                                    <small style="color:#888" ng-if="urlReminder == 2"><i class="iconfont icon-alert" style="color:#337ab7;margin-right:5px"></i>您可以不填写此项，那么将使用默认的URL链接。</small>
                                </div>
                            </div>

                            <legend style="padding:6px 0"><span class="glyphicon glyphicon-align-left" style="font-size:20px"></span>话题正文</legend>
                            <div class="row">
                                <div class="form-group col-lg-12 col-sm-12 col-xs-12">
                                    <input class="form-control" type="text" placeholder="话题标题" ng-model="pageData.topic_title">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-12 col-sm-12 col-xs-12">
                                    <textarea class="form-control" type="text" placeholder="话题描述" style="resize: vertical" rows="4" ng-model="pageData.topic_desc"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="topic_choice">
                            <legend style="padding:6px 0"><span class="glyphicon glyphicon-paperclip" style="font-size:20px"></span>话题选项</legend>

                            <div class="row">
                                <div class="col-lg-2 col-sm-2 col-xs-1">
                                    <span class="glyphicon glyphicon-bookmark" style="font-size:12px"></span>话题分类：
                                </div>
                                <div class="form-group col-lg-10 col-sm-10 col-xs-10">
                                    <label class="btn_forer"><input class="topic_radio" type="radio" name="topic_cate" value="1" i-check ng-model="pageData.topic_cate" prop="pageData.topic_cate">天梯</label>
                                    <label class="btn_forer"><input class="topic_radio" type="radio" name="topic_cate" value="2" i-check ng-model="pageData.topic_cate" prop="pageData.topic_cate">赛事</label>
                                    <label class="btn_forer"><input class="topic_radio" type="radio" name="topic_cate" value="3" i-check ng-model="pageData.topic_cate" prop="pageData.topic_cate">技术贴</label>
                                    <label class="btn_forer"><input class="topic_radio" type="radio" name="topic_cate" value="4" i-check ng-model="pageData.topic_cate" prop="pageData.topic_cate">八卦</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-sm-2 col-xs-1">
                                    <span class="glyphicon glyphicon-tags" style="font-size:12px"></span>关键词：
                                </div>
                                <div class="form-group col-lg-10 col-sm-10 col-xs-11">
                                    <tagsinput ng-model="pageData.topic_tags" tags-data="pageData.topic_tags"></tagsinput>
                                </div>
                            </div>
                        </div>

                        <div>
                            <input type="submit" class="btn btn-primary center-block" value="确认发表">
                        </div>

                        <hr>
                    </form>
                </div>

            </div><!--End of leftpart-->







            <div class="main-rightpart col-lg-4 col-md-4">
            </div><!--End of rightpart-->

        </div><!--End of main-->

        <hr style="border-top:solid 1px #c3c3c3;">
        <?php echo $footer;?>
    </div><!-- End of container -->

</div><!--End of controller-->
