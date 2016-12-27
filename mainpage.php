<?php
require("library/xwBE/all.php");
require("library/xwBE/connectDB.php");
include("library/xwFE/FEM.php");
?>
<style>
    .caption span[class]{margin-right:5px;}
</style>
<div class="container" role="main" ng-controller="maincontroller">

    <div class="row row-offcanvas row-offcanvas-right" style="margin-top:120px;">

        <div class="col-xs-12 col-sm-9">
            <p class="pull-right visible-xs">
            </p>
            <?php echo $main_bg;?>
            <div class="row">
                <div class="col-xs-6 col-lg-4">
                    <h2>玩家列表<span class="badge">{{onLineUserAccount}}</span></h2>
                    <p>寻找开黑队友，也可以随便找人聊聊。</p>
                    <p><a ui-sref="userlist" class="btn btn-primary" role="button">前往 &raquo;</a></p>
                </div><!--/.col-xs-6.col-lg-4-->
                <div class="col-xs-6 col-lg-4">
                    <h2>社区广场<span class="badge"></span></h2>
                    <p>这里展示了所有与电子竞技相关的资讯与数据。</p>
                    <p><a ui-sref="square" class="btn btn-primary" role="button">去看看 &raquo;</a></p>
                </div><!--/.col-xs-6.col-lg-4-->
                <div class="col-xs-6 col-lg-4">
                    <h2></h2>
                    <p></p>
                </div><!--/.col-xs-6.col-lg-4-->
            </div><!--/row-->
        </div><!--/.col-xs-12.col-sm-9-->


        <div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar">
            <div class="thumbnail">
                <img src="img/fragments/bgs/5201e19825bf0920045673big.jpg" class="img-responsive center-block"/>
            </div>
            <div class="panel panel-default" style="box-shadow:1px 1px 2px #e3e3e3">
                <div class="panel-heading">推荐</div>
                <div class="panel-body" style="padding:0">
                    <div style="position: relative;">
                        <img src="img/main_bg/20130428100656532.jpg" alt="dota2" width="100%"/>
                        <a ng-href="/#/person?uid={{RecoUser.uid}}">
                            <img ng-src="{{RecoUser.avatar}}" style="position:absolute;top:60%;left:35%;cursor:pointer" class="img-circle center-block" alt="{{RecoUser.name}}" title="{{RecoUser.name}}" width="80" height="80"/>
                        </a>
                    </div>

                    <div class="caption" style="margin-top:50px">
                        <div style="margin:10px">
                            <a style="font-size:15px;" ng-href="/#/person?uid={{RecoUser.uid}}">{{RecoUser.name}}</a>
                            <i class="iconfont icon-nan" style="color:hotpink;margin-left:5px" ng-if="RecoUser.gender == 0"></i>
                            <i class="iconfont icon-nvhai" style="color:hotpink;margin-left:5px" ng-if="RecoUser.gender == 1"></i>

                            <div style="display: block;margin-bottom:5px">
                                <span style="font-size:15px;margin-right:5px">
                                    <small style="font-weight:bold">技术级</small>
                                    <span class="label ng-scope label-success" style="font-weight:bold;font-style:italic;font-size:12px">{{RecoUser.skilllevel}}</span>
                                </span>
                                <span style="font-size:15px;">
                                    <small style="font-weight:bold">评分</small>
                                    <span class="label ng-scope label-success" style="font-weight:bold;font-style:italic;font-size:12px">{{RecoUser.score}}</span>
                                </span>
                            </div>
                            <p>
                                <span class="label label-default" ng-if="RecoUserServerArr.length - 1 > 2">{{RecoUser.server_bigarea}}</span>
                                <span class="label label-default" ng-repeat="xSer in RecoUserServerArr" ng-if="RecoUserServerArr.length - 1 <= 2">{{xSer}}</span>
                            </p>
                            <div style="border-top:1px dotted #e5e5e5;padding-top:5px">
                                <a class="btn btn-default btn-sm center-block" role="button" ng-click="getRecUserData()">
                                    <span class="glyphicon glyphicon-refresh"></span>换一个
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.sidebar-offcanvas-->
    </div><!--/row-->

    <hr>
    <dialog ng-if="dialog.open" duration="1800" modal fixed close="dialog.open=false">
        <div dialog-content>{{dialog.content}}</div>
    </dialog>


    <?php echo $footer;?>

</div><!--/.container-->