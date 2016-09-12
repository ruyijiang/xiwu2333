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
</style>

<div ng-controller="writeTopicController" style="margin-top:110px">

    <div class="container">
        <div role="main" class="row main community-main" style="background-color:#efefef;box-shadow: 0px 0px 3px #999;padding:0">
            <div class="main-leftpart col-lg-8 col-md-8" style="background-color:white;padding-bottom:35px;min-height:705px">
                <!-- 热门推荐 -->
                <div class="topic_container">
                    <form>
                        <div class="topic_editor_content">
                            <legend>
                                <span class="glyphicon glyphicon-link" style="font-size:20px"></span>自定义链接
                            </legend>
                            <div class="row">
                                <div class="col-lg-1 col-sm-1 col-xs-1">
                                </div>
                                <div class="col-lg-11 col-sm-11 col-xs-11">
                                    <p>http://www.xiwu2333.com/topic/<span style="font-weight:bold">{{pageData.customUrl}}</span></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-1 col-sm-1 col-xs-1"></div>
                                <div class="col-lg-11 col-sm-11 col-xs-11">
                                    <div class="input-group">
                                        <input type="text" class="form-control" style="font-weight:bold" ng-model="pageData.customUrl">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button">
                                            <i class="iconfont icon-copy" style="font-size:12px;margin-right:4px"></i>复制URL链接
                                        </button>
                                    </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-1 col-sm-1 col-xs-1"></div>
                                <div class="form-group col-lg-11 col-sm-11 col-xs-11">
                                    <small><i class="iconfont icon-alert" style="color:#337ab7;"></i>您可以不填写此项，那么将使用默认的URL链接</small>
                                </div>
                            </div>

                            <legend><span class="glyphicon glyphicon-align-left" style="font-size:20px"></span>话题正文</legend>
                            <div class="row">
                                <div class="col-lg-1 col-sm-1 col-xs-1"></div>
                                <div class="form-group col-lg-11 col-sm-11 col-xs-11">
                                    <input class="form-control" type="text" placeholder="话题标题">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-1 col-sm-1 col-xs-1">
                                    <span class="glyphicon glyphicon-align-user" style="font-size:20px"></span>
                                </div>
                                <div class="form-group col-lg-11 col-sm-11 col-xs-11">
                                    <textarea class="form-control" type="text" placeholder="话题描述" style="resize: vertical" rows="4"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="topic_choice">
                            <legend><span class="glyphicon glyphicon-paperclip" style="font-size:20px"></span>话题选项</legend>

                            <div class="row">
                                <div class="col-lg-2 col-sm-2 col-xs-1">
                                    <span class="glyphicon glyphicon-bookmark" style="font-size:12px"></span>话题分类：
                                </div>
                                <div class="form-group col-lg-10 col-sm-10 col-xs-10">
                                    <label class="btn_forer"><input class="topic_radio" type="radio" name="topic_cate" value="1" i-check prop="testra">战报</label>
                                    <label class="btn_forer"><input class="topic_radio" type="radio" name="topic_cate" value="2" i-check prop="testra">技术贴</label>
                                    <label class="btn_forer"><input class="topic_radio" type="radio" name="topic_cate" value="3" i-check prop="testra">八卦</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-sm-2 col-xs-1">
                                    <span class="glyphicon glyphicon-tags" style="font-size:12px"></span>关键词：
                                </div>
                                <div class="form-group col-lg-10 col-sm-10 col-xs-10">
                                    <input name="tags" id="tags" value="Dota2"/>
                                </div>
                            </div>
                        </div>

                        <div>
                            <a class="btn btn-primary center-block" disabled="disabled"><span class="glyphicon glyphicon-send"></span>确认发表</a>
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
