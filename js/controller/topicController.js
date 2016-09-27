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
        $http({
            method: 'GET',
            url: '../../library/xwBE-0.0.1/Interface/getTopicInfo/getLatestTopic.php',
            params:{'params': Math.round(new Date().getTime()/1000) }
        }).success(function (httpCont){
            $scope.pageDate.LatestTopicArr = httpCont;
        });

    },0);


    $scope.multiplechoices = [];
    $scope.checkbox_choose = function (index){
        if($scope.multiplechoices[index] == 1){
            $scope.multiplechoices[index] = 0;
        }else{
            $scope.multiplechoices[index] = 1;
        }
        console.log($scope.multiplechoices);
    };

    /**
     * 保存数据
     */
    $scope.saveData = function (e){
        console.log($(".btn_forer > input").attr("type"));


        //把单选或多选的数据格式化
        if($(".btn_forer > input").attr("type") == "checkbox"){

            var Tclassification = "checkbox";

            for(var i=0;i<$(".btn_forer > input.topic_checkbox").length;i++){
                if(!$scope.multiplechoices[i]){
                    $scope.multiplechoices[i] = 0;
                }
            }

        }else if($(".btn_forer > input").attr("type") == "radio"){

            var Tclassification = "radio";
            $scope.multiplechoices = $scope.topic_radio;

        }

        //发送数据
        $.ajax({
            url:'../../library/xwBE-0.0.1/Interface/setTopic/topic_action.php',
            type:'POST',
            async: false,
            data:{
                "classification":Tclassification,
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