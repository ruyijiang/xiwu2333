app.controller('userlistController',function ($scope,$rootScope){

    /*****初始化******/
    $scope.userListDataArr = [];
    $scope.userDataArr = [];
    $scope.UserDataMostRegion = {};
    $scope.UserDataNowOnline = {};
    $scope.UserDataSexRate = {};

    var timing = Math.round(new Date().getTime()/1000);
    alterOnlineStatus(1);
    /******************/


    /**
     * 点击分页按钮时执行
     * @param num
     */
    /********分页组件初始化******/
    var num_onepage = 15;//每页显示条数
    $scope.ListActive = 1;//class为active的分页按钮位置代码
    $scope.ListSelectedNum = null;//class为active的分页按钮位置代码
    /*******初始化完成***********/
    $scope.changeShowPage = function (num){
        $.ajax({
            url:'../../library/xwBE-0.0.1/php/userlist_export.php',
            type:'GET',
            async: false,
            data:{"responsecontent":"userlist","num_onepage":num_onepage,"now_page":num},
            success: function (data){
                $scope.userListDataArr = welcomejsonarrstring(data);
                $scope.ListActive = num;
                $scope.ListSelectedNum = num;
            },
            error: function (data){
                alert ("获取[Dota2-开放组队玩家]数据异常，请联系管理员");
            },
            complete: function (){

            }
        });
    };




    /**
     * 视图初始化时加载userlist信息
     * 实际上就是loaduserlist和loaduserdata各执行了一遍
     */
     $.ajax({
        url:'../../library/xwBE-0.0.1/php/userlist_export.php',
        type:'GET',
         async: false,
        data:{"responsecontent":"userlist","num_onepage":num_onepage,"now_page":1},
        success: function (data){
            $scope.userListDataArr = welcomejsonarrstring(data);
        },
        error: function (data){
            alert ("获取[Dota2-开放组队玩家]数据异常，请联系管理员");
        },
        complete: function (){

        }
    });
    $.ajax({
        url:'../../library/xwBE-0.0.1/php/EchartData_Export.php',
        type:'POST',
        async: false,
        data:{"timing":timing,"mod":"getHighestLocation"},
        success: function (data){
            $scope.userDataArr = welcomejsonarrstring(data);
            $scope.UserDataMostRegion = {
                MostRegion_No1:$scope.userDataArr[0].tagtitle,
                MostRegion_No1Count:$scope.userDataArr[0].tagcontent,
                MostRegion_No2:$scope.userDataArr[1].tagtitle,
                MostRegion_No2Count:$scope.userDataArr[1].tagcontent,
                MostRegion_No3:$scope.userDataArr[2].tagtitle,
                MostRegion_No3Count:$scope.userDataArr[2].tagcontent
            };
        },
        error: function (data){
            alert ("获取[Dota2-开放组队玩家]数据异常，请联系管理员");
        }
    });
    $.ajax({
        url:'../../library/xwBE-0.0.1/php/EchartData_Export.php',
        type:'POST',
        async: false,
        data:{"timing":timing,"mod":"getOnlineUsersAmount"},
        success: function (data){
            data = parseInt(data);
            $scope.UserDataNowOnline = {
                NowOnlineCount:data
            };
        },
        error: function (data){
            alert ("获取[Dota2-开放组队玩家]数据异常，请联系管理员");
        }
    });
    $.ajax({
        url:'../../library/xwBE-0.0.1/php/EchartData_Export.php',
        type:'POST',
        async: false,
        data:{"timing":timing,"mod":"getSexualRates"},
        success: function (data){
            $scope.userDataArr = welcomejsonarrstring(data);
            $scope.UserDataSexRate = {
                MaleRate:$scope.userDataArr[0].rate_male,
                FemaleRate:$scope.userDataArr[0].rate_female,
            };
        },
        error: function (data){
            alert ("获取[Dota2-开放组队玩家]数据异常，请联系管理员");
        }
    });





    

    /**
     * 点击"刷新列表"后重新获取userlist用户列表
     */
    $scope.loaduserlist = function (){
        var dataArr = [];
        $.ajax({
            url:'../../library/xwBE-0.0.1/php/userlist_export.php',
            type:'POST',
            data:{"timing":timing},
            success: function (data){
                $scope.userListDataArr = welcomejsonarrstring(data);//data即是对象数组
            },
            error: function (data){
                alert ("获取[Dota2-开放组队玩家]数据异常，请联系管理员");
            },
            beforeSend: function (){
                $(".table-responsive-mask").show();
            },
            complete: function (){
                $(".table-responsive-mask").hide();
            }

        })
    };



    /**
     * 加载userlist视图的Echarts
     */

    $scope.loadEchart = function (){
        var myChart_most = echarts.init(document.getElementById('user-most'));
        option1 = {
            tooltip : {
                trigger: 'axis',
                axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                    type : 'line'        // 默认为直线，可选为：'line' | 'shadow'
                }
            },
            grid: {
                left: '0%',
                right: '0%',
                bottom: '5%',
                top:"15%",
                containLabel: true
            },
            xAxis : [
                {
                    type : 'category',
                    data : [$scope.UserDataMostRegion.MostRegion_No1,$scope.UserDataMostRegion.MostRegion_No2,$scope.UserDataMostRegion.MostRegion_No3]
                }
            ],
            yAxis : [
                {
                    type : 'value'
                }
            ],
            series : [
                {
                    type:'bar',
                    data:[$scope.UserDataMostRegion.MostRegion_No1Count*10, $scope.UserDataMostRegion.MostRegion_No2Count*10, $scope.UserDataMostRegion.MostRegion_No3Count*10]
                },
            ]
        };
        
        var myChart_ratio = echarts.init(document.getElementById('user-ratio'));
        option2 = {
            series : [
                {
                    type: 'pie',
                    radius : '55%',
                    data:[
                        {value:$scope.UserDataSexRate.FemaleRate, name:'女'},
                        {value:$scope.UserDataSexRate.MaleRate, name:'男'}
                    ],
                }
            ],
        };
        
        var myChart_online = echarts.init(document.getElementById('user-online'));
        option3 = {
            tooltip: {
                trigger: 'axis'
            },
            grid: {
                left: '1%',
                right: '10%',
                bottom: '5%',
                top: '15%',
                containLabel: true
            },
            toolbox: {
                feature: {
                    saveAsImage: {}
                }
            },
            xAxis: {
                type: 'category',
                boundaryGap: false,
                data: ['14:00','15:00','16:00','17:00','17:51']
            },
            yAxis: {
                type: 'value'
            },
            series: [
                {
                    name:'今天',
                    type:'line',
                    stack: '总量',
                    data:[75,120, 132, 101, $scope.UserDataNowOnline.NowOnlineCount]
                }
            ]
        };
        //实例echart
        myChart_most.setOption(option1);
        myChart_ratio.setOption(option2);
        myChart_online.setOption(option3);
    }


    $scope.loadEchart();
    $("[data-toggle='tooltip']").tooltip();//开启tooltip
    $rootScope.navactivitify(5);
});