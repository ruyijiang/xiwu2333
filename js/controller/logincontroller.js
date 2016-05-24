app.controller('loginController',function ($scope,$http,loginqq,$location){
    $("[data-toggle='tooltip']").tooltip();//开启tooltip

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
                if(welcomejsonstring(data)){//在utills/welcomejsonstring.js中定义
                    window.location.reload();
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