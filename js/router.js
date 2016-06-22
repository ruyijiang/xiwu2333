
//配置路由
app.config(function ($stateProvider, $urlRouterProvider, $locationProvider) {
    $stateProvider
        .state("/", {
            url: "/",
            templateUrl: "mainpage.php"
        })
        .state("main", {
            url: "/main",
            templateUrl: "mainpage.php"
        })
        .state("roomlist", {
            url: "/roomlist",
            templateUrl: "roomlistpage.php"
        })
        .state("userlist", {
            url: "/userlist",
            templateUrl: "userlistpage.php"
        })
        .state("login", {
            url: "/login",
            templateUrl: "loginpage.php"
        })
        .state("signup", {
            url: "/signup",
            templateUrl: "signuppage.php"
        })
        .state("blog", {
            url: "/blog",
            templateUrl: "blogpage.php"
        })
        .state("writeblog", {
            url: "/writeblog",
            templateUrl: "writeblogpage.php"
        })
        .state("myhome", {
            url: "/myhome",
            templateUrl: "personpage.php",
            resolve:{
                guarder: function($q,$http,$location){
                    var allowed = false;
                    var deferred = $q.defer();
                    //权限判断逻辑
                    //if(1==1) allowed = true;

                    if(allowed){
                        //允许访问时执行
                        deferred.resolve();
                        $location.path("/signup").replace();
                    }else{
                        //不允许访问时执行
                        deferred.reject();
                        $location.path("/blog").replace();
                    }
                    return deferred.promise;
                }
            }
        })
        .state("myhomeWithPulse",{
            params: {'tab': null},
            url: "/myhome",
            templateUrl: "homepage.php?tab=pulse"
        })
        .state("myhomeWithArticle",{
            params: {'tab': null},
            url: "/myhome",
            templateUrl: "homepage.php?tab=article"
        })
        .state("myhomeWithAssess",{
            params: {'tab': null},
            url: "/myhome",
            templateUrl: "homepage.php?tab=assess"
        })
        .state("info_setting", {
            url: "/info_setting",
            templateUrl: "info_settingpage.php"
        })
        .state("m_password",{
            url: "/m_password",
            templateUrl: "m_passwordpage.php"
        })
        .state("certification",{
            url: "/certification",
            templateUrl: "certification_settingpage.php"
        })
        .state("createroom",{
            url: "/createroom",
            templateUrl: "roomdetail.php"
        })
        .state("person",{
            url: "/person",
            templateUrl: "personpage.php"
        })
        .state("search",{
            url: "/search",
            templateUrl: "search.php"
        })
        .state("404", {
            url: "/404",
            templateUrl: "404.html"
        })
        $urlRouterProvider.otherwise('/404');
        //remove #
        //$locationProvider.html5Mode(true);
});