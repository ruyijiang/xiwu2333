/**
 * Created by 马子航 on 2016/4/15.
 */
app.controller('homepagecontroller',function ($scope,$rootScope,$location,$timeout,checkStatus,$http,$q){


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

    $scope.search_in_blog_content = "";//页内的搜索的内容


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

        var gender = "";
        if(uid == "random"){
            gender = $location.search()["gender"];
            if(gender !== "male" && gender !== "female") gender = "random";
        }

        $.ajax({
            url:'library/xwBE-0.0.1/UserAllDetails_Export.php',
            type:'GET',
            async: false,
            data:{"uid":uid},//lo这里gender有3种数据可能性:1,"random" | 2,"" | 3,"male" or "female"
            success: function (data){
                data = eval( "(" + data + ")");
                var SArr = data.server.split(',');//SArr = [1,2,3,];
                SArr.pop();
                data.server = SArr;
                $scope.UserData = data;

                /**
                 * 获取用户的比赛数据
                 */
                $scope.dota2panelmaskshow = 1;
                $http({
                    url:'../../library/xwBE-0.0.1/Interface/getDota2Info/test.php',
                    params:{
                        "uid":$scope.UserData.uid,
                        "dota2_uid":$scope.UserData.dota2_uid
                    }
                }).then(function (httpCont){
                    var Result = httpCont.data;
                    if(httpCont.data){
                        $scope.dota2panelmaskshow = 0;
                    }

                });

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
        $scope.changeShowPage(1,uid);
    }


    /********分页组件初始化******/
    $scope.a_num_onepage = 5;//每页显示条数
    $scope.ListActive = 1;//class为active的分页按钮位置代码
    $scope.ListSelectedNum = null;//class为active的分页按钮位置代码
    /*******初始化完成***********/
    $scope.changeShowPage = function (num,uid){
        $scope.a_num_onepage = $scope.UserData.page_num;
        //先判断分页基本信息
        $.ajax({
            url:'library/xwBE-0.0.1/Interface/Pagination/pagination.php',
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
                    if($scope.ArticlePageListInfo.length<obj1.page_all){
                        $scope.ArticlePageListInfo.push(i+1);
                    }
                    unique($scope.ArticlePageListInfo);
                }
                $scope.maxPageNum = parseInt(obj1.page_all);
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
     * 在blog页面里的搜索
     */
    var deferred = $q.defer();
    $scope.search_inarticle = function (){
        var content = $scope.search_in_blog_content;

        $http({
            method: 'GET',
            url: '../../library/xwBE-0.0.1/php/search_action.php',
            params:{
                'content':$scope.search_in_blog_content,
                'priority':'article',
                'startnum':0
            }
        }).success(function (data){
            deferred.resolve(data);
        }).error(function (reason){
            deferred.reject(reason);
            alert ("搜索失败，请联系管理员");
        }).then(function (httpCont){
            if(httpCont.data.statuscode == 0){
                $scope.ArticleStatus = false;
                $scope.search_in_blog_content_showtouser = $scope.search_in_blog_content;
            }else{
                $scope.ArticleStatus = true;
                $scope.search_in_blog_content_showtouser = $scope.search_in_blog_content;
                $scope.ArticleDataArr = httpCont.data;
            }
        });



    };

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
     * 控制每页显示数量
     */
    $scope.changePage_num = function(val){
        $.ajax({
            url:'../../library/xwBE-0.0.1/php/m_numpage.php',
            method:'POST',
            data:{'page_num':val},
            async:false,
            success:function (data){
                data = welcomejsonstring(data);
                if(data){
                    $scope.a_num_onepage=val;
                    $scope.dialog={
                        open: true,
                        content : "修改成功"
                    };
                    $timeout(function (){
                        window.location.reload();
                    },1101);
                }else{
                    $scope.dialog={
                        open: true,
                        content : "未知系统异常X0AB382X导致的数据更新失败，请联系管理员"
                    };
                }
            },
            error:function (){
                $scope.dialog={
                    open: true,
                    content : "未知系统异常导致数据更新失败"
                };
            }
        })
    };

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
            grid: {
                left: '1%',
                right: '4%',
                bottom: '4%',
                top:"15%",
                containLabel: true
            },
            calculable: true,
            xAxis: [
                {
                    type: "category",
                    boundaryGap: false,
                    data:DateDateArr,
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
                    name: "活跃度",
                    type: "line",
                    data:DateLivenessArr,
                    smooth: true,
                    symbolSize: 5
                }
            ]
        });

        var myChart2 = echarts.init(document.getElementById('dota2-thermodynamic-sheet-chart-body'));

        var hours = ['5月', '', '','', '','6月','','', '', '', '7月', '',
            '', '', '', '8月', '', '', '', ''];
        var days = ['周日', '周六', '周五', '周四','周三', '周二', '周一'];

        var data = [[0,0,5],[1,0,5],[2,0,5],[3,0,5],[4,0,5],[5,0,5],[6,0,5],[0,1,1],[0,2,0],[0,3,0],[0,4,0],[0,5,0],[0,6,0],[0,7,0],[0,8,0],[0,9,0],[0,10,0],[0,11,2],[0,12,4],[0,13,1],[0,14,1],[0,15,3],[0,16,4],[0,17,6],[0,18,4],[0,19,4],[1,0,7],[1,1,0],[1,2,0],[1,3,0],[1,4,0],[1,5,0],[1,6,0],[1,7,0],[1,8,0],[1,9,0],[1,10,5],[1,11,2],[1,12,2],[1,13,6],[1,14,9],[1,15,11],[1,16,6],[1,17,7],[1,18,8],[2,0,1],[2,1,1],[2,2,0],[2,3,0],[2,4,0],[2,5,0],[2,6,0],[2,7,0],[2,8,0],[2,9,0],[2,10,3],[2,11,2],[2,12,1],[2,13,9],[2,14,8],[2,15,10],[2,16,6],[2,17,5],[2,18,5],[3,0,7],[3,1,3],[3,2,0],[3,3,0],[3,4,0],[3,5,0],[3,6,0],[3,7,0],[3,8,1],[3,9,0],[3,10,5],[3,11,4],[3,12,7],[3,13,14],[3,14,13],[3,15,12],[3,16,9],[3,17,5],[3,18,5],[4,0,1],[4,1,3],[4,2,0],[4,3,0],[4,4,0],[4,5,1],[4,6,0],[4,7,0],[4,8,0],[4,9,2],[4,10,4],[4,11,4],[4,12,2],[4,13,4],[4,14,4],[4,15,14],[4,16,12],[4,17,1],[4,18,8],[5,0,2],[5,1,1],[5,2,0],[5,3,3],[5,4,0],[5,5,0],[5,6,0],[5,7,0],[5,8,2],[5,9,0],[5,10,4],[5,11,1],[5,12,5],[5,13,10],[5,14,5],[5,15,7],[5,16,11],[5,17,6],[5,18,0],[6,0,1],[6,1,0],[6,2,0],[6,3,0],[6,4,0],[6,5,0],[6,6,0],[6,7,0],[6,8,0],[6,9,0],[6,10,1],[6,11,0],[6,12,2],[6,13,1],[6,14,3],[6,15,4],[6,16,0],[6,17,0],[6,18,0]];

        data = data.map(function (item) {
            return [item[1], item[0], item[2] || '-'];
        });

        myChart2.setOption({
            tooltip: {
                position: 'top'
            },
            grid: {
                height: '90%',
                width: '96%',
                y: '0%',
                x: '4%'
            },
            xAxis: {
                type: 'category',
                data: hours,
                splitArea: {
                    show: true
                }
            },
            yAxis: {
                type: 'category',
                data: days,
                splitArea: {
                    show: true
                }
            },
            visualMap: {
                min: 0,
                max: 10,
                calculable: false,
                orient: 'horizontal',
                left: 'center',
                bottom: '-99%'
            },
            series: [{
                name: '当日数据之和',
                type: 'heatmap',
                data: data,
                label: {
                    normal: {
                        show: true
                    }
                },
                itemStyle: {
                    emphasis: {
                        shadowBlur: 7,
                        shadowColor: 'rgba(0, 0, 0, 0.4)'
                    }
                }
            }]
        });

        // 使用刚指定的配置项和数据显示图表。
    };

    /**
     * 检测是否是用户自己的页面
     */
    $scope.UidEqu = false;
    checkStatus.checkIsMeOrNot().then(function (httpCont){
        var qUid = $location.search()["uid"];
        if(!qUid) qUid=$scope.UserData.uid;
        httpCont==qUid?$scope.UidEqu = true:$scope.UidEqu = false;
    });




    //视图初始化
    $("[data-toggle='tooltip']").tooltip();//开启tooltip
    _loadUserData();
    _loadUserLiveness();
    $scope.loadEchart();
    $rootScope.navactivitify(1);
    $scope.dialog={
        open: false,
        content : ""
    };
    $rootScope.NowPageTitle = $scope.UserData.name;


});