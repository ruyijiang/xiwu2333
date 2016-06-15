app.controller('blogpagecontroller',function ($scope,$rootScope,$http,$location){
    var A_aid = $location.search()["aid"];//aid根
    $scope.BlogExport;

    /**
     * 根据aid对文章进行读取，并且把文章操作的权限和功能进行输出
     */
    function loadBlog(aid) {
        var data;
        if(data = checkAidNexport(aid) === true){

            $http({
                method: 'GET',
                url: 'library/xwBE-0.0.1/php/blogpage_export.php',
                params:{'aid':aid}
            }).success(function (data){
                $scope.BlogExport = data;
                console.log($scope.BlogExport);
            }).error(function (){
                alert ("不明原因导致的查询失败，请联系管理员");
            });

        }else{
            alert (data);
        }
    }

    /**
     * 检查是否有aid，没有aid，则推荐热度最高的前5篇文章文章
     */
    function checkAidNexport(aid){
        if(!aid || aid == "undefined"){//缺少关键参数
            var timing = Math.round(new Date().getTime());

            $http({
                method: 'GET',
                url: 'library/xwBE-0.0.1/php/HotBlog_Export.php',
                params:{'timing':timing}
            }).success(function (data){
                //data = welcomejsonarrstring(data);
                return data;
            }).error(function (){
                alert ("系统检测参数失败，请联系管理员");
            })

        }else{//有关键参数，则返回boolean
            return true;
        }
    }


    loadBlog(A_aid);
    $("[data-toggle='tooltip']").tooltip();//开启tooltip


});