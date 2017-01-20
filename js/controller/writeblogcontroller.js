/**
 * Created by 马子航 on 2016/4/15.
 */

app.controller('writeblogcontroller',function ($scope, $rootScope, $location, $timeout, $interval, checkStatus, $http, $q){

    $rootScope.navactivitify(4);
    $rootScope.NowPageTitle = "写文章 - 喜屋";
    $("[data-toggle='tooltip']").tooltip();//开启tooltip

    //预设内容
    var InitArticleAid = $location.search()["aid"];//需要初始加入的文章的aid，在用户需要修改文章时需要
    $scope.TabShow = 1;
    $scope.submitbtnAvail = false;
    $scope.uploadbtn_content = "确认，上传";
    $scope.chooseImgBtn = "选择背景图片";
    $scope.cover_id = 0;

    //模态窗口元素
    $scope.chooseType = {
        open:true,
        title:"选择文章类型"
    };

    //多个接口的查询参数
    var timing = Math.round(new Date().getTime()/1000);

    //页面数据模板
    $scope.pageData = {
        aType:"cover",//article类型 | 有两种类型：normal普通文章；cover封面文章
        title:"",//标题
        subtitle:"",//副标题
        abstract:"",//摘要
        bg_color:"",//背景颜色
        BtnContent:"查看原文"//按钮文字
    };


    /**
     * 检测用户激活具有撰写封面文章的邀请码
     */
    $http({
        method: 'GET',
        url: 'library/xwBE/Interface/checkStatus/check_invitationcodeStatus.php',
        params:{
            'funcType':"WriteCovers"
        }
    }).then(function (httpCont){
        /*
         if(httpCont.data.statuscode == 1){//用户已激活对应功能的邀请码
            $scope.chooseType.open = true;
         }else{//用户未激活邀请码
            $scope.chooseType.open = false;
         }*/
    });


    /**
     * 根据步数显示对应区域
     */
    var ueditor = null;
    $scope.showTab = function (TabShow_Index){
        $scope.TabShow = TabShow_Index;

        if(TabShow_Index == 2){
            ueditor = UE.getEditor('ueditor-main'); //启用UEditor
        }

    };


    /**
     * 选择图片，并且生成预览
     */
    $scope.selectImg = function (){
        $("#uploadbtn").click();
        $scope.submitbtnAvail = false;
        $scope.uploadbtn_content = "确认，上传";
        $scope.chooseImgBtn = "重新选择背景图片";
    };


    /**
     * 开始上传图片
     */
    $scope.uploadImg = function (){
        $scope.tnow = Math.round(new Date().getTime()/1000);
        $scope.uploadbtn_content = "上传中...";

        $("#imgname").val($scope.tnow);//之所以用jq指定值，而不是使用angular的{{}}或ng-model，是因为提交表单的时候，提交的是字面值，而ng的值
        $("#arttype").val($scope.pageData.aType);
        //在表单提交的时候，并没有赋予该控件
        $("#uploadbtn_submit").click();
        $(".index-mask").fadeIn("fast");
        
        var timer_times = 0;
        var timer_CheckImgExsit = $interval(function (){
            $http({
                method: 'GET',
                url: 'library/xwBE/Interface/checkStatus/isCoverImgExist.php',
                params:{
                    'imgname':$scope.tnow,
                    'imgCate':$scope.pageData.aType
                }
            }).then(function (httpCont){

                if(httpCont.data.statuscode !== '0'){
                    //已经成功上传
                    $interval.cancel(timer_CheckImgExsit);
                    alert ("上传成功");
                    $(".index-mask").fadeOut("fast");
                    $scope.submitbtnAvail = true;
                    $scope.uploadbtn_content = "上传成功";
                    $scope.Tempcover_img = httpCont.data.statuscode;

                }else{

                    if(timer_times >= 15){//25s没有检测到，即认为上传失败了
                        $interval.cancel(timer_CheckImgExsit);
                        alert ("上传失败");
                        $(".index-mask").fadeOut("fast");
                        $scope.uploadbtn_content = "上传失败";
                    }

                    timer_times++;

                }

            })

        },1000);
    };


    /**
     * 根据url进行判断是否是修改文章
     */
    if(InitArticleAid!=="" && InitArticleAid!==undefined && InitArticleAid!==true){
        $scope.TabShow = 2;
        $timeout(function (){
            var ueditor = UE.getEditor('ueditor-main'); //启用UEditor
        },1);
        //URL参数带aid，且不为非法值
        $http({
            method: 'GET',
            url: 'library/xwBE/php/blogpage_export.php',
            params:{'aid':InitArticleAid}
        }).then(function (httpCont){

            $scope.NeedModifiedTitle = htmldecode(httpCont.data.title);
            $scope.NeedModifiedContent = htmldecode(httpCont.data.content);//-------------------------------------------------//-

            ueditor.addListener("ready", function () {// editor准备好之后才可以使用
                ueditor.setContent($scope.NeedModifiedContent);
            });

        })
    }


    /**
     * 如果采用AJAX方式提交表单，则 m ng-submit属性上添加此函数
     * @returns {boolean}
     */
    $scope.articlesubmit = function () {
        $("#submit_btn").button('loading');//提交时按钮disable
        //获取要提交的内容
        var a_content = ueditor.getContent();//文章内容
        var alength = ueditor.getContentTxt().length;

        if(!ueditor.hasContents()){
            $("#submit_btn").button('reset');
            alert ("还没有写文章正文");
            $("#identifier").modal("show");
            return false;
        }

        //根据标题和内容，发送请求
        $scope.ArticleSubmitStatus = false;
        $.ajax({
            url:'../../library/xwBE/php/writeblog_action.php',
            method:'POST',
            async: false,
            dataType: 'json',
            data:{
                "aType":$scope.pageData.aType,
                "title":$scope.pageData.title,
                "subtitle":$scope.pageData.subtitle,
                "abstract":$scope.pageData.abstract,
                "BtnContent":$scope.pageData.BtnContent,
                "cover_img":$scope.Tempcover_img,
                "bg_color":$scope.selectedForeColor,
                "content":a_content,
                "aid":InitArticleAid,
                "alength":alength
            },
            success: function (data){
                if(data.statuscode == '0'){
                    alert (data.message);
                    $("#submit_btn").button('reset');
                    return false;
                }else if(data.statuscode !== '0' || data.message == "发表成功，但是用户文件存在异常。"){
                    $scope.cover_id = data.statuscode;
                    if($scope.pageData.aType == "cover"){//发表的是cover
                        $("#myModal_publishment").modal('show');
                        $scope.checkFurtherCovers();
                    }else{//发表的是普通文章
                        alert ("发表成功");
                        $location.url("/blog?aid="+data.statuscode).replace();
                    }
                    return true;
                    //提交成功，跳转到文章blog
                }else{
                    alert ("文章发表异常#A001，请联系管理员");
                    $("#submit_btn").button('reset');
                    return false;
                }
            },
            error: function (){
                alert ("文章发表异常#A002，请联系管理员");
                $("#submit_btn").button('reset');
                return false;
            }
        })
    };


    /**
     * 查询未来10日每天发表的封面文章数目
     */
    $scope.furtherCoversArrAm = [];
    $scope.checkFurtherCovers = function (){
        $http({
            method: 'GET',
            url: 'library/xwBE/Interface/getFurtherCovers/getFurtherCovers.php',
            params:{
                'timing':timing
            }
        }).then(function (httpCont){

            $scope.FurtherCoversAmountArr = httpCont.data.FurtherCoversAmountArr;
            $scope.FurtherDateArr = httpCont.data.FurtherDateArr;
            $scope.LargestNum = httpCont.data.LargestNum;
  
            var myChart_publishment = {};
            var dataAxis = $scope.FurtherDateArr;
            var data = $scope.FurtherCoversAmountArr;
            var yMax = $scope.LargestNum;
            var dataShadow = [];

            function loadEchart(){
                for (var i = 0; i < data.length; i++) {
                    dataShadow.push(yMax);
                }

                myChart_publishment = echarts.init(document.getElementById('cover-publish'));
                var option = {
                    title: {
                        subtext: '以下为未来10天内所有已经排期的封面文章刊发日期分布情况，仅供参考。请点击选择。'
                    },
                    xAxis: {
                        data: dataAxis,
                        axisLabel: {
                            inside: true,
                            textStyle: {
                                color: '#fff'
                            }
                        },
                        axisTick: {
                            show: false
                        },
                        axisLine: {
                            show: false
                        },
                        z: 10
                    },
                    yAxis: {
                        axisLine: {
                            show: false
                        },
                        axisTick: {
                            show: false
                        },
                        axisLabel: {
                            textStyle: {
                                color: '#999'
                            }
                        }
                    },
                    dataZoom: [
                        {
                            type: 'inside'
                        }
                    ],
                    series: [
                        { // For shadow
                            type: 'bar',
                            itemStyle: {
                                normal: {color: 'rgba(0,0,0,0.05)'}
                            },
                            barGap:'-100%',
                            barCategoryGap:'20%',
                            data: dataShadow,
                            animation: false
                        },
                        {
                            type: 'bar',
                            itemStyle: {
                                normal: {
                                    color: new echarts.graphic.LinearGradient(
                                        0, 0, 0, 1,
                                        [
                                            {offset: 0, color: '#83bff6'},
                                            {offset: 0.5, color: '#188df0'},
                                            {offset: 1, color: '#188df0'}
                                        ]
                                    )
                                },
                                emphasis: {
                                    color: new echarts.graphic.LinearGradient(
                                        0, 0, 0, 1,
                                        [
                                            {offset: 0, color: '#2378f7'},
                                            {offset: 0.7, color: '#2378f7'},
                                            {offset: 1, color: '#83bff6'}
                                        ]
                                    )
                                }
                            },
                            data: data
                        }
                    ]
                };
                myChart_publishment.setOption(option);
            }

            loadEchart();

            myChart_publishment.on('click', function (params) {
                $("#publishTime_div").show();
                $("#publishDate_ipt").val(params.dataIndex);
                $("#publishDate_span").html(params.name);
                $("#cover_id").val($scope.cover_id);
            });

            $scope.submitbtn2Available = false;
            $scope.chooseTime = function (num){
                $("#publishTime_ipt").val(num);
                $("#publishTime_span").html(num + "小时");
                $scope.submitbtn2Available = true;
            };

            var tomorrow_date,tomorrow_month,today_month;
            $scope.useDefault = function () {

                $scope.submitbtn2Available = true;
                $("#cover_id").val($scope.cover_id);
                $("#publishTime_div").show();

                $http({
                    method: 'GET',
                    url: 'library/xwBE/Interface/getEnvironment/getDate/getDate.php',
                    params:{
                        'timing':timing
                    }
                }).then(function (httpCont){
                    tomorrow_date = httpCont.data.tomorrow_date + "日";
                    tomorrow_month = httpCont.data.tomorrow_month;
                    today_month = httpCont.data.today_month;

                    $("#publishDate_ipt").val("0");
                    if(tomorrow_month == today_month){
                        var tomIso = tomorrow_date;
                    }else{
                        var tomIso = tomorrow_month + "月" + tomorrow_date;
                    }

                    $("#publishDate_span").html(tomIso);
                    $("#publishTime_ipt").val(24);
                    $("#publishTime_span").html(24 + "小时");
                });

            };//End of $scope.useDefault();

            $("#confirm_time").click(function (){
                $("#myModal_publishment").modal('hide');
            });
            //End of Echarts

        });
    };

}).filter(
    'to_trusted', ['$sce', function ($sce) {
        return function (text) {
            return $sce.trustAsHtml(text);
        }
    }]
).controller('demoCtrl', function($scope) {
    $scope.selectedForeColor = dynamicSetColor();

    $scope.$on('colorPicked', function(event, color) {
        $scope.selectedForeColor = color;
    });

    function dynamicSetColor() {
        return '#fafafa';
    }

    $scope.$watch("selectedForeColor",function (newVal,oldVal){
        if(oldVal !== undefined){
            $scope.$parent.selectedForeColor = newVal;
        }
    })

});