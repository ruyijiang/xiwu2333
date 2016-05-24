/**
 * Created by 马子航 on 2016/4/15.
 */
app.controller('homepagecontroller',function ($scope,$rootScope,$state,$stateParams){
    console.log("接收到传递来的参数" +$stateParams.tab);
    $scope.visibleDiv = '';
    // 用来使用get传参显示
    $scope.toTab = function (tabindex){
        switch(tabindex){
            case "pulse":
                $state.go('myhomeWithPulse', {tab: 'pulse'});
                break;
            case "article":
                $state.go('myhomeWithArticle', {tab: 'article'});
                break;
            case "assess":
                $state.go('myhomeWithAssess', {tab: 'assess'});
                break;
        }
    }
    // 后端全部加载之后，使用showh和hide进行操作
    $scope.PulseShow = 1;
    $scope.ArticleShow = $scope.AssessShow = 0;
    $scope.Tabshow = function (tabindex){
        switch(tabindex){
            case 1:
                $scope.PulseShow = 1;
                $scope.ArticleShow = $scope.AssessShow = 0;
                alert ("1");
                break;
            case 2:
                $scope.ArticleShow = 1;
                $scope.PulseShow = $scope.AssessShow = 0;
                alert ("2");
                break;
            case 3:
                $scope.AssessShow = 1;
                $scope.PulseShow = $scope.ArticleShow = 0;
                alert ("3");
                break;
            default:
                $scope.PulseShow=1;
                alert ("de");
        }
    }










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
})