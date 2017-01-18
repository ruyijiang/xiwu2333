<?php
require("library/xwBE/connectDB.php");
require("library/xwBE/all.php");
include("library/xwFE/FEM.php");
?>
<style>body{background-color:#f5f8fa}.title_toppart,.title_botpart{width:100%}.title_toppart i{font-size:26px}.mid_toppart i{font-size:32px}.title_botpart span{font-size:15px;font-weight:300}.writeblog_title{border-bottom:solid #d3e0e9 1px;padding:15px 0}.blog-success{color:#71a359}.blog-wanted{color:gray}.blog-wrong{color:#a24747}.chooseAType label{cursor:pointer;font-weight:normal}</style>

<div class="container" ng-controller="writeblogcontroller" style="margin-top:130px">
    <!--让用户选择刊发时间-->
    <div class="modal fade" id="myModal_publishment" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="library/xwBE/Interface/setPublishment/setPublishment.php" target="_self" method="POST">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">
                            <div style="font-size:16px;font-weight:bold">选择刊发日期和时间<span class="glyphicon glyphicon-info-sign" style="font-size:14px;color:red"  data-toggle="tooltip" data-placement="bottom" title="本网站并不保证您所刊发的文章一定能够在社区广场滚动展示。友情提示：为使您的封面文章能够尽可能地展示在社区广场顶部，被更多人看见，建议您选择刊发文章数较少的日期。"></span></div>
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div class="center-block" id="cover-publish" style="height:420px;width:570px;"></div>
                        <div class="text-center" id="publishTime_div" style="display: none">
                            <span style="font-weight:bold">
                                刊发时间是：
                                <span id="publishDate_span"></span> 07:00，请选择刊发时长：
                            </span>
                            <div class="btn-group dropup">
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                                    <span id="publishTime_span">请选择&nbsp;&nbsp;</span><span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu publishTimeChooser" role="menu" style="min-width: 120px">
                                    <li><a ng-click="chooseTime(12)">12小时</a></li>
                                    <li><a ng-click="chooseTime(24)">24小时</a></li>
                                    <li><a ng-click="chooseTime(29)">29小时</a></li>
                                    <li><a ng-click="chooseTime(34)">34小时</a></li>
                                    <li><a ng-click="chooseTime(48)">48小时</a></li>
                                </ul>
                            </div>
                        </div>
                        <input type="hidden" id="publishDate_ipt" name="publishDate" value><!--隐藏区域，用以储存选择的刊发日期-->
                        <input type="hidden" id="publishTime_ipt" name="publishDuration" value><!--隐藏区域，用以储存选择的刊发时长-->
                        <input type="hidden" id="cover_id" name="cover_id" value><!--隐藏区域，用以储存选择文章的cover_id-->
                    </div>
                    <div class="modal-footer">
                        <a style="margin-right:14px" ng-click="useDefault()">使用系统默认设置</a>
                        <input type="submit" class="btn btn-primary" id="confirm_time" value="确认选择">
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>

    <div class="row boat" style="margin:0;padding-top:0">
        <div class="writeblog_title clearfix bg-info">
            <div class="col-lg-offset-1 col-sm-offset-1 col-lg-2 col-sm-2 text-center" ng-class="{true: 'blog-success', false: 'blog-wanted'}[TabShow==1]">
                <div class="title_toppart">
                    <i class="iconfont icon-biaoti"></i>
                </div>
                <div class="title_botpart">
                    <span>拟定文章标题</span>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal_publishment" ng-click="tellmemore()">
                        开始演示模态框
                    </button>
                </div>
            </div>
            <div class="col-lg-2 col-sm-2 text-center blog-wanted">
                <div class="mid_toppart">
                    <i class="iconfont icon-circle" style="display:block;margin-top:10px"></i>
                </div>
            </div>
            <div class="col-lg-2 col-sm-2 text-center blog-wanted" ng-class="{true: 'blog-success', false: 'blog-wanted'}[TabShow==2]">
                <div class="title_toppart">
                    <i class="iconfont icon-zhengwen"></i>
                </div>
                <div class="title_botpart">
                    <span>撰写文章正文</span>
                </div>
            </div>
            <div class="col-lg-2 col-sm-2 text-center blog-wanted">
                <div class="mid_toppart">
                    <i class="iconfont icon-circle" style="display:block;margin-top:10px"></i>
                </div>
            </div>
            <div class="col-lg-2 col-sm-2 text-center blog-wanted" ng-class="{true: 'blog-success', false: 'blog-wanted'}[TabShow==3]">
                <div class="title_toppart">
                    <i class="iconfont icon-wb_pic"></i>
                </div>
                <div class="title_botpart">
                    <span>上传封面图片</span>
                </div>
            </div>
        </div>

        <form ng-submit="articlesubmit()" novalidate role="form" id="writeblog_form" name="writeblog_form">
            <!-- blog-writer-part1 -->
            <div ng-show="TabShow == '1'" class="blog-writer-part1 col-lg-offset-1 col-sm-offset-1 col-lg-10 col-sm-10">
                <div class="row" style="margin-top:35px">
                    <div class="col-lg-offset-1 col-sm-offset-1 col-lg-10 col-sm-10">
                        <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label text-right">标题<sup style="color:red">*</sup></label>
                            <div class="col-lg-10 col-sm-10">
                                <input validator="required" type="text" class="form-control" ng-model="pageData.title" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:25px" ng-if="pageData.aType == 'cover'">
                    <div class="col-lg-offset-1 col-sm-offset-1 col-lg-10 col-sm-10">
                        <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label text-right">副标题<sup style="color:red">*</sup></label>
                            <div class="col-lg-10 col-sm-10">
                                <textarea type="text" class="form-control" style="resize: vertical" rows="2" ng-model="pageData.subtitle"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:25px">
                    <div class="col-lg-offset-1 col-sm-offset-1 col-lg-10 col-sm-10">
                        <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label text-right">摘要</label>
                            <div class="col-lg-10 col-sm-10">
                                <textarea type="text" class="form-control" style="resize: vertical" rows="4" ng-model="pageData.abstract"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row text-center" style="margin-top:35px">
                    <a ng-click="showTab(2)" class="btn btn-md btn-primary" style="padding-left:45px;padding-right:45px">下一步</a>
                </div>
            </div>

            <!-- blog-writer-part2 -->
            <div ng-show="TabShow == '2'" class="blog-writer-part2">
                <div class="ueditor-container">
                    <script id="ueditor-main" class="ueditor-main" style="height:450px;"></script>
                    <!--ng-bind-html="NeedModifiedContent|to_trusted"-->
                    <div class="alert alert-info clearfix" style="margin-top:-2px;">
                        <small>如果文本编辑器显示异常，请刷新页面。</small>
                    </div>
                </div>

                <div class="row text-center" style="margin-top:35px">
                    <a ng-click="showTab(1)" class="btn btn-md btn-default" style="padding-left:45px;padding-right:45px">上一步</a>
                    <a ng-click="showTab(3)" class="btn btn-md btn-primary" style="padding-left:45px;padding-right:45px">下一步</a>
                </div>
            </div>

            <!-- blog-writer-part3 -->
            <div ng-show="TabShow == '3'" class="blog-writer-part3" ng-controller="demoCtrl">
                <div style="margin-top:15px">

                    <div class="row">
                        <div class="uploadImg-nav">
                            <div class="col-lg-offset-1 col-sm-offset-1 col-lg-10 col-sm-10" style="padding-left:0;">
                                <ul class="nav nav-pills">
                                    <li ng-click="selectImg()">
                                        <a>选择背景图片</a>
                                    </li>
                                    <li class="dropdown" ng-show="pageData.aType == 'cover'">
                                        <a class="dropdown-toggle" data-toggle="dropdown">
                                            选取背景颜色<span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a ng-click="selectedForeColor = '#101010'">纯黑</a>
                                            </li>
                                            <li>
                                                <a ng-click="selectedForeColor = '#323232'">深灰</a>
                                            </li>
                                            <li>
                                                <a ng-click="selectedForeColor = '#4d5422'">深绿</a>
                                            </li>
                                            <li class="divider"></li>
                                            <li color-picker set-color="dynamicSetColor()">
                                                <a>
                                                    <div class="font-color" style="width:20px;height:20px;display:inline;padding-top:15px;padding-bottom:0"></div>自定义颜色
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li ng-show="pageData.aType == 'cover'">
                                        <a ng-click="showBtnContent = true">设置按钮文字</a>
                                    </li>
                                    <li >
                                        <input ng-if="showBtnContent && pageData.aType == 'cover'" type="text" class="form-control" style="width:150px;margin:3px 0 0 5px" ng-model="pageData.BtnContent" maxlength="18" required>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="upload dImg">
                        <div class="row">
                            <div class="col-lg-offset-1 col-sm-offset-1 col-lg-10 col-sm-10" ng-style="{'background-color': selectedForeColor}" style="border:dashed #777 1px;border-radius:3px;height:300px;margin-top:15px">
                                <div id="ImgShower_container" class="ImgShower" style="margin-left:15%;width:70%;height:100%">
                                    <img id="ImgShower" width="100%" height="100%"/>
                                    <div class="text-center" style="width:30%;position:absolute;color:#bababa;top:45%;left:35%">
                                        <small style="display: block">图片预览</small>
                                        <small style="display: block">建议上传分辨率较大的图片</small>
                                        <a class="btn btn-sm btn-primary" style="margin-top:35px">{{pageData.BtnContent}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row text-center" style="margin-top:35px">
                    <a ng-click="showTab(2)" class="btn btn-md btn-default" style="padding-left:45px;padding-right:45px">上一步</a>
                    <a ng-disabled="submitbtnAvail" ng-click="uploadImg()" id="submit_btn" class="btn btn-md btn-primary submit_btn" style="padding-left:25px;padding-right:25px">
                        <span class="glyphicon glyphicon-cloud-upload"></span>{{uploadbtn_content}}
                    </a>
                    <button ng-disabled="!submitbtnAvail" type="submit" id="submit_btn" class="btn btn-md btn-primary submit_btn"  style="padding-left:35px;padding-right:45px">
                        <span class="glyphicon glyphicon-send"></span>发表
                    </button>
                </div>
            </div>

        </form>


        <!--用户在这里选择文章类型-->
        <dialog ng-if="chooseType.open" modal fixed>
            <div dialog-title>{{chooseType.title}}</div>
            <div dialog-content>
                <div style="margin:15px;margin-bottom:25px" class="chooseAType">
                    <label style="margin-right:35px">
                        <input type="radio" name="aType" i-check value="cover" ng-model="pageData.aType" prop="pageData.aType"/>
                        <span style="display:inline-block;margin-left:3px">封面文章</span>
                    </label>
                    <label>
                        <input type="radio" name="aType" i-check value="normal" ng-model="pageData.aType" prop="pageData.aType"/>
                        <span style="display:inline-block;margin-left:3px">普通文章</span>
                    </label>
                </div>
                <button ng-disabled="!pageData.aType" class="btn btn-primary center-block" role="button" ng-click="chooseType.open = false" style="display:block;margin-top:15px">确认</button>
            </div>
        </dialog>


        <!--真正的图像处理区-->
        <form id="upload_img" method="POST" action="library/xwBE/php/uploadCoverImg_action.php" target="uploadCoverImg" enctype="multipart/form-data" style="display:none">
            <input type="file" id="uploadbtn" name="coverImg" accept=".jpg,.jpeg,.png" onchange="javascript:setImagePreview(this,$('#ImgShower_container'),$('#ImgShower'));"/>
            <input type="text" name="imgname" id="imgname">
            <input type="text" name="atype" id="arttype">
            <input type="submit" id="uploadbtn_submit">
        </form>

        <!--封面图片真正上传到的地方-->
        <iframe id="uploadCoverImg" name="uploadCoverImg" style="display:none" src="library/xwBE/php/uploadCoverImg_action.php"></iframe>

    </div>

    <hr>
    <?php echo $footer;?>
