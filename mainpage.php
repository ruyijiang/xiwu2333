<?php
require("library/xwBE-0.0.1/all.php");
require("library/xwBE-0.0.1/connectDB.php");
include("library/xwFE-0.0.1/FEM.php");
?>
<div class="container" role="main" ng-controller="maincontroller">

      <div class="row row-offcanvas row-offcanvas-right" style="margin-top:130px;">

        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
          </p>
          <?php echo $main_bg;?>
          <div class="row">
            <div class="col-xs-6 col-lg-4">
              <h2>玩家列表<span class="badge">4234</span></h2>
              <p>寻找开黑队友，也可以随便找人聊聊。</p>
              <p><a ui-sref="userlist" class="btn btn-primary" role="button">前往 &raquo;</a></p>
            </div><!--/.col-xs-6.col-lg-4-->
            <div class="col-xs-6 col-lg-4">
              <h2>房间列表<span class="badge">4</span></h2>
              <p>加入或者创建一个房间，那里便是你们的私密世界。</p>
              <p><a ui-sref="roomlist" class="btn btn-primary" role="button">去看看 &raquo;</a></p>
            </div><!--/.col-xs-6.col-lg-4-->
            <div class="col-xs-6 col-lg-4">
              <h2></h2>
              <p></p>
            </div><!--/.col-xs-6.col-lg-4-->
          </div><!--/row-->
        </div><!--/.col-xs-12.col-sm-9-->
        

        <div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar">
            <div class="thumbnail">
              <img src="img/fragments/bgs/5201e19825bf0920045673big.jpg" class="img-responsive center-block"></img>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">随机推荐</div>
              <div class="panel-body">
                <img src="img/main_bg/20130428100656532.jpg" alt="烧花鸭的春夏秋冬" width="100%">
                <div class="caption">
                  <style>
                    .caption span[class]{margin-right:5px;}
                  </style>
                  <h5>烧花鸭的春夏秋冬<strong>(4/6)</strong></h5>
                  <p><span class="label label-default">电信(上海)</span><span class="label label-default">电信(华中)</span><span class="label label-default">电信(广东)</span></p>
                  <p><a href="#" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-refresh"></span>换一个</a> <a href="#" class="btn btn-primary btn-sm" role="button">加入</a></p>
                </div>
              </div>
            </div>
        </div><!--/.sidebar-offcanvas-->
      </div><!--/row-->

      <hr>


<?php echo $footer;?>

</div><!--/.container-->
    