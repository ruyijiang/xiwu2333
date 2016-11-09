/**
 * Created by 马子航 on 2016/4/15.
 */

app.controller('writeblogcontroller',function ($scope, $rootScope, $location, $timeout, $interval, checkStatus, $http, $q){
    //预设内容
    var InitArticleAid = $location.search()["aid"];//需要初始加入的文章的aid，一般在用户需要修改文章时需要
    $rootScope.NowPageTitle = "写文章 - 喜屋";
    $scope.TabShow = 1;


    //页面数据模板
    $scope.pageData = {
        BtnContent:"查看原文"
    };


    /**
     * 根据步数显示对应区域
     */
    $scope.showTab = function (TabShow_Index){
        $scope.TabShow = TabShow_Index;

        if(TabShow_Index == 2){
            $timeout(function (){
                var ueditor = UE.getEditor('ueditor-main'); //启用UEditor
            },0);
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
    $scope.tnow = Math.round(new Date().getTime()/1000);
    $scope.uploadImg = function (){
        $scope.tnow = Math.round(new Date().getTime()/1000);
        $("#uploadbtn_submit").click();
        $(".index-mask").fadeIn("fast");
        console.log($scope.tnow);
        $interval(function (){
            $http({
                method: 'GET',
                url: 'library/xwBE-0.0.1/Interface/checkStatus/isCoverImgExist.php',
                params:{'imgname':$scope.tnow}
            }).then(function (httpCont){

                console.log(httpCont);

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
            url: 'library/xwBE-0.0.1/php/blogpage_export.php',
            params:{'aid':InitArticleAid}
        }).then(function (httpCont){

            $scope.NeedModifiedTitle = htmldecode(httpCont.data.title);
            $scope.NeedModifiedContent = htmldecode(httpCont.data.content);

            ueditor.addListener("ready", function () {// editor准备好之后才可以使用
                ueditor.setContent($scope.NeedModifiedContent);
            });

        })
    }

    /**
     * 如果采用AJAX方式提交表单，则在form ng-submit属性上添加此函数
     * @returns {boolean}
     */
    $scope.articlesubmit = function () {
        $("#submit_btn").button('loading');//提交时按钮disable
        //获取要提交的内容
        var a_title = $("input#a_title").val();//文章标题
        var a_content = ueditor.getContent();//文章内容
        var alength = ueditor.getContentTxt().length;
        a_cotent = htmlencode(a_content);

        if(!ueditor.hasContents()){
            $("#submit_btn").button('reset');
            alert ("还没有写文章正文");
            $("#identifier").modal("show");
            return false;
        }
        //根据标题和内容，发送请求
        $.ajax({
            url:'../../library/xwBE-0.0.1/php/writeblog_action.php',
            method:'POST',
            async: false,
            dataType: 'json',
            data:{"title":a_title,"content":a_content,"aid":InitArticleAid,"alength":alength},
            success: function (data){
                if(data.statuscode == '0'){
                    alert (data.message);
                    $("#submit_btn").button('reset');
                    return false;
                }else if(data.statuscode !== '0'){
                    alert ("发表成功");
                    $location.url("/blog?aid="+data.statuscode).replace();
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

    $("[data-toggle='tooltip']").tooltip();//开启tooltip

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

    // 动态设置默认颜色
    $scope.dynamicSetColor = dynamicSetColor;

    function dynamicSetColor() {
        return '#fafafa';
    }

});