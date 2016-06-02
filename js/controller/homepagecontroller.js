/**
 * Created by 马子航 on 2016/4/15.
 */
app.controller('homepagecontroller',function ($scope,$rootScope,$location){


    $scope.TabShowPage = 1;//当前TabIndex值
    $scope.DataAreaMask = 0;//数据请求时的遮罩层显示指示
    $scope.UserDataStatus = [];//已请求回来的用户数据下标
    $scope.UserData = {};//请求回来用户数据内容对象
    $scope.LivenessDataArr = [];//请求回来的对应用户的活跃度
    $scope.TabShowPage = 1;//Tab标签当前显示位置
    $scope.TabPulseStatus = 0;
    $scope.TabArticleStatus = 0;
    $scope.TabCommentStatus = 0;
    $scope.TabHttpRequestTimes = 0;//Tab一共发送的请求数量

    $scope.tellmemore = function (){
        $.ajax({
            url:'library/xwBE-0.0.1/php/setScore_action.php',
            type:'POST',
            data:{"commitname":"inviteNew"},
            success: function (data){
            }
        })
    };


    $scope.Tabshow = function (tabindex){
        switch(tabindex){
            case 1:
                myhomeLoadData(1);
                break;
            case 2:
                myhomeLoadData(2);
                break;
            case 3:
                myhomeLoadData(3);
                break;
            default:
                myhomeLoadData(1);
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
                $scope.TabShowPage = 1;
                break;
            case 2://请求的是TabIndex2的数据
                _loadUserData("article");
                $scope.TabShowPage = 2;
                break;
            case 3://请求的是TabIndex3的数据
                _loadUserData("comment");
                $scope.TabShowPage = 3;
                break;
        }
    }

    /**
     * 从数据库读取数据
     * 备注：此函数所有参数均为可选
     * @param requestData ： 请求内容的类别，选项是：pulse/article/comment，如果为空，则默认是pulse
     * @param uid ： 请求的用户的uid，如果为空，则会传递空值给ajax，而在对应的程序里会默认显示登陆的用户自己的
     */
    function _loadUserData(requestData,uid){
        //判断url里是否有tab。如果有，则请求对应tab的请求；如果没有，则请求默认的pulse数据
        var tab = $location.search()["tab"];
        if(tab == "pulse"){
            $scope.TabShowPage = 1;
        }else if(tab == "article"){
            $scope.TabShowPage = 2;
        }else if(tab == "comment"){
            $scope.TabShowPage = 3;
        }else{
            tab = "pulse";
            $scope.TabShowPage = 1;
        }

        if(!uid) uid = "";
        if(!requestData) requestData = tab;

        if($scope.TabHttpRequestTimes<=3){
            $.ajax({
                url:'library/xwBE-0.0.1/UserAllDetails_Export.php',
                type:'POST',
                async: false,
                data:{"drequest":requestData,"uid":uid},
                success: function (data){
                    data = eval( "(" + data + ")");
                    var SArr = data.server.split(',');//SArr = [1,2,3,];
                    SArr.pop();
                    data.server = SArr;
                    $scope.UserData = data;
                    switch (requestData){
                        case "pulse":
                            if($scope.TabPulseStatus==0){
                                $scope.TabPulseStatus++
                            }
                            $scope.TabHttpRequestTimes = $scope.TabPulseStatus + $scope.TabArticleStatus +  + $scope.TabCommentStatus;
                            break;
                        case "article":
                            if($scope.TabArticleStatus==0){
                                $scope.TabPulseStatus++
                            }
                            $scope.TabHttpRequestTimes = $scope.TabPulseStatus + $scope.TabArticleStatus +  + $scope.TabCommentStatus;
                            break;
                        case "comment":
                            if($scope.TabCommentStatus==0){
                                $scope.TabPulseStatus++
                            }
                            $scope.TabHttpRequestTimes = $scope.TabPulseStatus + $scope.TabArticleStatus +  + $scope.TabCommentStatus;
                            break;
                        default:
                            if($scope.TabPulseStatus==0){
                                $scope.TabPulseStatus++
                            }
                            $scope.TabHttpRequestTimes = $scope.TabPulseStatus + $scope.TabArticleStatus +  + $scope.TabCommentStatus;
                            break;
                    }
                },
                error: function (){
                    alert ("myHomePageError：不明原因导致的获取数据失败，请联系管理员");
                }
            });
        }
    }

    /**
     * 读取用户活跃度数据
     */
    function _loadUserLiveness(uid){
        uid==undefined?uid=$location.search()["uid"]:uid;
        $.ajax({
            url:'library/xwBE-0.0.1/php/liveness_export.php',
            type:'POST',
            async: false,
            data:{"uid":uid},
            success: function (data){
                data = welcomejsonarrstring(data);
                data.pop();//SArr = [1,2,3]
                $scope.LivenessDataArr = data;//[{'date':06-01,'liveness_rate':2125},{'date':06-02,'liveness_rate':1147}]
            },
            error: function (){
                alert ("myHomePageError：不明原因导致的获取数据失败，请联系管理员");
            }
        });
    };


    /**
     * 重新生成数组，来确保Echarts正常输出
     * @param 需要修改的对象
     * @param 需要仿造的对象个数
     * @param 期望输出的值
     * @returns {*} 输出的新数组
     */
    function checkLivenessNDate(dataArr,x,OutputValue){
        var lennum = dataArr.length;
        var userNeedlennum = x-lennum;
        var _rightest = dataArr[lennum-1];//最右边的日期，也就是最晚的 //06/01

    }

    /**
     * 把一个数组转化为Echarts组件中data属性所需要的类数组字符
     */

    /**
     * Echarts
     */
    $scope.loadEchart = function (){

        var DateDateArr = [];
        var DateLivenessArr = [];
        for(x in $scope.LivenessDataArr){
            DateDateArr.push($scope.LivenessDataArr[x].date);
            DateLivenessArr.push($scope.LivenessDataArr[x].liveness_rate);
        }

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
                    data:DateDateArr,
                    name: "最近"+$scope.LivenessDataArr.length+"天",
                    nameLocation: "end",
                    min: 1,
                    max: 15,
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
                    max: 100
                }
            ],
            series: [
                {
                    name: "用户活跃度",
                    type: "line",
                    data:DateLivenessArr,
                    smooth: true,
                    symbolSize: 4
                }
            ]
        })

        // 使用刚指定的配置项和数据显示图表。
    }

    //视图初始化
    $("[data-toggle='tooltip']").tooltip();//开启tooltip
    _loadUserData();
    _loadUserLiveness();
    $scope.loadEchart();



})