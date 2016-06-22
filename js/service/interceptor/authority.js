/**
 * Created by mazih on 2016/6/20.
 */

/**
 * 配置authority所对应的，config事件
 */
app.config(function ($httpProvider){
    var interceptor = function ($q,$rootScope,Auth){
        return {
            'request' : function (req){
                req.params = req.params || {};
                if(Session.isAuthenticated() && !req.params.token){
                    req.params.token = Auth.getToken();
                }
                return req;
            },
            'response':function (resp){
                if(resp.config.url == 'api/login'){
                    Auth.setToken(resp.data.token);
                }
                return resp;
            },
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