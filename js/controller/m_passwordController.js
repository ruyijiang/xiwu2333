/**
 * Created by mazih on 2016/5/20.
 */

app.controller('m_PasswordController',function ($scope,$rootScope){

    $scope.PasswordData = {
        OldPassword:'',
        NewPassword:'',
        RepeatedPassword:''
    };

    $scope.submitData = function (){
        $.ajax({
            url:'../../library/xwBE-0.0.1/php/m_password_action.php',
            data:$scope.PasswordData,
            type:'POST',
            success: function (data){
                data = welcomejsonstring(data);//在utills/welcomejsonstring.js中定义
                if(data == "1"){
                    alert ("修改成功");
                }
            },
            error: function (){
                alert ("修改失败，请联系管理员");
            }
        });
    }






});
