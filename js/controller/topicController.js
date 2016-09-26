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
            console.log(httpCont);
            $scope.pageDate = httpCont;
        });
    }


    /**
     * 输出其它栏目的内容
     */
    $timeout(function (){
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