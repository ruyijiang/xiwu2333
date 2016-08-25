
app.controller('maincontroller',function ($scope,$http,$rootScope,$q){

    $("[data-toggle='tooltip']").tooltip();//开启tooltip
    $rootScope.navactivitify(1);
    var timing = Math.round(new Date().getTime());

    $scope.RecoUser = {};
    $rootScope.NowPageTitle = "首页 - 喜屋";

    //Math.random()取值为0~1
    $scope.getRecUserData = function (){
        if(Math.random() >= 0){
            //随机推荐一个用户
            var derreferd = $q.defer();

            $scope.RecCate = "user";
            $http({
                method: 'GET',
                url: 'library/xwBE-0.0.1/Interface/getRandom/getRandomUser.php',
                params:{'timing':timing}
            }).success(function (){
                derreferd.resolve();
            }).error(function (){
                derreferd.reject();
            }).then(function (httpCont){
                $http({
                    method: 'GET',
                    url: 'library/xwBE-0.0.1/UserAllDetails_Export.php',
                    params:{'uid':httpCont.data}
                }).then(function (httpCont){
                    $scope.RecoUser = httpCont.data;
                    $scope.RecoUserServerArr = httpCont.data.server.split(",");
                })
            })
        }
    };

    /**
     * 获取当前在线玩家数
     */
    $.ajax({
        url: 'library/xwBE-0.0.1/php/EchartData_Export.php',
        type:'POST',
        async: false,
        data:{'mod':'getOnlineUsersAmount','timing':timing},
        success: function (data){
            $scope.onLineUserAccount = data;
        }
    });


    $scope.getRecUserData();


});