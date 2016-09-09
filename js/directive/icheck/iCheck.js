/**
 * Created by 马子航 on 2016/9/7.
 */

app.directive("iCheck",function() {
    return {
        restrict : 'A',
        require: '?ngModel',
        scope:{
            prop:"="
        },
        link:function (scope, elem, attr, ngModel){
            //初始赋值
            $(elem).on('ifCreated ',function (){

                if(scope.prop === true || attr.value == scope.prop){
                    $(elem).iCheck('check');
                }else{
                    $(elem).iCheck('uncheck');
                }
            });

            //点击赋值
            $(elem).iCheck({

                checkboxClass: 'icheckbox_square',
                radioClass: 'iradio_square',
                increaseArea: '20%' // optional

            }).on('ifClicked',function(){

                if(attr.type == "checkbox"){
                    scope.$apply(function(){
                        ngModel.$setViewValue(!(ngModel.$modelValue == undefined ? false : ngModel.$modelValue));
                    })
                }else{
                    scope.$apply(function(){
                        ngModel.$setViewValue(attr.value);
                    })
                }

            });

        }
    }
});