/**
 * Created by mazih on 2016/5/10.
 */
app.controller('xiwucontroller',function ($scope,$http,$location){
    $("[data-toggle='tooltip']").tooltip();//开启tooltip

    /**
     * 退出登录
     */
    $scope.logout = function (){
        $.ajax({
            url:'../../library/xwBE-0.0.1/php/logout_action.php',
            success: function (data){
                welcomejsonstring(data);//在utills/welcomejsonstring.js中定义
                window.location.reload();
            },
            error: function (){
                alert ("注销失败，请联系管理员");
            }
        });
    }//End of logout()

})