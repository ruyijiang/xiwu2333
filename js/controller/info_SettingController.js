/**
 * Created by 马子航 on 2016/5/16.
 */
app.controller('info_SettingController',function ($scope,$rootScope,$http,$window,$timeout,$q,$interval){

    $rootScope.navactivitify(22);
    $rootScope.NowPageTitle = "资料设置 - 喜屋";

    $scope.CityNameShowStatus = null;
    $scope.ProvinceName = $scope.CityName = null;
    $scope.CityListArr = [];
    var timing = Math.round(new Date().getTime()/1000);
    $scope.RecordProcession = 0.25;


    $scope.ServerArr = [];
    $scope.UserInfoData = {
        //uid:'',
        name:'',
        //email:'',
        gender:'',
        server:'',
        country:'中国',//6
        province:'',
        city:'',
        tel:'',
        qq:'',
        weixin:'',
        weibo:'',
        liveplain:'',
        avatar:''//14个
    };
    $scope.ServerList = {
        UserServer_sh:0,
        UserServer_zj:0,
        UserServer_gd:0,
        UserServer_hz:0,
        UserServer_lt:0
    };
    $scope.uploadAvatarStatusDialog = {
        open:false
    };
    $scope.tooltips = {
        open:false
    };
    $scope.dialog={
        open: false,
        content : ""
    };
    $scope.uploadAvatarDialog={
        open: false,
        content : ""
    };

    /**
     * tooltips插件弹出和隐藏
     */
    $scope.showTooltips = function (){
        $timeout.cancel($scope.tooltip_timer);
        if($scope.tooltips.open){//打开状态，则点击就关闭
            $scope.tooltips.open = false;
        }else{//关闭状态，则点击就打开，且定时进行关闭
            $scope.tooltips.open = true;
            $scope.tooltip_timer = $timeout(function (){
                $scope.tooltips.open = false;
            },3500);
        }
    };

    /**
     * 获取用户信息
     */
    $.ajax({
        url:'../../library/xwBE-0.0.1/php/personalinfo_export.php',
        type:'POST',
        async: false,
        data:{"timing":timing},
        success: function (data){
            data = eval( "(" + data + ")");
            $scope.UserInfoData = data;
        },
        error: function (data){
            alert ("获取个人信息异常，请联系管理员");
        }
    });


    /**
     * 根据内容判断常驻服务器选项
     * 给server的选项们赋初始值的时候调用
     */
    function checkInStr_Server(string){
        //"电信（上海）,电信（浙江）,电信（广东）,"
        if(string.indexOf("电信（上海）") >= 0){
            $scope.ServerList.UserServer_sh = 1;
        }
        if(string.indexOf("电信（浙江）") >= 0){
            $scope.ServerList.UserServer_zj = 1;
        }
        if(string.indexOf("电信（广东）") >= 0){
            $scope.ServerList.UserServer_gd = 1;
        }
        if(string.indexOf("电信（华中）") >= 0){
            $scope.ServerList.UserServer_hz = 1;
        }
        if(string.indexOf("联通") >= 0){
            $scope.ServerList.UserServer_lt = 1;
        }
    }
    checkInStr_Server($scope.UserInfoData.server);


    /**
     * 选择常驻服务器后，这里加载选择数据。
     * @param val
     */
    $scope.changeServer = function (val){
        var sh = $scope.ServerList.UserServer_sh;
        var zj = $scope.ServerList.UserServer_zj;
        var gd = $scope.ServerList.UserServer_gd;
        var hz = $scope.ServerList.UserServer_hz;
        var lt = $scope.ServerList.UserServer_lt;
        switch (val){
            case "sh":
                if(sh==0) $scope.ServerList.UserServer_sh = 1;else $scope.ServerList.UserServer_sh=0;break;

            case "zj":
                if(zj==0) $scope.ServerList.UserServer_zj = 1;else $scope.ServerList.UserServer_zj=0;break;

            case "gd":
                if(gd==0) $scope.ServerList.UserServer_gd = 1;else $scope.ServerList.UserServer_gd=0;break;

            case "hz":
                if(hz==0) $scope.ServerList.UserServer_hz = 1;else $scope.ServerList.UserServer_hz=0;break;

            case "lt":
                if(lt==0) $scope.ServerList.UserServer_lt = 1;else $scope.ServerList.UserServer_lt=0;break;
        }
    };



    /**
     * 判断填写的直播平台是哪个品牌，并输出提示
     */
    $("#liveplain").blur(function (){
        checkLivePlain()
    });
    checkLivePlain();//视图加载时就要执行一遍
    function checkLivePlain(){
        var num = $scope.UserInfoData.liveplain.indexOf("www.") + 4;
        var TargetString = $scope.UserInfoData.liveplain.substr(num);
        num = TargetString.indexOf(".");
        var TargetString = TargetString.substring(0,num);
        if(TargetString == 'douyu'||TargetString == 'huya'||TargetString == 'panda'||TargetString == 'zhanqi'){
            //如果是4大平台的直播间，则输出对应的icon
            $("#liveplain").parent().find(".spanicon").removeClass().addClass(TargetString+"-span spanicon");
        }else{
            //如果不是4大平台的直播间，则输出电视icon
            $("#liveplain").parent().find(".spanicon").removeClass().addClass("icon-live iconfont");
        }
    }



    /**
     * 当选择完省份之后进行的方法
     * 用处：调取省份内城市或者直辖市内区县信息
     * @params:ProvinceName = 省份名称
     */
    $scope.onRegionSelected = function (CountryName,ProvinceName){
        region_export(CountryName,ProvinceName);
    };
    region_export($scope.UserInfoData.country,$scope.UserInfoData.province);

    function region_export(CountryName,ProvinceName){
        $.ajax({
            url:'../../library/xwBE-0.0.1/php/region_export.php',
            type:'GET',
            async: false,
            data:{"country":CountryName,"province":ProvinceName},
            success: function (data){//# ["1","2","3","4",...]
                $scope.CityListArr = data.split(",");
            }
        });

    }


    $scope.form = {
        submit: function () {
            $scope.submitData();
        }
    };

    /**
     * 监控dota2uid是否发生了改变
     * 如果发生了改变，则在提交的时候对用户的记录进行记录
     */
    var OldDota2_uid = $scope.UserInfoData.dota2_uid;
    $scope.$watch('UserInfoData.dota2_uid',function (newVal,oldVal){
        if(newVal !== oldVal && newVal !== OldDota2_uid && newVal!==""){
            $scope.isDota2_uidChanged = true;
        }else{
            $scope.isDota2_uidChanged = false;
        }
    });

    /**
     * 提交表单信息
     */
    $scope.submitData = function (){

        //把所有UserServer域下的等于1的值加进数组

        for (xAttr in $scope.ServerList){
            if($scope.ServerList[xAttr] == 1){
                if(xAttr == "UserServer_sh"){
                    $scope.ServerArr.push("电信（上海）");
                }else if(xAttr == "UserServer_zj"){
                    $scope.ServerArr.push("电信（浙江）");
                }else if(xAttr == "UserServer_gd"){
                    $scope.ServerArr.push("电信（广东）");
                }else if(xAttr == "UserServer_hz"){
                    $scope.ServerArr.push("电信（华中）");
                }else if(xAttr == "UserServer_lt"){
                    $scope.ServerArr.push("联通");
                }
            }

        }
        //$scope.ServerArr : [1,2,3,4]
        $scope.UserInfoData.server = unique($scope.ServerArr);
        //遍历$scope.ServerArr，并且将值写成一个string传递给$scope.UserInfoData.server
        var ServerStr = "";
        for (xs in $scope.UserInfoData.server){
            ServerStr += $scope.UserInfoData.server[xs]+",";
        }
        $scope.UserInfoData.server = ServerStr;
        $scope.ServerArr = [];

        $.ajax({
            url:'../../library/xwBE-0.0.1/php/infosetting_action.php',
            type:'POST',
            async:false,
            data: $scope.UserInfoData,
            success: function (data){
                data = welcomejsonstring(data);


                if(data == 1 && $scope.isDota2_uidChanged !== true){
                    //没有修改dota2数字id
                    $scope.dialog={
                        open: true,
                        content : "保存成功"
                    };

                    $timeout(function (){
                        window.location.reload();
                    },700);

                    $scope.ServerStr = [];

                }else if(data == 1 && $scope.isDota2_uidChanged == true){
                    //修改了dota2数字id
                    $scope.closeThisDialog = function (){
                        $scope.recordPlayerInfo.open = false;
                        if($scope.recordPlayerInfoComplete){
                            window.location.reload();
                        }
                    };

                    $scope.recordPlayerInfoComplete = false;
                    $scope.recordPlayerInfoError = false;

                    //弹出进度条
                    $scope.recordPlayerInfo = {
                        open: true,
                        title: "正在收录游戏数据，请勿关闭或刷新页面"
                    };

                    //开始进度条的动画效果
                    $scope.RecordProcession = 0;
                    var intervalTimer = $interval(function (){
                        if($scope.RecordProcession >= 100){
                            //请求失败了
                            $interval.cancel(intervalTimer);
                            $scope.recordPlayerInfoError = true;
                            $scope.recordPlayerInfo.title = "连接超时";
                        }else{
                            $scope.RecordProcession += 0.0825;
                        }
                    },75);

                    //收录用户Dota2信息
                    var deferred = $q.defer();
                    $http({
                        url:'../../library/xwBE-0.0.1/Interface/setDota2Info/recordPlayerAnyNumMatchInfo.php',
                        method: 'POST',
                        dataType: 'json',
                        data:20
                    }).success(function (data){
                        deferred.resolve(data);
                    }).error(function (reason){
                        $scope.recordPlayerInfo.title = "不明原因导致的收录失败";
                        $scope.RecordProcession = 100;
                        $scope.recordPlayerInfoError = true;
                        deferred.reject(reason);
                    }).then(function (httpCont){
                        $interval.cancel(intervalTimer);//停止秒表
                        if(httpCont.data.statuscode == 1 && httpCont.data.average_dr !== "0%" && httpCont.data.average_pr !== "0%" && httpCont.data.average_kda !== "0.0"){
                            $timeout(function (){
                                $scope.recordPlayerInfo.title = "收录完成";
                                $scope.RecordProcession = 100;
                                $scope.recordPlayerInfoComplete = true;
                                $scope.recordedPlayerInfo = httpCont.data;
                            },2700);
                        }else{
                            $scope.recordPlayerInfo.title = "收录失败";
                            $scope.RecordProcession = 100;
                            $scope.recordPlayerInfoError = true;
                        }
                    });

                }else if(data !== 1){
                    $scope.dialog={
                        open: true,
                        content : "信息保存失败，请联系管理员"
                    };
                    $timeout(function (){
                        $scope.dialog.open = false;
                    },700);
                }
            },//End of success
            error: function (){
                alert ("不明原因导致的修改失败，请联系管理员");
            }
        });
    };

    $scope.UploadBtnContent = '提交';
    $scope.checkBtnStatus = function (){
        $scope.UploadBtnContent = '修改成功';
        $("#uploadavatarbtn").attr("disabled","disabled");
        alert ("头像修改成功");
        window.location.reload();
    };


});