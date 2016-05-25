/**
 * Created by 马子航 on 2016/4/15.
 */
app.controller('homepagecontroller',function ($scope,$rootScope){


    $scope.TabShowPage = 1;//当前TabIndex值
    $scope.DataAreaMask = 0;//数据请求时的遮罩层显示指示
    $scope.UserDataStatus = [];//已请求回来的用户数据下标
    $scope.UserData = {};//请求回来用户数据内容对象


    $scope.Tabshow = function (tabindex){
        switch(tabindex){
            case 1:
                myhomeLoadData(1);
                $scope.TabShowPage = 1;
                break;
            case 2:
                myhomeLoadData(2);
                $scope.TabShowPage = 2;
                break;
            case 3:
                myhomeLoadData(3);
                $scope.TabShowPage = 3;
                break;
            default:
                myhomeLoadData(1);
                $scope.TabShowPage = 1;
        }
    };
    function myhomeLoadData(index){
        /*var sudo = "";
        for (xa in donnotshowArr){
            sudo += xa + ",";//1,2,3,
        }*/
        switch (index){
            case 1://请求的是TabIndex1的数据
                _loadUserData("pulse");
                break;
            case 2://请求的是TabIndex2的数据
                _loadUserData("article");
                break;
            case 3://请求的是TabIndex3的数据
                _loadUserData("comment");
                break;
        }
    }

    /**
     * 从数据库读取数据
     */
    function _loadUserData(requestData,uid){
        //requestData:pulse/article/comment

        /*if(!uid){
            //请求的是自己的数据，也就是myhome
        }else{
            //请求的是别人的数据，也就是别的个人主页
        }*/

        $.ajax({
            url:'library/xwBE-0.0.1/UserAllDetails_Export.php',
            type:'POST',
            async: false,
            data:{"drequest":requestData},
            success: function (data){
                data = eval( "(" + data + ")");
                var SArr = data.server.split(',');//SArr = [1,2,3,];
                SArr.pop();
                data.server = SArr;
                $scope.UserData = data;
            },
            error: function (){
                alert ("myHomePageError：不明原因导致的获取数据失败，请联系管理员");
            },
            beforeSend: function (){
                $scope.DataAreaMask = 1;
            },
            complete: function (){
                $scope.DataAreaMask = 0;
            }
        });
    }



    /**
     * Echarts
     */
    $scope.loadEchart = function (){
        /***配置echart**/
        var myChart = echarts.init(document.getElementById('liveness-chart-body'));
        myChart.setOption({
            tooltip: {
                trigger: "axis",
                triggerOn:"mousemove",
            },
            toolbox:{
                show : false,
            },
            calculable: true,
            xAxis: [
                {
                    type: "category",
                    boundaryGap: false,
                    data: ["2016/03/20", "03/21", "03/22", "03/23", "03/24", "03/25", "03/26", "03/27", "03/28", "03/29"],
                    name: "最近十天",
                    nameLocation: "end",
                    min: 1,
                    max: 10,
                    axisTick: {
                        show: true,
                        interval: 0,
                        inside: false,
                        lineStyle: {
                            width: 1
                        }
                    },
                    splitLine: {
                        show: true
                    }
                }
            ],
            yAxis: [
                {
                    type: "value",
                    name: "活跃度",
                    nameLocation: "end",
                    min: 0,
                    max: 10
                }
            ],
            series: [
                {
                    name: "用户活跃度",
                    type: "line",
                    data: [7.7, 0.7, 0.6, 4.2, 0.3, 0.2, 6.5, 8, 8.2, 8.5],
                    smooth: true,
                    symbolSize: 5
                }
            ]
        })

        // 使用刚指定的配置项和数据显示图表。
    }

    //视图初始化
    $scope.loadEchart();
    $("[data-toggle='tooltip']").tooltip();//开启tooltip
    _loadUserData("pulse");
})