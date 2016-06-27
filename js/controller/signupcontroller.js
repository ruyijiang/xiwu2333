
app.controller('signupcontroller',function ($scope,$rootScope,$http,$location){

    $rootScope.MainPageActivity = $rootScope.LoginActivity = $rootScope.UserListActivity = $rootScope.RoomListActivity = 0;
    $rootScope.SignupAcivity = 1;


    $scope.UserName = '';
    $scope.UserPassword = '';
    $scope.UserPassword_Repeat = '';
    $scope.Gender = '';

    /**
     * 提交注册表单
     * @returns {boolean}
     */
    $scope.signupsubmit = function (){
        var status = reminder = null;
        //先检验是否选择了性别
        if($scope.Gender == "male" || $scope.Gender == "female"){
            $status = 1;
        }else{
            $status = 0;
            $reminder = "还没有选择性别";
            alert ($reminder);
            return false;
        }
        //再检验两次输入的密码是否一致
        if($status == 1){

            if($scope.UserPassword_Repeat === $scope.UserPassword){

                $.ajax({
                    url:'../../library/xwBE-0.0.1/php/signup_action.php',
                    method:'POST',
                    data:{"email":$scope.UserName,"password":$scope.UserPassword,"gender":$scope.Gender},
                    success: function (data){
                        if(welcomejsonstring(data)){//welcomejsonstring(data)在utills/welcomejsonstring.js中定义
                            //--------------------------------------------------------------->注册成功
                            //1，登陆
                            $.ajax({
                                url:'../../library/xwBE-0.0.1/php/login_action.php',
                                method:'POST',
                                data:{"email":$scope.UserName,"password":$scope.UserPassword},
                                success: function (data){
                                    //2，跳转
                                    localStorage.OnlineStatus = "1";
                                    $location.path("/main");
                                },
                                error: function (){
                                    alert ("注册后的自动登陆环节出现错误，请手动登录。");
                                }
                            })
                        }
                        return true;
                    },
                    error: function (){
                        alert ("注册错误，请联系管理员");
                        return false;
                    }
                })

            }else{
                $status = 0;
                $reminder = "两次输入的密码不一致";
                alert ($reminder);
                return false;
            }

        }else{
            alert ($reminder);
        }
    }//End of signupsubmit()


    $("[data-toggle='tooltip']").tooltip();//开启tooltip
    $rootScope.navactivitify(6);
})