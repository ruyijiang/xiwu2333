/**
 * Created by 马子航 on 2016/6/6.
 */
app.controller('searchController',function ($scope, $location, search){
    var priority = $location.search()["priority"];//从url获取的查询类别
    $scope.content = $location.search()["content"];//从url获取查询正文


    if($scope.content){
        search.sendSearch($scope.content,priority);//每次进入此页时就搜索

        $scope.alertPri = function (pri){
            search.skipToSearch($scope.content,pri);
        };
        $scope.searchInPage = function (){
            search.skipToSearch($scope.content,priority);
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



});
