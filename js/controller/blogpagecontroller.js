app.controller('blogpagecontroller',function ($scope,$rootScope,$http,$q,$location,$timeout){
    var A_aid = $location.search()["aid"];//aid根
    $scope.A_aid = A_aid;
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
                    $rootScope.NowPageTitle = $scope.BlogExport.title + " - 喜屋";
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
    loadBlog(A_aid);


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
        }).success(function (){
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

    $scope.ArticlePageListInfo = [];
    $scope.changeShowPage = function (num,content){

        $.ajax({
            url:'library/xwBE-0.0.1/Interface/Pagination/pagination.php',
            type:'GET',
            async:false,
            data:{
                "responseCate":"comment",
                "num_onepage":6,
                "content":A_aid
            },
            success: function (data){
                var obj1 = eval ("(" + data + ")");
                for(var i=0;i<obj1.page_all;i++){
                    $scope.ArticlePageListInfo.push(i+1);
                    unique($scope.ArticlePageListInfo);
                    $scope.maxPageNum = parseInt(obj1.page_all);
                }
            },
            error: function (){
                alert ("分页数据获取失败");
            }
        });

        //根据指示调取该页的信息
        $.ajax({
            url:'../../library/xwBE-0.0.1/Interface/getComments/getComments.php',
            type:'GET',
            async: false,
            data:{
                "cate":"article",
                "target_id":A_aid,
                "now_page":num,
                "num_onepage":6

            },
            success: function (data){
                $scope.ArticleDataArr = welcomejsonarrstring(data);
                $scope.ListActive = num;
                $scope.ListSelectedNum = num;

                $scope.comments = $scope.ArticleDataArr[0];
                !$scope.comments?$scope.commentsLen = 0:$scope.commentsLen = $scope.comments.length;
            },
            error: function (data){
                alert ("获取[用户文章资料]异常，请联系管理员");
            }
        });

    };

    $scope.changeShowPage(1,A_aid);



    /**
     * 发表评论
    */
    $scope.comment_content = "";//对文章的评论

    //提交评论
    $scope.sendcomment = function (to_id,content){
        if(!to_id){
            to_id = null;
        }

        if(!content && !$scope.comment_content){
            alert ("还没有填写评论内容");
            return false;
        }else if(!content && $scope.comment_content){
            content = $scope.comment_content;//如果content参数为空，则是对文章的评论，所以调用$scope.comment_content
        }

        $.ajax({
            method: 'POST',
            url: 'library/xwBE-0.0.1/Interface/setComment/setComment.php',
            data:{
                "cate":"article",
                "topic_id":A_aid,
                "to_id":to_id,
                "content":content
            }
        }).success(function (data){


        }).error(function (){
            alert ("不明原因导致的提交失败，请联系管理员");
        })
    };

    //控制对应评论区域的显示和评论内容的初始化
    $scope.commentthis = function (index){

        if($scope.commentAreaShower !== null && $scope.commentAreaShower !== index){
            $scope.commentAreaShower = index;
        }else if($scope.commentAreaShower == null){
            $scope.commentAreaShower = index;
        }else{
            $scope.commentAreaShower = null;
        }

    };


    $("[data-toggle='tooltip']").tooltip();//开启tooltip


}).filter(

    'to_trusted', ['$sce', function ($sce) {
        return function (text) {
            return $sce.trustAsHtml(text);
        }
    }]

);
