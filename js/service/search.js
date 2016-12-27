/**
 * Created by mazih on 2016/6/7.
 */
app.factory("search",['$http','$window',function($http,$window){
    var _Data;
    return {
        skipToSearch:function (value,priority){
            !priority?priority="user":priority;
            $window.location.href = "/#/search?priority=" + priority+ "&content=" + value ;
            window.location.reload();
        },
        sendSearch:function (value,priority){
            !priority?priority="user":priority;
            $http({

                method: 'GET',
                url: 'library/xwBE/php/search_action.php',
                params:{'priority':priority,'content':value}
            }).success(function (data){
                data = welcomejsonarrstring(data);
                _Data = data;
                return data;
            }).error(function (){
                alert ("不明原因导致的查询失败，请联系管理员");
                return false;
            });
        },
        ConsequenceData:_Data
    };


}]);
