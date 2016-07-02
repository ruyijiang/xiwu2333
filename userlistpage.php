 <?php
require("library/xwBE-0.0.1/all.php");
require("library/xwBE-0.0.1/connectDB.php");
include("library/xwFE-0.0.1/FEM.php");
?>
 <style>
   thead th{
     text-align: center;}
   tbody tr > td:nth-child(1),
   tbody tr > td:nth-child(3),
   tbody tr > td:nth-child(4),
   tbody tr > td:nth-child(5),
   tbody tr > td:nth-child(6),
   tbody tr > td:nth-child(7),
   tbody tr > td:nth-child(8){
     text-align: center;
   }
   tbody td{
     font-size:14px
   }
 </style>
   <div class="container-fluid" ng-controller="userlistController" style="margin-top:100px;">
      <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 sidebar">
          <ul class="nav nav-sidebar">
            <li ng-class="{active:UserListSearchConfig.gender == '' && UserListSearchConfig.server == '' && UserListSearchConfig.skillLevel == '' }"><a ng-click="MiniNav('')">全部<span class="sr-only">(current)</span></a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li class="panel-heading">按性别：</li>
            <div class="btn-group btn-group-sm center-block" style="width:90%">
              <button type="button" ng-class="{active:UserListSearchConfig.gender == '0'}" ng-click="MiniNav('0')" class="btn btn-default">男</button>
              <button type="button" ng-class="{active:UserListSearchConfig.gender == '1'}" ng-click="MiniNav('1')" class="btn btn-default">女</button>
            </div>
          </ul><hr>
          <ul class="nav nav-sidebar">
            <li class="panel-heading">按分区：</li>
            <div class="btn-group btn-group-sm center-block" style="width:90%">
              <button type="button" ng-class="{active:UserListSearchConfig.server == 'dianxin'}" ng-click="MiniNav('dianxin')" class="btn btn-default">电信</button>
              <button type="button" ng-class="{active:UserListSearchConfig.server == 'liantong'}" ng-click="MiniNav('liantong')" class="btn btn-default">联通</button>
            </div>
          </ul><hr>
            <ul class="nav nav-sidebar">
                <li class="panel-heading">按水平等级：</li>
                <div class="btn-group btn-group-sm center-block" style="width:90%">
                  <button type="button" ng-class="{active:UserListSearchConfig.skillLevel == 'Normal'}" ng-click="MiniNav('Normal')" class="btn btn-default">Normal</button>
                  <button type="button" ng-class="{active:UserListSearchConfig.skillLevel == 'High'}" ng-click="MiniNav('High')" class="btn btn-default">High</button>
                  <button type="button" ng-class="{active:UserListSearchConfig.skillLevel == 'Very High'}" ng-click="MiniNav('Very High')" class="btn btn-default">Very High</button>
                </div>
            </ul><hr>
        </div>
        <div>
          <div class="col-lg-7 col-md-7 col-sm-12 col-lg-offset-2 col-sm-offset-2 main">
            <h3 class="page-header">网站统计</h3>

            <div class="row placeholders">
              <div class="col-lg-4 col-sm-6 col-xs-12 placeholder">
                <div class="userlist-chart center-block" id="user-most"></div>
                <h4><strong>玩家最多</strong></h4>
                <span class="text-muted">{{UserDataMostRegion.MostRegion_No1}}</span>
              </div>
              <div class="col-lg-4 col-sm-6 col-xs-12 placeholder">
                <div class="userlist-chart center-block" id="user-ratio"></div>
                <h4><strong>男女比例</strong></h4>
                <span class="text-muted">{{(UserDataSexRate.MaleRate.toFixed(2))*100}}% - {{(UserDataSexRate.FemaleRate.toFixed(2))*100}}%</span>
              </div>
              <div class="col-lg-4 col-sm-6 col-xs-12 placeholder">
                <div class="userlist-chart center-block" id="user-online" style="width:214px"></div>
                <h4><strong>当前在线玩家</strong></h4>
                <span class="text-muted">{{UserDataNowOnline.NowOnlineCount}}人</span>
              </div>
            </div>

            <h3 class="sub-header">
              <img class="img-rounded" width="32" height="32" style="margin-top:-6px;margin-right:-3px" alt="Dota2ImgThumbnail32^2" src="img/fragments/icon/DOTA_32px_558493_easyicon.net.png"/>
              Dota2 - 开放组队的玩家
              <!--<a class="btn btn-primary aaaa" role="button" ng-click="loaduserlist()" style="margin-top:-6px"><span class="glyphicon glyphicon-refresh"></span>刷新列表</a>-->
            </h3>
            <div class="table-responsive" style="position:relative">
                <div ng-if="maskVis == '1'" class="table-responsive-mask" style="width:100%;height:100%;background-color:black;opacity:0.7;border-radius:4px;position:absolute;top:0;left:0;z-index:1000;">
                    <div style="width:32px;top:45%;left:45%;position:absolute">
                        <img src="img/fragments/loading/5-121204193955-50.gif">
                    </div>
                </div>
              <table class="table table-striped">
                <thead>
                <tr class="info">
                  <th width="15%">游戏ID</th>
                  <th width="15%">用户名</th>
                  <th width="10%">性别</th>
                  <!--<th>组队次数</th>-->
                  <th width="10%">最擅长位置</th>
                  <th width="15%">最擅长英雄</th>
                  <th>场均伤害</th>
                  <th>场均KDA</th>
                  <th>评分</th>
                </tr>
                </thead>
                <tbody><!--一页15个-->
                <tr ng-repeat="ud in userListDataArr">
                  <td>{{ud.dota2_uid}}</td>
                  <td><a href="/#/person?uid={{ud.uid}}">{{ud.name}}</a></td>
                  <td>
                    <span ng-if="ud.gender == '0'">男</span>
                    <span ng-if="ud.gender == '1'">女</span>
                  </td>
                  <td>
                    <span ng-if="ud.skilledposition == '1'">1号位</span>
                    <span ng-if="ud.skilledposition == '2'">2号位</span>
                    <span ng-if="ud.skilledposition == '3'">3号位</span>
                    <span ng-if="ud.skilledposition == '4'">4号位</span>
                    <span ng-if="ud.skilledposition == '5'">5号位</span>
                  </td>
                  <td>影魔、剑圣、蓝猫</td>
                  <td>{{ud.damage}}</td>
                  <td>{{ud.kda}}</td>
                  <td>
                    <span ng-if="!ud.skilledposition">暂无</span>
                    <span ng-if="ud.skilledposition">{{ud.score}}</span>
                  </td>
                </tr>
                <!--<tr><td>252556081</td><td><a href="">攻略写手-总导演</a></td><td>男</td><td>1号位</td><td>32.3%</td><td>4.2</td><td>96</td></tr>-->
                </tbody>
              </table>
              <hr/>
              <div class="col-lg-12 text-center" style="margin-top:-10px">
                <ul class="pagination pagination-md">
                  <?php
                    $sql = "SELECT uid FROM users WHERE openstatus = '1' AND onlinestatus = '1' ";
                    $qry = $db->query($sql);
                    $row_all = mysqli_num_rows($qry);//总条数
                    $page_all = $row_all/15;//总页数
                    $page_all = ceil($page_all);
                    $page_limit = 6;//允许选择的页数限制
                    $i = 0;

                    $dom = '<li ng-if="ListActive !== 1"><a ng-click="changeShowPage(1)">&laquo;头页</a></li>';
                    for ($i=1;$i<=$page_all+7;$i++){
                          $dom .= '<li id="page'.$i.'" ng-if="'.$i.'  >= ListSelectedNum - '.($page_limit/2).' && '.$i.' <= ListSelectedNum + '.($page_limit/2).' && '.$i.' <= '.$page_all.'" ng-class="{active:ListActive == '.$i.'}"><a ng-disabled="'.$i.' == ListSelectedNum" ng-click="changeShowPage('.$i.')">'.$i.'</a></li>';

                    }
                    $dom .= '<li ng-if="ListActive !== '.$page_all.'"><a ng-click="changeShowPage('.$page_all.')">尾页&raquo;</a></li>';
                    echo $dom;
                  ?>
                </ul>
                <?php
                  echo '<input id="nowselected" type="hidden" ng-model="ListSelectedNum">';
                ?>
              </div>
            </div><!--table-striped-->
            <hr>
            <?php echo $footer;?>

          </div><!--main-->
          <div class="col-lg-3 col-md-3 col-sm-12 gallery" style="margin-top:10px;padding-top:15px;">
            <!--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#gallery" aria-expanded="true" aria-controls="navbar">-->
            <a href="http://player.youku.com/player.php/sid/XMzAyMDc3OTQw/v.swf" target="_blank" class="sider-right-btn_1"></a>
            <a href="http://player.youku.com/player.php/sid/XNjg3OTcyNjMy/v.swf" target="_blank" class="sider-right-btn_2"></a>
            <a href="http://www.dota2.com/comics/are_we_heroes_yet/" target="_blank" class="sider-right-btn_3"></a>
          </div>
        </div>
      </div>
    </div>
