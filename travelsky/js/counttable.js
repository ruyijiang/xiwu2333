//javascript Document
//Edited by Ma.zihang in 2016/4/12
/*计算table列表条数*/

$(function (){
    //$.counttable在调用时直接返回数量，不用js计算,到时候删除
    $.counttable = function (TargetTable){
        var num = $(TargetTable + " tbody").find("tr").size();
        return num;
    }
    
})