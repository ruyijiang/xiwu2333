/**
 * Created by mazih on 2016/8/22.
 */
app.controller('communityController',function ($scope, $rootScope, $http, $q){
    $rootScope.navactivitify(3);
    var timing = Math.round(new Date().getTime()/1000);
    var deferred = $q.defer();

    //返回头部方法
    $scope.backtotop = function (){

    };

    $http({
        method: 'GET',
        url: 'library/xwBE-0.0.1/php/HotSearching_Export.php',
        params:{'timing':timing}
    }).success(function (data){
        deferred.resolve(data);
    }).error(function (reason){
        deferred.reject(reason);
    }).then(function (httpCont){

        $scope.HotSearchingContent = httpCont.data.content

    });














});