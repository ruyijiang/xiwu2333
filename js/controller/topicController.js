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
            $scope.pageDate = httpCont;
        });
    }


    /**
     * 输出其它栏目的内容
     */
    $timeout(function (){
        //1，输出相关话题
        $http({
            method: 'GET',
            url: '../../library/xwBE-0.0.1/Interface/getTopicInfo/getRelatedTopic.php',
            params:{'params': $scope.pageDate.tags }
        }).success(function (httpCont){
            $scope.RelatedTopicArr = httpCont;
        });

        //2，输出最新话题
        $http({
            method: 'GET',
            url: '../../library/xwBE-0.0.1/Interface/getTopicInfo/getLatestTopic.php',
            params:{'params': new Date().getTime() }
        }).success(function (httpCont){
            $scope.LatestTopicArr = httpCont;
        });

    },0);



    $scope.test1 = true;
    $scope.test2 = true;
    $scope.test3 = false;
    $scope.testra = 3;


});