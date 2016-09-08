/**
 * Created by 马子航 on 2016/9/7.
 */

app.directive("iCheck",function() {
    return {
        restrict : 'A',
        require: '?ngModel',
        link:function (scope, elem, attr, ngModel){

            scope.$watch('test1',function (newVal,oldVal){
                console.log(newVal);
                if(newVal){
                    $(elem).iCheck('check');
                }else{
                    $(elem).iCheck('uncheck');
                }
            });

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