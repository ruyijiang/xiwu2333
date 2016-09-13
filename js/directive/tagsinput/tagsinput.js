/**
 * Created by mazih on 2016/9/12.
 */

app.directive("tagsinput",function() {
    return {
        restrict : 'E',
        template:'<input name="tags"/>',
        require: '?ngModel',
        scope:{
            defaultValue:"@",
            tagsData:"="
        },
        link:function(scope,elem,attr,ngModel){
            scope.tagsData = scope.defaultValue;
            $(elem).addTag(scope.defaultValue);//添加默认tag

            var NowAccount = 1;

            $(elem).tagsInput({

                onAddTag:function (){
                    var dataStr = $(elem).val();//获取当前的值

                    if(NowAccount < 5){

                        ngModel.$modelValue = scope.tagsData = dataStr;//把当前的值传递给modelValue
                        scope.$apply(function(){
                            ngModel.$setViewValue(attr.value);
                        });

                        NowAccount++;
                    }else{
                        var dataArr = dataStr.split(";");
                        dataArr.pop();
                        var newDataStr = dataArr.join(";");
                        $(elem).importTags(newDataStr);
                        alert ("最多只能关联5个关键词");
                    }

                },
                onRemoveTag:function (){
                    NowAccount--;
                }
            });
        }//End of link

    }
});