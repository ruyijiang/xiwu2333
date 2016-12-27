/**
 * Created by mazih on 2016/8/22.
 */
app.controller('communityController',function ($scope, $rootScope, $http, $q){
    
    $rootScope.navactivitify(3);
    $rootScope.NowPageTitle = "社区广场 - 喜屋";

    var timing = Math.round(new Date().getTime()/1000);
    var deferred = $q.defer();

    /**
     * 索取Covers内容
     */
    $http({
        method: 'GET',
        url: 'library/xwBE/Interface/Community/getCovers.php',
        params:{'timing':timing}
    }).success(function (){
        deferred.resolve();
    }).error(function (){
        deferred.reject();
    }).then(function (httpCont){
        $scope.Covers = httpCont.data;
    });


    /**
     * 索取HotTopics内容
     */
    $http({
        method: 'GET',
        url: 'library/xwBE/Interface/Community/getHotTopics.php',
        params:{'timing':timing}
    }).success(function (data){
        deferred.resolve(data);
    }).error(function (reason){
        deferred.reject(reason);
    }).then(function (httpCont){
        $scope.pageData_HotTopics = httpCont.data;
    });


    /**
     * 索取HotArticles内容
     */
    $http({
        method: 'GET',
        url: 'library/xwBE/Interface/Community/getHotArticles.php',
        params:{'timing':timing}
    }).success(function (data){
        deferred.resolve(data);
    }).error(function (reason){
        deferred.reject(reason);
    }).then(function (httpCont){

        $scope.pageData_HotArticles = httpCont.data;
    });


    /**
     * 索取HotPersons内容
     */
    $http({
        method: 'GET',
        url: 'library/xwBE/Interface/Community/getHotPersons.php',
        params:{'timing':timing}
    }).success(function (data){
        deferred.resolve(data);
    }).error(function (reason){
        deferred.reject(reason);
    }).then(function (httpCont){

        $scope.pageData_HotPersons = httpCont.data;

    });








});