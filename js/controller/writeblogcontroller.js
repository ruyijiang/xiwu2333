/**
 * Created by 马子航 on 2016/4/15.
 */

app.controller('writeblogcontroller',function ($scope, $rootScope, $location, $timeout, $interval, checkStatus, $http, $q){

    $rootScope.navactivitify(4);
    $rootScope.NowPageTitle = "写文章 - 喜屋";

    //预设内容
    var InitArticleAid = $location.search()["aid"];//需要初始加入的文章的aid，一般在用户需要修改文章时需要
    $scope.TabShow = 1;
    $scope.submitbtnAvail = false;
    $scope.uploadbtn_content = "确认，上传";
    //模态窗口元素
    $scope.chooseType = {
        open:true,
        title:"选择文章类型"
    };
    $scope.chooseTime = {
        open:true,
        title:"选择刊发时间"
    };


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
                console.log(httpCont.data.statuscode);

                if(httpCont.data.statuscode !== '0'){//已经成功上传

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
                }else if(data.statuscode !== '0'){
                    /*alert ("发表成功");
                      $location.url("/blog?aid="+data.statuscode).replace();
                    */
                    $scope.chooseTime.open = true;
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
     * Echarts Function
     */
    $scope.loadEchart = function (){
        var myChart_publishment = echarts.init(document.getElementById('cover-publish'));
        var dataAxis = ['点', '击', '柱', '子', '或', '者', '两', '点', '击', '柱', '子', '或', '者', '两'];
        var data = [220, 182, 191, 234, 290, 330, 310, 220, 182, 191, 234, 290, 330, 310];
        var yMax = 500;
        var dataShadow = [];

        for (var i = 0; i < data.length; i++) {
            dataShadow.push(yMax);
        }

        option = {
            title: {
                text: '特性示例：渐变色 阴影 点击缩放',
                subtext: 'Feature Sample: Gradient Color, Shadow, Click Zoom'
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
                    barCategoryGap:'40%',
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
        };//End of option
        myChart_publishment.setOption(option);

    };
    //End of Decoleration of loadEchart();

    $scope.loadEchart();
    var zoomSize = 6;
    myChart_publishment.on('click', function (params) {
        console.log(dataAxis[Math.max(params.dataIndex - zoomSize / 2, 0)]);
        myChart.dispatchAction({
            type: 'dataZoom',
            startValue: dataAxis[Math.max(params.dataIndex - zoomSize / 2, 0)],
            endValue: dataAxis[Math.min(params.dataIndex + zoomSize / 2, data.length - 1)]
        });
    });


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