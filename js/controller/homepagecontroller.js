/**
 * Created by 马子航 on 2016/4/15.
 */
app.controller('homepagecontroller',function ($scope,$rootScope,$location){


    $scope.TabShowPage = 1;//当前TabIndex值
    $scope.UserData = {};//请求回来用户数据内容对象

    $scope.LivenessDataArr = [];//请求回来的对应用户的活跃度
    $scope.ArticleDataArr = [];//请求回来的对应用户的文章
    $scope.ArticlePageListInfo = [];//请求回来的对应用户的文章

    $scope.TabShowPage = 1;//Tab标签当前显示位置
    $scope.maxPageNum = 0;

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

    /**
     * 切换tab时触发的事件
     */
    $scope.Tabshow = function (tabindex){
        if($scope.TabHttpRequestTimes<3){
            switch(tabindex){
                case 1:
                    if($scope.TabPulseStatus==0)
                    _loadUserLiveness();
                    break;
                case 2:
                    if($scope.TabArticleStatus==0)
                    _loadUserArticle();
                    break;
                case 3:
                    if($scope.TabCommentStatus==0)
                    _loadUserComent();
                    break;
                default:
                    _loadUserData("pulse");
                    tabindex = 1;
                    break;
            }
        }
        $scope.TabShowPage = tabindex;
    };





    /**
     * 从数据库读取用户基础信息数据
     * 备注：此函数所有参数均为可选
     * @param uid ： 请求的用户的uid，如果为空，则会传递空值给ajax，而在对应的程序里会默认显示登陆的用户自己的
     */
    function _loadUserData(uid){
        //判断url里是否有tab。如果有，则请求对应tab的请求；如果没有，则请求默认的pulse数据
        uid==undefined?uid=$location.search()["uid"]:uid;
        $.ajax({
            url:'library/xwBE-0.0.1/UserAllDetails_Export.php',
            type:'POST',
            async: false,
            data:{"uid":uid},
            success: function (data){
                data = eval( "(" + data + ")");
                var SArr = data.server.split(',');//SArr = [1,2,3,];
                SArr.pop();
                data.server = SArr;
                $scope.UserData = data;
            },
            error: function (){
                alert ("myHomePageError：不明原因导致的获取数据失败，请联系管理员");
            }
        });
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
                data.pop();
                $scope.LivenessDataArr = data;
                updateTabRequestStatus('pulse');
            },
            error: function (){
                alert ("myHomePageError：不明原因导致的获取数据失败，请联系管理员");
            }
        });
    }

    /**
     * 读取用户博客数据
     */
    function _loadUserArticle(uid){
        uid==undefined?uid=$location.search()["uid"]:uid;
        //发送请求，根据分页情况获取articles
        $scope.changeShowPage(0,uid);
    }

    
    /********分页组件初始化******/
    $scope.a_num_onepage = 1;//每页显示条数
    $scope.ListActive = 1;//class为active的分页按钮位置代码
    $scope.ListSelectedNum = null;//class为active的分页按钮位置代码
    /*******初始化完成***********/
    $scope.changeShowPage = function (num,uid){
        //先判断分页基本信息
        $.ajax({
            url:'library/xwBE-0.0.1/Interface/pagination.php',
            type:'GET',
            async:false,
            data:{
                "responseCate":"article",
                "num_onepage":$scope.a_num_onepage,
                "uid":uid
            },
            success: function (data){
                var obj1;
                obj1 = eval("("+data+")");
                for(var i=0;i<obj1.page_all;i++){
                    $scope.ArticlePageListInfo.push(i+1);
                }
                $scope.maxPageNum = obj1.page_all;
                updateTabRequestStatus('article');
            },
            error: function (){
                alert ("分页数据获取失败");
            }
        });
        //根据指示调取该页的信息
        $.ajax({
            url:'../../library/xwBE-0.0.1/php/article_export.php',
            type:'POST',
            async: false,
            data:{
                "num_onepage":$scope.a_num_onepage,
                "now_page":num,
                "uid":uid
            },
            success: function (data){
                $scope.ArticleDataArr = welcomejsonarrstring(data);
                $scope.ListActive = num;
                $scope.ListSelectedNum = num;
            },
            error: function (data){
                alert ("获取[用户文章资料]异常，请联系管理员");
            }
        });
    };

    /**
     * 读取用户评论数据
     */
    function _loadUserComent(uid){
        uid==undefined?uid=$location.search()["uid"]:uid;
        updateTabRequestStatus('comment');
    }




    /**
     * 检测数据请求的允许状态
     * @param requestData
     */
    function updateTabRequestStatus(requestData){
        switch (requestData){
            case "pulse":
                if($scope.TabPulseStatus==0) $scope.TabPulseStatus++;
                break;
            case "article":
                if($scope.TabArticleStatus==0) $scope.TabArticleStatus++;
                break;
            case "comment":
                if($scope.TabCommentStatus==0) $scope.TabCommentStatus++;
                break;
        }
        $scope.TabHttpRequestTimes = $scope.TabPulseStatus + $scope.TabArticleStatus + $scope.TabCommentStatus;
    }






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