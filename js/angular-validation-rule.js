/**
 * Created by 马子航 on 2016/6/19.
 */
(function() {
    angular
        .module('validation.rule', ['validation'])
        .config(['$validationProvider', function($validationProvider) {
            var expression = {
                required: function(value) {
                    return !!value;
                },
                url: /((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/,
                email: /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/,
                number: /^\d+$/,
                qq:/^\d{4,11}$/,
                Xiwupassword:/\w{8,24}/,
                telnumber: /^[1][358][0-9]{9}$/,
                idcard:/^\d{17}[\d|xX]$|^\d{18}$/,
                minlength: function(value, scope, element, attrs, param) {
                    return value.length >= param;
                },
                maxlength: function(value, scope, element, attrs, param) {
                    return value.length <= param;
                }
            };

            var defaultMsg = {
                required: {
                    error: '必须填写',
                    //success: 'It\'s Required'
                },
                url: {
                    error: '链接不符合要求',
                    //success: 'It\'s Url'
                },
                email: {
                    error: '邮箱不符合要求',
                    //success: 'It\'s Email'
                },
                number: {
                    error: '数字不符合要求',
                    //success: 'It\'s Number'
                },
                qq: {
                    error: 'QQ号码不符合要求',
                    //success: 'It\'s Number'
                },
                Xiwupassword : {
                    error: '密码必须是8-24位字母和数字以及_的组合',
                    //success: 'It\'s Number'
                },
                telnumber:{
                    error: '手机号码不符合要求',
                    //success: 'It\'s Number'
                },
                minlength: {
                    error: '位数过短',
                    //success: 'Long enough!'
                },
                maxlength: {
                    error: '位数过长',
                    //success: 'Short enough!'
                }
            };
            $validationProvider.setExpression(expression).setDefaultMsg(defaultMsg);//设定表达式和校验提示
            $validationProvider.setValidMethod('blur');//设定触发时机


        }])
}).call(this);
