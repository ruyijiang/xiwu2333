app.controller('loginController',function ($scope,$rootScope,$http,$location,$stateParams){

    $scope.UserName = "";
    $scope.UserPassword = "";
    $rootScope.NowPageTitle = "登陆 - 喜屋";

    /**
     * 提交登陆表单
     */
    $scope.loginsubmit = function (){
        $.ajax({
            url:'../../library/xwBE-0.0.1/php/login_action.php',
            method:'POST',
            data:{"email":$scope.UserName,"password":$scope.UserPassword},
            success: function (data){
                //登陆成功后注册一个localStorage
                if(welcomejsonstring(data)){//在utills/welcomejsonstring.js中定义
                    localStorage.OnlineStatus = "1";
                    window.location.reload();
                }
            },
            error: function (){
                alert ("登陆错误，请联系管理员");
            }
        })
    };

    $("[data-toggle='tooltip']").tooltip();//开启tooltip
    $rootScope.navactivitify(7);
    $stateParams.needLogin == 'needLogin'?$scope.showStepReminder = true:$scope.showStepReminder = false;
});