/**
 * Created by mazih on 2016/6/20.
 */
app.config(function ($httpProvider){
    var interceptor = function ($q,$rootScope,Auth){
        return {
            'response':function (resp){
                if(resp.config.url == 'api/login'){
                    Auth.setToken(resp.data.token);
                }
            },//End of response
            'responseError':function (rejection){
                switch(rejection.status){
                    case 401:
                        if(rejection.config.url !== 'api/login'){
                            $rootScope.$broadcast('auth:loginRequired');
                        }
                        break;
                    case 403:
                        $rootScope.$broadcast('auth:forbidden');
                        break;
                    case 404:
                        $rootScope.$broadcast('auth:notFound');
                        break;
                    case 500:
                        $rootScope.$broadcast('server:error');
                        break;
                }
                return $q.reject(rejection);
            }
        };//End of return
    };//End of interceptor function

    $httpProvider.interceptors.push(interceptor);
});