/**
 * Created by 马子航 on 2016/6/18.
 */

/**
 * w5cValidatorProvider配置
 */
app.config(["w5cValidatorProvider", function (w5cValidatorProvider) {

    // 全局配置
    w5cValidatorProvider.config({
        blurTrig   : false,
        showError  : true,
        removeError: true
    });

    w5cValidatorProvider.setRules({
        inputname   : {
            required: "输入的邮箱地址不能为空",
            email   : "输入邮箱地址格式不正确"
        }
    });
}]);