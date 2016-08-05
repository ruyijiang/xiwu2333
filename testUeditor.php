<?php
require("library/xwBE-0.0.1/connectDB.php");
require("library/xwBE-0.0.1/all.php");
include("library/xwFE-0.0.1/FEM.php");
?>
<div class="container" ng-controller="testC" style="margin-top:130px">


    <form ng-submit="articlesubmit()" style="position: relative;z-index:98">
        <div class="input-group writeblog-title">
            <span class="input-group-addon" id="basic-addon1" style="font-weight:500"><g>文章标题</g></span>
            <input ng-model="NeedModifiedTitle" style="font-weight:500" type="text" class="form-control" id="a_title" name="title" placeholder="请输入文章标题" aria-describedby="basic-addon1" maxlength="20" autocomplete="off">
        </div>

        <script id="ueditor-main" style="margin-top:150px;height:450px;" ng-bind-html="NeedModifiedContent|to_trusted"></script>
        <!--<div id="ueditor-main" style="margin-top:150px;height:350px;"></div>-->

        <div class="alert alert-info clearfix" style="margin-top:-2px;">
            <small>如果文本编辑器显示异常，请刷新页面。</small>
            <button type="submit" id="submit_btn" data-loading-text="提交中..." class="btn btn-primary pull-right submit_btn" autocomplete="off"><span class="glyphicon glyphicon-send"></span>发表</button>
        </div>
    </form>



    <hr>
    <?php echo $footer;?>

</div>
