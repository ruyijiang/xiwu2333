/**
 * Created by 马子航 on 2016/7/26.
 */

app.factory("loadAndsaveHerosInfo",['$http','$q',function($http,$q){
    var HerosInfo = [];
    var deferred = $q.defer();

    return {
        HerosInfo : HerosInfo,
        loadAndsaveHerosInfo : loadAndsaveHerosInfo
    };

    function loadAndsaveHerosInfo(){
        $http({
            method: 'GET',
            url: 'library/xwBE/Interface/getDota2Info/getHerosInfo.php'
        }).success(function (data){
            deferred.resolve(data);
        }).error(function (reason){
            deferred.resolve(reason);
        });

        return deferred.promise;
    }

}]);