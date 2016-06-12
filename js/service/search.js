/**
 * Created by mazih on 2016/6/7.
 */
app.factory("search",['$http','$window',function($http,$window){
    var _dataArr = "";

    return {
        skipToSearch: skipToSearch,
        sendSearch:sendSearch,
        ConsequenceData:_dataArr
    };

    /**
     * 跳转至搜索页面
     * @param value
     * @param priority
     */
    function skipToSearch(value,priority){
        !priority?priority="user":priority;
        $window.location.href = "/#/search?priority=" + priority+ "&content=" + value ;
        window.location.reload();
    }

    /**
     * 发起查询、并将查询内容记录到数据库的函数
     * @param value : 要查询的内容，如：免责声明、pis等等
     * @param priority ： 优先查询的分类，如：article、user等等
     */
    function sendSearch(value,priority){
            !priority?priority="user":priority;
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

}]);
