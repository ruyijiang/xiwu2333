/**
 * Created by mazih on 2016/6/23.
 */

app.factory("checkStatus",['$http','$q',function($http, $q){

    return {
        //获取用户登录状态
        checkLoginStatus : checkLoginStatus,
        LoginStatus : ""
    };



    /**
     * 获取用户登录状态
     */
    function checkLoginStatus(){

            var deferred = $q.defer();
            var timestamp=Math.round(new Date().getTime()/1000);
            var Reqdata="";

            var promise = $http({
                method: 'GET',
                url: '../../library/xwBE-0.0.1/Interface/checkStatus/check_loginstatus.php',
                params:{'timing':timestamp}
            }).success(function (data){
                deferred.resolve(data);
            }).error(function (reason){
                deferred.reject(reason);
                alert ("登陆状态检测失败，请联系管理员");
            });

            promise.then(function (httpCont){
                    Reqdata = httpCont.data.statuscode;
                    this.LoginStatus = Reqdata;
                    console.log(Reqdata);
                    return Reqdata;
                });
            }





}]);