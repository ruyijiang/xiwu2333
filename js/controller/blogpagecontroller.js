app.controller('blogpagecontroller',function ($scope,$rootScope,$http,$q,$location,$timeout){
    var A_aid = $location.search()["aid"];//aid根
    $scope.BlogExport = "";
    var timing = Math.round(new Date().getTime());

    /**
     * 根据aid对文章进行读取，并且把文章操作的权限和功能进行输出
     */
    function loadBlog(aid) {
        var data;
        var deferred = $q.defer();

        if(data = checkAidNexport(aid) === true){

            $http({
                method: 'GET',
                url: 'library/xwBE-0.0.1/php/blogpage_export.php',
                params:{'aid':aid}
            }).success(function (data){
                if(data.statuscode == 0){
                    //没有找到相对应的文章
                    $location.url("/404").replace();

                }else{
                    //找到了相对应的文章，对文章相关信息进行索取

                    $scope.BlogExport = data;
                    $rootScope.NowPageTitle = $scope.BlogExport.title;
                    $scope.BlogExport.content = htmldecode($scope.BlogExport.content);
                    $scope.BlogExport.hotblog = eval("("+$scope.BlogExport.hotblog+")");
                    $scope.BlogExportHotblogLen = $scope.BlogExport.hotblog.length;

                    $scope.dialog_confirmdelete = {
                        open:false,
                        content:"确认删除《"+$scope.BlogExport.title+"》吗？"
                    }

                }

            }).error(function (){
                alert ("不明原因导致的查询失败，请联系管理员");
            });

        }else{
            alert (data);
        }
    }

    /**
     * 检查是否有aid，没有aid，则推荐热度最高的前5篇文章文章
     */
    function checkAidNexport(aid){
        if(!aid || aid == "undefined"){//缺少关键参数

        }else{//有关键参数，则返回boolean
            return true;
        }
    }

    /**
     * 前一页、后一页的跳转
     */
    $scope.skiptoart = function (aid){
        $location.url("/blog?aid="+aid);
        $timeout(function (){
            window.location.reload();
        },0);
    };

    /**
     * 删除文章
     */
    $scope.confirmDel = function (aid){

        var deferred = $q.defer();

        $http({
            method: 'GET',
            url: 'library/xwBE-0.0.1/php/deleteArticle_action.php',
            params:{'aid':aid}
        }).success(function (data){
            deferred.resolve();
        }).error(function (){
            alert ("系统检测参数失败，请联系管理员");
            deferred.reject();
        }).then(function (httpCont){
            if(httpCont.data.statuscode == 1){
                //删除成功则跳转到上一篇文章
                $location.url("blog?aid="+$scope.BlogExport.prev_aid);
                window.location.reload();
            }else{
                alert ("不明原因导致的删除失败，请联系管理员");
            }
        })

    };

    loadBlog(A_aid);

    /**
     * 获取评论
     */
    $http({
        method: 'GET',
        url: 'library/xwBE-0.0.1/Interface/getComments/getComments.php',
        params:{
            "cate":"article",
            "target_id":A_aid
        }
    }).then(function (httpCont){
        $scope.comments = httpCont.data;
        console.log($scope.comments);
    });

    /**
     * 提交评论
    */
    $scope.comment_content = "";
    $scope.sendcomment = function (to_id){
        if(!to_id){
            to_id = null;
        }
        $.ajax({
            method: 'POST',
            url: 'library/xwBE-0.0.1/Interface/setComment/setComment.php',
            data:{
                "cate":"article",
                "topic_id":A_aid,
                "to_id":to_id,
                "content":$scope.comment_content
            }
        }).success(function (data){
            console.log(data);
        }).error(function (){
            alert ("不明原因导致的提交失败，请联系管理员");
        })
    };



    $("[data-toggle='tooltip']").tooltip();//开启tooltip
}).filter(
    'to_trusted', ['$sce', function ($sce) {
        return function (text) {
            return $sce.trustAsHtml(text);
        }
    }]
);