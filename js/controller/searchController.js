/**
 * Created by 马子航 on 2016/6/6.
 */
app.controller('searchController',function ($scope, $location, $http, search, $window){
    $scope.priority = $location.search()["priority"];//从url获取的查询类别
    $scope.content = $location.search()["content"];//从url获取查询正文
    $scope.thisContent = $scope.content;//用于没有找到内容时显示
    $scope.SearchContentReq = [];
    /**
     * 一旦进入此视图，则立即执行以下if(){}else{}
     */
    if($scope.content){
        if($scope.priority!=='article'&&$scope.priority!=='competition') $scope.priority='user';


            $scope.alertPri = function (pri){
                skipToSearch($scope.content,pri);
            };
            $scope.searchInPage = function (){
                skipToSearch($scope.content,$scope.priority);
            };
            //有查询content，则显示结果视图
            $scope.SearchConsequenceShow = 1;
            //控制左侧导航的样式
            if($scope.priority !== ""){
                switch ($scope.priority){
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

    $scope.sendSearch = function(value,priority,startpage){
        !priority?priority="user":priority;
        !startpage?startpage=1:startpage;
        var startnum = (startpage - 1) * 15;
        console.log(startnum);

        $.ajax({
            type:'GET',
            async:false,
            url:'library/xwBE-0.0.1/php/search_action.php',
            data:{"priority":priority,"content":value,"startnum":startnum},
            success: function (data){
                $scope.SearchContentReq = welcomejsonarrstring(data);
                //生成分页
                var SearchReqContLen = $scope.SearchContentReq.length;
                var searchResult_rows_num = $scope.SearchContentReq[SearchReqContLen - 1];
                $scope.SearchResultPage_num = Math.ceil(searchResult_rows_num.row_num / 15);//页数
                $scope.Page_ficArr = [];
                for(var i=0;i<$scope.SearchResultPage_num;i++){
                    $scope.Page_ficArr.push(i+1);
                }

            },
            error: function (){
                alert ("不明原因导致的查询失败，请联系管理员");
            }
        })

    };


    $scope.sendSearch($scope.content,$scope.priority,0);//每次进入此页时就搜索

});
