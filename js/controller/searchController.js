/**
 * Created by 马子航 on 2016/6/6.
 */
app.controller('searchController',function ($scope, $location, $http, search){
    var priority = $location.search()["priority"];//从url获取的查询类别
    $scope.content = $location.search()["content"];//从url获取查询正文
    $scope.thisContent = $scope.content;//用于没有找到内容时显示
    $scope.SearchContentReq = [];
    /**
     * 一旦进入此视图，则立即执行以下if(){}else{}
     */
    if($scope.content){
        if(priority!=='article'&&priority!=='competition') priority='user';

            sendSearch($scope.content,priority);//每次进入此页时就搜索

            $scope.alertPri = function (pri){
                skipToSearch($scope.content,pri);
            };
            $scope.searchInPage = function (){
                skipToSearch($scope.content,priority);
            };
            //有查询content，则显示结果视图
            $scope.SearchConsequenceShow = 1;
            //控制左侧导航的样式
            if(priority !== ""){
                switch (priority){
                    case "user":
                        $scope.leftNavIndex = 1;
                        break;
                    case "competition":
                        $scope.leftNavIndex = 2;
                        break;
                    case "article":
                        $scope.leftNavIndex = 3;
                        break;
                    default:
                        $scope.leftNavIndex = 1;
                }
            }
    }else{
        //没有查询content，则显示全局查找视图
        $scope.SearchInputDivShow = 1;
    }



    function skipToSearch(value,priority){
        !priority?priority="user":priority;
        $window.location.href = "/#/search?priority=" + priority+ "&content=" + value ;
        window.location.reload();
    }

    function sendSearch(value,priority){
        !priority?priority="user":priority;
        /*$http({
            method: 'GET',
            url: 'library/xwBE-0.0.1/php/search_action.php',
            params:{'priority':priority,'content':value}
        }).success(function (data){
            console.log(data);
            $scope.SearchContentReq = welcomejsonarrstring(data);
        }).error(function (){
            alert ("不明原因导致的查询失败，请联系管理员");
        });*/

        $.ajax({
            type:'GET',
            async:false,
            url:'library/xwBE-0.0.1/php/search_action.php',
            data:{"priority":priority,"content":value},
            success: function (data){
                $scope.SearchContentReq = welcomejsonarrstring(data);
            },
            error: function (){
                alert ("不明原因导致的查询失败，请联系管理员");
            }
        })

    }
    console.log($scope.SearchContentReq);



});
