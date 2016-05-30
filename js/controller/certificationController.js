/**
 * Created by 马子航 on 2016/5/18.
 */
app.controller('certificationController',function ($scope){
    $("[data-toggle='tooltip']").tooltip();//开启tooltip
    $scope.IdCardEditable = 0;
    $scope.TelEditable = 0;
    $scope.EmailEditable = 0;
    $scope.dialog={
        open: false,
        content : ""
    };

    /**
     * 切换输入框可输入状态和按钮icon
     * @param target
     */
    $scope.changeEditability = function (target){
        if(target == 1){
            $scope.IdCardEditable = 1;
        }else if(target == 2){
            $scope.TelEditable = 1;
        }else if(target == 3){
            $scope.EmailEditable = 1;
        }
    };


    /**
     * 提交修改信息
     * @param key：类
     * @param value：值
     */
    $scope.submitData = function(key){
        var val = null;
        if(key == 1){
            key = "idcard";
            val = $("#idcard_ipt").val();
        }else if(key == 2){
            key = "tel";
            val = $("#tel_ipt").val();
        }else if(key == 3){
            key = "email";
            val = $("#email_ipt").val();
        }

        $.ajax({
            url:"../../library/xwBE-0.0.1/php/certdata_action.php",
            type:'POST',
            async: false,
            data:{"key":key,"value":val},
            success: function (data){
                data = welcomejsonstring(data);
                if(data == '1'){
                    if(key == "idcard"){
                        $scope.IdCardEditable = 0;
                    }else if(key == "tel"){
                        $scope.TelEditable = 0;
                    }else if(key == "email"){
                        $scope.EmailEditable = 0;
                    }
                    $scope.dialog={
                        open: true,
                        content : "保存成功"
                    };
                }
            },
            error: function (){
                alert ("修改失败，请联系管理员");
            }
        });
    }

});
