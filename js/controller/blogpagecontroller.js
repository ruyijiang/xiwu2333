app.controller('blogpagecontroller',function ($scope,$rootScope,$http,$location){
    $("[data-toggle='tooltip']").tooltip();//开启tooltip

    var aaa = $location.search()["aid"];//aid根
    checkAidNexport(aid);

    /**
     *
     */
    function loadBlog(aid) {
        checkAidNexport(aid);
        !priority?priority="user":priority;
        //如果没有aid，则推荐热度最高的前5篇文章文章

        $http({
            method: 'GET',
            url: 'library/xwBE-0.0.1/php/search_action.php',
            params:{'priority':priority,'content':value}
        }).success(function (data){
            //data = welcomejsonarrstring(data);
            _dataArr = data;
        }).error(function (){
            alert ("不明原因导致的查询失败，请联系管理员");
        })
    }

    /**
     * 检查是否有aid，如果没有则进行相应操作
     */
    function checkAidNexport(aid){
        if(!aid || aid == "undefined"){//缺少关键参数

            $http({
                method: 'GET',
                url: 'library/xwBE-0.0.1/php/HotBlog_Export.php',
                params:{'priority':priority,'content':value}
            }).success(function (data){
                //data = welcomejsonarrstring(data);
                _dataArr = data;
            }).error(function (){
                alert ("不明原因导致的查询失败，请联系管理员");
            })

        }else{//有关键参数，则返回boolean
            return true;
        }
    }


});