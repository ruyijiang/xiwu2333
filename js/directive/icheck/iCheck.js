/**
 * Created by 马子航 on 2016/9/7.
 */

app.directive("iCheck",function() {
    return {
        restrict : 'A',
        require: 'ngModel',
        link:function (scope, elem, attr, ngModel){


            $(".topic_radio,.topic_checkbox").on('ifChanged',function(){
                console.log(ngModel.$modelValue);
                scope.$apply(function(){
                    ngModel.$setViewValue(!ngModel.$modelValue);
                });
                console.log(ngModel.$viewValue);
            });

        }
    }
});