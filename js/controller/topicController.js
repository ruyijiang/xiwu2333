/**
 * Created by 马子航 on 2016/9/5.
 */

app.controller('topicController',function ($scope,$rootScope,$http,$location,$timeout,$stateParams){

    /**
     * 对topic_url参数进行分析操作，从而输出话题
     */
    if($stateParams.TopicUrl){
        $http({
            method: 'GET',
            url: '../../library/xwBE/Interface/getTopicInfo/getTopicInfo.php',
            params:{'content': $stateParams.TopicUrl }
        }).success(function (httpCont){

            if(httpCont.statuscode == 0){
                $location.path("404").replace();
            }else{
                $scope.pageData = httpCont;

                //判断用户是否已经投票
                if($scope.pageData.topic_classification == "radio" || $scope.pageData.topic_classification == "checkbox"){

                    $http({
                        method: 'GET',
                        url: '../../library/xwBE/Interface/checkStatus/check_ballotstatus.php',
                        params:{'topic_id': $scope.pageData.topic_id}
                    }).then(function (httpCont2){


                        if(httpCont2.data.statuscode == 0){
                            $scope.isVoted = false;//没有投过票
                        }else{
                            $scope.isVoted = true;//投过票
                            $scope.BallotsAllAmount = 0;
                            for(var i in httpCont2.data.results){
                                for (var j in httpCont.topic_choices){
                                    if(i == j){
                                        httpCont.topic_choices[j]["ballots_amount"] = httpCont2.data.results[i];
                                        $scope.BallotsAllAmount += httpCont2.data.results[i];
                                    }
                                }
                            }

                        }

                    });

                }
                $scope.changeShowPage(1,$scope.pageData.topic_id);
            }
            $rootScope.NowPageTitle = $scope.pageData.title + " - 喜屋";
        });
    }


    /**
     * 输出其它栏目的内容
     */
    $timeout(function (){

        $http({
            method: 'GET',
            url: '../../library/xwBE/Interface/getTopicInfo/getLatestTopic.php',
            params:{'params': Math.round(new Date().getTime()/1000) }
        }).success(function (httpCont){
            $scope.pageData.LatestTopicArr = httpCont;
        });

    },0);


    /**
     * 保存数据
     */
    $scope.choices = [];
    $scope.test2 = 1;

    var vm = $scope.vm = {};
    vm.comment_content = '';//对话题的评论

    $scope.saveData = function (content){
        if($scope.pageData.topic_classification == "text" || $scope.isVoted){
            $scope.sendcomment('',content);
        }else{
            //发送数据
            $.ajax({
                url:'../../library/xwBE/Interface/setTopic/topic_action.php',
                type:'POST',
                async: false,
                data:{
                    "classification":$scope.pageData.topic_classification,
                    "choices":$scope.choices,
                    "topic_id":$scope.pageData.topic_id
                },
                success: function (data){
                    data = eval( "(" + data + ")");
                    $scope.UserInfoData = data;
                },
                error: function (data){
                    alert ("获取个人信息异常，请联系管理员");
                }
            })
        }
    };


    //提交评论
    $scope.sendcomment = function (to_id,content){
        if(!to_id){
            to_id = null;
        }

        if(!content){
            alert ("还没有填写评论内容");
            return false;
        }else{
            $.ajax({
                method: 'POST',
                url: 'library/xwBE/Interface/setComment/setComment.php',
                data:{
                    "cate":"topic",
                    "topic_id":$scope.pageData.topic_id,
                    "to_id":to_id,
                    "content":content
                }
            }).success(function (data){


            }).error(function (){
                alert ("不明原因导致的提交失败，请联系管理员");
            })
        }

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


    /**
     * 话题评论的分页控件
     */
    $scope.TopicPageListInfo = [];
    $scope.changeShowPage = function (num,content){

        $.ajax({
            url:'library/xwBE/Interface/Pagination/pagination.php',
            type:'GET',
            async:false,
            data:{
                "responseCate":"comment",
                "num_onepage":6,
                "content":$scope.pageData.topic_id
            },
            success: function (data){
                var obj1 = eval ("(" + data + ")");
                for(var i=0;i<obj1.page_all;i++){
                    $scope.TopicPageListInfo.push(i+1);
                    unique($scope.TopicPageListInfo);
                    $scope.maxPageNum = parseInt(obj1.page_all);
                }
            },
            error: function (){
                alert ("分页数据获取失败");
            }
        });

        //根据指示调取该页的信息
        $.ajax({
            url:'../../library/xwBE/Interface/getComments/getComments.php',
            type:'GET',
            async: false,
            data:{
                "cate":"topic",
                "target_id":$scope.pageData.topic_id,
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


});
