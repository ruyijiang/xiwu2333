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
            url: '../../library/xwBE-0.0.1/Interface/getTopicInfo/getTopicInfo.php',
            params:{'content': $stateParams.TopicUrl }
        }).success(function (httpCont){
            $scope.pageData = httpCont;
            console.log($scope.pageData);
        });
    }

    /**
     * 输出其它栏目的内容
     */
    $timeout(function (){
        $http({
            method: 'GET',
            url: '../../library/xwBE-0.0.1/Interface/getTopicInfo/getLatestTopic.php',
            params:{'params': Math.round(new Date().getTime()/1000) }
        }).success(function (httpCont){
            $scope.pageData.LatestTopicArr = httpCont;
        });

    },0);


    /**
     * 保存数据
     */
    $scope.multiplechoices = [];
    $scope.saveData = function (e){

        //发送数据
        $.ajax({
            url:'../../library/xwBE-0.0.1/Interface/setTopic/topic_action.php',
            type:'POST',
            async: false,
            data:{
                "classification":"",
                "choices":$scope.multiplechoices,
                "content":"",
                "topic_id":""
            },
            success: function (data){
                data = eval( "(" + data + ")");
                $scope.UserInfoData = data;
            },
            error: function (data){
                alert ("获取个人信息异常，请联系管理员");
            }
        })

    };


});