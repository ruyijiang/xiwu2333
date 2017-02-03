/**
 * Created by mazih on 2016/5/31.
 */


app.directive("invitationCode",function(){
        return {
            templateUrl: 'js/directive/useInvitationCode/InvitationCode.html',
            restrict : 'E',
            controller:function ($scope,$timeout){
                /**
                 * 模态窗口执行的方法
                 */
                $scope.SendIccode = function (){
                    $scope.disableModalBtn = true;
                    $(".index-mask").fadeIn("fast");

                    $timeout(function (){
                        $.ajax({
                            url:'../../library/xwBE/php/invitationCode_action.php',
                            type:'GET',
                            data:{'iccode':$scope.iccode},
                            async:false,
                            success: function (data){
                                if(welcomejsonstring(data)){
                                    alert("激活成功");
                                    window.location.reload();
                                }else{
                                    $scope.disableModalBtn = false;
                                    $(".index-mask").fadeOut("fast");
                                }
                            },
                            error: function (){
                                $scope.disableModalBtn = false;
                                $(".index-mask").fadeOut("fast");
                                alert ("未知错误导致的激活失败，请联系管理员");
                            }
                        });
                    },500);//End of $timeout

                };//End of SendIccode function

            }//End of directive's Controller
        }
    });

