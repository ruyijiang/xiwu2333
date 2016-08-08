/**
 * Created by mazih on 2016/5/10.
 */
app.controller('xiwucontroller',function ($scope,$rootScope, $http, $location, $timeout, liveness, search, $q){
    $scope.PageTitle = null;
    $scope.PageTitle = $location.path();
    $scope.PageTitle = $scope.PageTitle.substr(1);
    $scope.iccode = "";

    $scope.gosearch = function (val,ext){
        search.skipToSearch(val,ext);
    };
    $rootScope.NowPageTitle = "喜屋";

    /**
     * 初始化
     */
    $scope.SetTimeOut = null;
    var timing = Math.round(new Date().getTime()/1000);
    $("[data-toggle='tooltip']").tooltip();
    alterOnlineStatus(1);
    liveness.countLivenessInTimer();

    window.addEventListener("beforeunload",function (){
        liveness.sendLivenessOnUnload();
        if(localStorage.OnlineStatus == '1'){
            alterOnlineStatus(0);
        }
    });

    /**
     * 监听storage数据更改
     */
    if(window.addEventListener){
        window.addEventListener("storage",handle_storage);
        console.log("123");
    }else if(window.attachEvent){
        window.attachEvent("onstorage",handle_storage);
        console.log("234");
    }else{
        console.log("在线状态即时处理程序不被支持");
    }

    var LimitationToIE = 0;//这里需要特别说明一下：
    //在IE浏览器中，会无数次执行handle_storage()，导致浏览器消耗大量内存，从而引发系统崩溃。具体原因目前尚未
    //清楚，估计是storage检测时出的问题，所以这里我加入了一个限制量，强制不允许多次执行。
    //milobluebell - 2016/8/8
    function handle_storage(e){
        if(LimitationToIE < 1){
            if(!e){e=window.event;}
            if(e.key == 'OnlineStatus'){
                alterOnlineStatus(1);
            }
        }
        LimitationToIE++;
    }

    /**
     * 退出登录
     */
    $scope.logout = function (){
        $.ajax({
            url:'../../library/xwBE-0.0.1/php/logout_action.php',
            success: function (data){
                welcomejsonstring(data);//在utills/welcomejsonstring.js中定义
                window.location.reload();
            },
            error: function (){
                alert ("注销失败，请联系管理员");
            }
        });
    };//End of logout()

    /**
     * 开放组队的更新数据和视觉效果
     */
    $scope.openteamornot = function (){
        $.ajax({
            url:'../../library/xwBE-0.0.1/php/queue_action.php',
            type:'POST',
            data: {"timing":timing},
            success: function (data){
                data = welcomejsonstring(data,"message");//在utills/welcomejsonstring.js中定义
                if(data == "开始开放组队"){
                    var dom = '<div class="alert alert-success col-xs-12 col-sm-12 text-center navbar-fixed-top  queue-alert-bar" style="margin:00px 0 25px 0;z-index:1;border:none;"><img src="img/fragments/loading/5375751.gif" height="19" style="vertical-align:middle;margin-right:5px;margin-top:-4px"/>您当前正在开放组队</div>';
                    $(".xw-topbar").after(dom);
                    $(".queue-alert-bar").animate({"margin-top":"50px"});
                    $(".queue-list").addClass("active");
                }else if(data == "停止开放组队"){
                    $(".queue-alert-bar").animate({"margin-top":"0px"});
                    var promise = $timeout(function (){
                        $(".queue-alert-bar").remove();
                    },50);
                    $timeout.cancel(promise);
                    $(".queue-list").removeClass("active");
                }else{
                    alert ("开放组队设置失败，请联系管理员");
                    return false;
                }
            },
            error: function (){
                alert ("没有链接到取消开放组队功能的接口，请联系管理员");
            }
        });
    };

    /**
     * 动态控制头部nav导航的样式效果
     * @param str
     */
    $rootScope.navactivitify = function (str){
        $rootScope.MainPageActivity = $rootScope.RoomListActivity = $rootScope.UserListActivity = $rootScope.MyHomeActivity = $rootScope.MyRoomActivity = $rootScope.BlogActivity = $rootScope.SettingActivity = $rootScope.SignupActivity = $rootScope.LoginActivity = 0;

        switch (str){
            case 0:
                $rootScope.MainPageActivity = 1;
                break;
            case 1:
                $rootScope.MyHomeActivity = 1;
                break;
            case 2:
                $rootScope.MyRoomActivity = 1;
                break;
            case 3:
                $rootScope.BlogActivity = 1;
                break;
            case 4:
                $rootScope.SettingActivity = 1;
                break;
            case 5:
                $rootScope.UserListActivity = 1;
                break;
            case 6:
                $rootScope.SignupActivity = 1;
                break;
            case 7:
                $rootScope.LoginActivity = 1;
                break;
        }
    };

    /**
     * 获取热门搜索
     */
    function gotHotSearching(){
        var deferred = $q.defer();

        $http({
            method: 'GET',
            url: 'library/xwBE-0.0.1/php/HotSearching_Export.php',
            params:{'timing':timing}
        }).success(function (data){
            deferred.resolve(data);
        }).error(function (reason){
            deferred.reject(reason);
        }).then(function (httpCont){
            $scope.HotSearchingContent = httpCont.data.content
        });
    }
    gotHotSearching();

});