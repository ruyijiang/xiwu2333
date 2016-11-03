<?php
require("library/xwBE-0.0.1/connectDB.php");
require("library/xwBE-0.0.1/all.php");
include("library/xwFE-0.0.1/FEM.php");
?>
<style>
    body{background-color:#f5f8fa}
    .title_toppart,.title_botpart{width:100%}
    .title_toppart i{font-size:26px}
    .mid_toppart i{font-size:32px}
    .title_botpart span{font-size:16px}
    .writeblog_title{border-bottom:solid rgb(211, 224, 233) 1px;padding:15px 0}
    .blog-success{color:limegreen}
    .blog-wanted{color:gray}
    .blog-wrong{color:darkred}
</style>

<div class="container" ng-controller="writeblogcontroller" style="margin-top:130px">

    <div class="row boat" style="margin:0;padding-top:0">

        <div class="writeblog_title clearfix bg-info">
            <div class="col-lg-1 col-sm-1"></div>
            <div class="col-lg-2 col-sm-2 text-center blog-success">
                <div class="title_toppart">
                    <i class="iconfont icon-biaoti"></i>
                </div>
                <div class="title_botpart">
                    <span>拟定文章标题</span>
                </div>
            </div>
            <div class="col-lg-2 col-sm-2 text-center blog-success">
                <div class="mid_toppart">
                    <i class="iconfont icon-right" style="display:block;margin-top:10px"></i>
                </div>
            </div>
            <div class="col-lg-2 col-sm-2 text-center blog-wrong">
                <div class="title_toppart">
                    <i class="iconfont icon-zhengwen"></i>
                </div>
                <div class="title_botpart">
                    <span>撰写文章正文</span>
                </div>
            </div>
            <div class="col-lg-2 col-sm-2 text-center blog-wrong">
                <div class="mid_toppart">
                    <i class="iconfont icon-wrong" style="display:block;margin-top:10px"></i>
                </div>
            </div>
            <div class="col-lg-2 col-sm-2 text-center blog-wanted">
                <div class="title_toppart">
                    <i class="iconfont icon-wb_pic"></i>
                </div>
                <div class="title_botpart">
                    <span>上传封面图片</span>
                </div>
            </div>
            <div class="col-lg-1 col-sm-1"></div>
        </div>

        <form>

            <!-- blog-writer-part1 -->
            <div ng-show="TabShow == '1'" class="blog-writer-part1">
                <div class="row" style="margin-top:35px">
                    <div class="col-lg-1 col-sm-1"></div>
                    <div class="col-lg-10 col-sm-10">
                        <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label text-right">标题</label>
                            <div class="col-lg-10 col-sm-10">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 col-sm-1"></div>
                </div>
                <div class="row" style="margin-top:25px">
                    <div class="col-lg-1 col-sm-1"></div>
                    <div class="col-lg-10 col-sm-10">
                        <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label text-right">副标题</label>
                            <div class="col-lg-10 col-sm-10">
                                <textarea type="text" class="form-control" style="resize: vertical" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 col-sm-1"></div>
                </div>
                <div class="row" style="margin-top:25px">
                    <div class="col-lg-1 col-sm-1"></div>
                    <div class="col-lg-10 col-sm-10">
                        <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label text-right">摘要</label>
                            <div class="col-lg-10 col-sm-10">
                                <textarea type="text" class="form-control" style="resize: vertical" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 col-sm-1"></div>
                </div>
                <div class="row text-center" style="margin-top:35px">
                    <a ng-click="showTab2()" class="btn btn-lg btn-primary" style="padding-left:45px;padding-right:45px">下一步</a>
                </div>
            </div>

            <!-- blog-writer-part2 -->
            <div ng-show="TabShow == '2'" class="blog-writer-part2">
                <div class="ueditor-container" style="display:none">
                    <script id="ueditor-main" class="ueditor-main" style="height:450px;"></script>
                    <!--ng-bind-html="NeedModifiedContent|to_trusted"-->
                    <div class="alert alert-info clearfix" style="margin-top:-2px;">
                        <small>如果文本编辑器显示异常，请刷新页面。</small>
                        <button type="submit" id="submit_btn" data-loading-text="提交中..." class="btn btn-primary pull-right submit_btn" autocomplete="off"><span class="glyphicon glyphicon-send"></span>发表</button>
                    </div>
                </div>

                <div style="margin-top:15px">
                    <div class="row">
                        <div class="uploadImg-nav">
                            <div class="col-lg-1 col-sm-1"></div>
                            <div class="col-lg-10 col-sm-10" style="padding-left:0;">
                                <ul class="nav nav-pills">
                                    <li ng-click="tellmemore()" class=""><a>选择背景图片</a></li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown">
                                            选取背景颜色<span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class="active"><a>纯黑</a></li>
                                            <li><a>深灰</a></li>
                                            <li><a>浅灰</a></li>
                                            <li><a>主题蓝</a></li>
                                            <li class="divider"></li>
                                            <li><a ng-click="pickColor()">自定义颜色</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-1 col-sm-1"></div>
                        </div>
                    </div>

                    <div class="uploadImg_part1">
                        <div class="row">
                            <div class="col-lg-1 col-sm-1"></div>
                            <div class="col-lg-10 col-sm-10" style="border:dashed #777 1px;height:300px;background-color:#fafafa;margin-top:15px"></div>
                            <div class="col-lg-1 col-sm-1"></div>
                        </div>
                    </div>

                    <div class="uploadImg_part2">
                        <div class="col-lg-1 col-sm-1"></div>
                        <div class="col-lg-10 col-sm-10">

                        </div>
                        <div class="col-lg-1 col-sm-1"></div>
                    </div>
                    <div class="uploadImg_part3">
                        <div class="col-lg-1 col-sm-1"></div>
                        <div class="col-lg-10 col-sm-10"></div>
                        <div class="col-lg-1 col-sm-1"></div>
                    </div>


                </div>

                <div class="row text-center" style="margin-top:35px">
                    <button ng-click="showTab3()" class="btn btn-lg btn-primary" style="padding-left:45px;padding-right:45px">下一步</button>
                </div>
            </div>

            <div ng-show="TabShow == '3'" class="blog-writer-part2">
            </div>



        </form>

        <form style="display:none" ng-submit="tellmemore3()">
            <input type="file" id="uploadbtn" name="avatar" accept=".jpg,.jpeg,.png" onchange="javascript:setImagePreview(this,$('.apreview_container'),$('.apreview_img'));"/>
            <input type="submit" id="uploadbtn_submit">
        </form>






    <form ng-submit="articlesubmit()" style="position: relative;z-index:98;margin-top:700px"><!--method="POST" action="library/xwBE-0.0.1/php/ueserver.php"-->
        <div class="input-group writeblog-title">
            <span class="input-group-addon" id="basic-addon1" style="font-weight:500"><g>文章标题</g></span>
            <input ng-model="NeedModifiedTitle" style="font-weight:500" type="text" class="form-control" id="a_title" name="title" placeholder="请输入文章标题" aria-describedby="basic-addon1" maxlength="20" autocomplete="off">
        </div>

    </form>

    <dialog ng-if="ColorPicker.open" fixed modal close="ColorPicker.open=false">
        <div dialog-title>自定义背景颜色</div>
        <div dialog-content>
            <div class="row">
            </div>
        </div>
    </dialog>

    <hr>
    <?php echo $footer;?>


    <!--封面图片真正上传到的地方-->
    <iframe id="uploadCoverImg" name="uploadCoverImg" style="display:none" src="library/xwBE-0.0.1/php/uploadCoverImg_action.php"></iframe>


</div>
