<?php
require("library/xwBE-0.0.1/connectDB.php");
require("library/xwBE-0.0.1/all.php");
include("library/xwFE-0.0.1/FEM.php");
?>
<style>
    body{background-color:#f5f8fa}
</style>

<div class="container" ng-controller="writeblogcontroller" style="margin-top:130px">


    <div class="row boat" style="margin:0">
        <div class="col-lg-2 col-sm-2 control-label text-center">用户id</div>
        <div class="col-lg-2 col-sm-2 control-label text-center">用户id</div>
        <div class="col-lg-2 col-sm-2 control-label text-center">用户id</div>
        <div class="col-lg-2 col-sm-2 control-label text-center">用户id</div>
        <div class="col-lg-2 col-sm-2 control-label text-center">用户id</div>

        <form>

        </form>


        <div class="per_s_content-basicinfo col-lg-12">
            <div class="form-group">
                <label class="col-lg-2 col-sm-2 control-label text-center">用户id</label>
                <div class="col-lg-10 col-sm-10">
                    <input type="text" class="form-control" name="inputname" id="inputname" placeholder="请输入昵称">
                </div>
            </div>
            <div class="form-group">
                <label for="inputNickname" class="col-lg-3 control-label">用户名</label>
                <div class="col-sm-9"></div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">邮箱</label>
                <div class="col-sm-9">
                    <p class="form-control-static dischangable-text"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">性别</label>
                <div class="btn-group col-lg-9 btn-group-sm" role="group" aria-label="...">
                    <button type="button" class="usergender btn btn-default" ng-class="{active:UserInfoData.gender=='0'}" ng-click="UserInfoData.gender='0'" value="男">男</button>
                    <button type="button" class="usergender btn btn-default" ng-class="{active:UserInfoData.gender=='1'}" ng-click="UserInfoData.gender='1'" value="女">女</button>
                </div>
            </div>
            <div id="reminder_div" style="background-color:#f8f8f8;width:500px;"></div>
            <div id="reminder_div2" style="background-color:#999;width:500px;"></div>
        </div><!--End of basicinfo-->

        <div class="per_s_content-avatar col-lg-6">
            <img title="点击修改头像" ng-src="{{UserInfoData.avatar}}" class="img-circle center-block" width="198" height="198" style="border:dashed #999 1px;cursor: pointer;" ng-click="uploadAvatarDialog={open: true}"/>
        </div><!--End of avatar-->
    </div><!--End of a boat-->







    <form ng-submit="articlesubmit()" style="position: relative;z-index:98;margin-top:700px"><!--method="POST" action="library/xwBE-0.0.1/php/ueserver.php"-->
        <div class="input-group writeblog-title">
            <span class="input-group-addon" id="basic-addon1" style="font-weight:500"><g>文章标题</g></span>
            <input ng-model="NeedModifiedTitle" style="font-weight:500" type="text" class="form-control" id="a_title" name="title" placeholder="请输入文章标题" aria-describedby="basic-addon1" maxlength="20" autocomplete="off">
        </div>

        <script id="ueditor-main" class="ueditor-main"  style="margin-top:150px;height:450px;" ></script>
        <!--ng-bind-html="NeedModifiedContent|to_trusted"-->

        <div class="alert alert-info clearfix" style="margin-top:-2px;">
            <small>如果文本编辑器显示异常，请刷新页面。</small>
            <button type="submit" id="submit_btn" data-loading-text="提交中..." class="btn btn-primary pull-right submit_btn" autocomplete="off"><span class="glyphicon glyphicon-send"></span>发表</button>
        </div>
    </form>


    <hr>
    <?php echo $footer;?>

</div>
