app.controller('loginController',function ($scope,$rootScope,$http,loginqq,$location,$stateParams){

    $scope.UserName = "";
    $scope.UserPassword = "";
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
                }else{
                    alert ("不明原因登陆失败，请联系管理员");
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