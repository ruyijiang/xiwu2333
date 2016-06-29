
app.controller('maincontroller',function ($scope,$http,$rootScope,$q){
    $("[data-toggle='tooltip']").tooltip();//开启tooltip
    $rootScope.navactivitify(0);

    $scope.dialog = {
        open:false,
        content:"尚未开启，敬请期待"
    };

    $scope.RecoUser = {};

    //Math.random()取值为0~1
    $scope.getRecUserData = function (){
        if(Math.random() >= 0){
            //随机推荐一个用户
            var timing = Math.round(new Date().getTime());
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
    $scope.getRecUserData();


});