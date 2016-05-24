app.controller('loginController',function ($scope,$rootScope,$http,loginqq,$location){
    $("[data-toggle='tooltip']").tooltip();//开启tooltip

    $rootScope.MainPageActivity = $rootScope.SignupAcivity = $rootScope.UserListActivity = $rootScope.RoomListActivity = 0;
    $rootScope.LoginActivity = 1;


    $scope.UserName = "";
    $scope.UserPassword = "";

    /**
     * 请求接口查询是否已经登陆
     */
    var timestamp=Math.round(new Date().getTime()/1000);
    $.ajax({
        url:'../../library/xwBE-0.0.1/php/check_loginstatus.php',
        type:'POST',
        data:{timing:timestamp},
        success: function (data){
            if(welcomejsonstring(data) == true){
                //登陆了
                $location.path("/#/main").replace();
            }else{
                //没有登陆
            }
        }
    });
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
    }

    //qq登陆
    $scope.loginqq = function (){
        var SendContent = "";
        var userinfo = loginqq.getqq(SendContent);
        userinfo.gender;
        alert("loginqq()");
        console.log(userinfo);
    }
})