/**
 * Created by 马子航 on 2016/6/19.
 */
(function() {
    angular
        .module('validation.rule', ['validation'])
        .config(['$validationProvider', function($validationProvider,$httpProvider) {
            var expression = {
                required: function(value) {
                    return !!value;
                },
                url: /((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/,
                newurl:function (value, scope, element, attrs, param){
                    var ab = element.val();
                    if(!ab){
                        return true;
                    }else{
                        return ab.match(/((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/);
                    }
                },
                email: /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/,
                number: /^\d+$/,
                dota2Uid:function (value, scope, element, attrs, param){
                    var ab = element.val();
                    if(!ab){
                        return true;
                    }else{
                        return ab.match(/^\d{5,10}$/);
                    }
                },
                qq:/^\d{4,11}$/,
                newqq:function (value, scope, element, attrs, param){
                    var ab = element.val();
                    if(!ab){
                        return true;
                    }else{
                        return ab.match(/^\d{4,11}$/);
                    }
                },
                wechat:/^\w+$/,
                newwechat:function (value, scope, element, attrs, param){
                    var ab = element.val();
                    if(!ab){
                        return true;
                    }else{
                        return ab.match(/^\w+$/);
                    }
                },
                Xiwupassword:/\w{8,24}/,
                telnumber: /[1][3578][0-9]{9}/,
                newtelnumber:function (value, scope, element, attrs, param){
                    var ab = element.val();
                    if(!ab){
                        return true;
                    }else{
                        return ab.match(/[1][3578][0-9]{9}/);
                    }
                },
                idcard:/^\d{17}[\d|xX]$|^\d{18}$/,
                minlength: function(value, scope, element, attrs, param) {
                    return value.length >= param;
                },
                maxlength: function(value, scope, element, attrs, param) {
                    return value.length <= param;
                },
            };

            var defaultMsg = {
                required: {
                    error: '必须填写'
                },
                newurl: {
                    error: '请输入正确的网址链接'
                },
                TopicUrl:{
                    error: '该URL链接不符合要求或已被占用'
                },
                url: {
                    error: '请输入正确的网址链接'
                },
                email: {
                    error: '请输入格式正确的电子邮箱'
                },
                number: {
                    error: '数字不符合要求'
                },
                qq: {
                    error: '请输入格式正确QQ号码'
                },
                newqq: {
                    error: '请输入格式正确QQ号码'
                },
                wechat:{
                    error: '请输入格式正确的微信号'
                },
                newwechat:{
                    error: '请输入格式正确的微信号'
                },
                Xiwupassword : {
                    error: '密码必须是8-24位字母和数字以及_的组合'
                },
                telnumber:{
                    error: '请输入格式正确的手机号码'
                },
                newtelnumber:{
                    error: '请输入格式正确的手机号码'
                },
                dota2Uid:{
                    error: '请输入格式正确的dota2数字id'
                },
                minlength: {
                    error: '位数过短'
                },
                maxlength: {
                    error: '位数过长'
                }
            };

            $validationProvider.setExpression(expression).setDefaultMsg(defaultMsg);//设定表达式和校验提示
            $validationProvider.setValidMethod('blur');//设定触发时机

        }])
}).call(this);
