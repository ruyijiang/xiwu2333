/**
 * Created by mazih on 2016/5/20.
 */

app.controller('m_PasswordController',function ($scope,$rootScope,$timeout){

    $scope.PasswordData = {
        OldPassword:'',
        NewPassword:'',
        RepeatedPassword:''
    };
    $scope.dialog={
        open: false,
        content : ""
    };


    $scope.form = {
        submit: function () {
            $scope.submitData();
        }
    };

    $scope.submitData = function (){
        $.ajax({
            url:'../../library/xwBE-0.0.1/php/m_password_action.php',
            data:$scope.PasswordData,
            type:'POST',
            async:false,
            success: function (data){
                data = welcomejsonstring(data);//在utills/welcomejsonstring.js中定义
                if(data == "1"){
                    $scope.dialog={
                        open: true,
                        content : "修改成功"
                    };
                    $timeout(function (){
                        window.location.reload();
                    },700);
                }
            },
            error: function (){
                $scope.dialog={
                    open: true,
                    content : "未知原因导致修改失败，请联系管理员"
                };
            }
        });
    }






});
