/**
 * Created by mazih on 2016/9/12.
 */

app.directive("tagsinput",function() {
    return {
        restrict : 'E',
        template:'<input name="tags"/>',
        require: '?ngModel',
        scope:{
            tagsData:"="
        },
        link:function(scope,elem,attr,ngModel){
            if(scope.tagsData){
                $(elem).addTag(scope.tagsData);//添加默认tag
            }

            var dataStr = $(elem).val();//获取当前的值
            var temArr = dataStr.split(";");
            var NowAccount = temArr.length;

            $(elem).tagsInput({

                onAddTag:function (){

                    if(NowAccount < 5){

                        var dataStr2 = $(elem).val();//获取当前的值
                        ngModel.$modelValue = scope.tagsData = dataStr2;//把当前的值传递给modelValue
                        scope.$apply(function(){
                            ngModel.$setViewValue(attr.value);
                        });

                        NowAccount++;

                    }else{

                        var dataStr2 = $(elem).val();//获取当前的值
                        var dataArr = dataStr2.split(";");
                        dataArr.pop();
                        var newDataStr = dataArr.join(";");
                        $(elem).importTags(newDataStr);
                        alert ("最多只能关联5个关键词");

                    }

                },
                onRemoveTag:function (){
                    
                    var dataStr3 = $(elem).val();//获取当前的值
                    ngModel.$modelValue = scope.tagsData = dataStr3;//把当前的值传递给modelValue
                    scope.$apply(function(){
                        ngModel.$setViewValue(attr.value);
                    });

                    NowAccount--;
                }
            });
        }//End of link

    }
});