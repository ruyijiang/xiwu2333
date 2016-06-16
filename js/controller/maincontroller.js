
app.controller('maincontroller',function ($scope,$http,$rootScope){
    $("[data-toggle='tooltip']").tooltip();//开启tooltip
    $rootScope.navactivitify(0);

    $scope.dialog = {
        open:false,
        content:"尚未开启，敬请期待"
    }


    
});