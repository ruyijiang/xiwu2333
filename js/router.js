
//配置路由
app.config(function ($stateProvider, $urlRouterProvider) {
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
            url: "/login/:needLogin",
            templateUrl: "loginpage.php",
            resolve:{
                guarder: function($q,$location,checkStatus,$state){
                    var allowed = checkStatus.checkLoginStatus();
                    allowed.then(function (httpCont){
                        allowed = httpCont.statuscode;
                        if(allowed=="1") $state.go("main");
                    });
                }
            }
        })
        .state("signup", {
            url: "/signup",
            templateUrl: "signuppage.php",
            resolve:{
                guarder: function($q,$location,checkStatus){
                    var allowed = checkStatus.checkLoginStatus();
                    allowed.then(function (httpCont){
                        allowed = httpCont.statuscode;
                        if(allowed=="1") $location.path("main").replace();
                    });
                }
            }
        })
        .state("blog", {
            url: "/blog",
            templateUrl: "blogpage.php",
            resolve:{
                guarder: function($location){
                    if(!$location.search()["aid"] || $location.search()["aid"]==true ||  $location.search()["aid"]=="") $location.path("/404").replace();
                }

            }
        })
        .state("writeblog", {
            url: "/writeblog",
            templateUrl: "writeblogpage.php",
            resolve:{
                guarder: function($location,checkStatus){
                    var allowed = checkStatus.checkLoginStatus();
                    allowed.then(function (httpCont){
                        allowed = httpCont.statuscode;
                        if(allowed!=="1"){
                            $location.path("/login/needLogin").replace();
                        }
                    });
                }
            }
        })
        .state("myhome", {
            url: "/myhome",
            templateUrl: "personpage.php",
            resolve:{
                guarder: function($location,checkStatus){
                    var allowed = checkStatus.checkLoginStatus();
                    allowed.then(function (httpCont){
                        allowed = httpCont.statuscode;
                        if(allowed!=="1"){
                            $location.path("/404").replace();
                        }
                    });
                }
            }
        })
        .state("info_setting", {
            url: "/info_setting",
            templateUrl: "info_settingpage.php",
            resolve:{
                guarder: function($location,checkStatus){
                    var allowed = checkStatus.checkLoginStatus();
                    allowed.then(function (httpCont){
                        allowed = httpCont.statuscode;
                        if(allowed!=="1"){
                            $location.path("/login/needLogin").replace();
                        }
                    });
                }
            }
        })
        .state("m_password",{
            url: "/m_password",
            templateUrl: "m_passwordpage.php",
            resolve:{
                guarder: function($location,checkStatus){
                    var allowed = checkStatus.checkLoginStatus();
                    allowed.then(function (httpCont){
                        allowed = httpCont.statuscode;
                        if(allowed!=="1"){
                            $location.path("/login/needLogin").replace();
                        }
                    });
                }
            }
        })
        .state("certification",{
            url: "/certification",
            templateUrl: "certification_settingpage.php",
            resolve:{
                guarder: function($location,checkStatus){
                    var allowed = checkStatus.checkLoginStatus();
                    allowed.then(function (httpCont){
                        allowed = httpCont.statuscode;
                        if(allowed!=="1"){
                            $location.path("/login/needLogin").replace();
                        }
                    });
                }
            }
        })
        .state("createroom",{
            url: "/createroom",
            templateUrl: "roomdetail.php"
        })
        .state("person",{
            url: "/person",
            templateUrl: "personpage.php",
            resolve:{
                guarder: function($location,checkStatus){
                    var allowed = checkStatus.checkLoginStatus();
                    allowed.then(function (httpCont){
                        allowed = httpCont.statuscode;
                        if(allowed!=="1" &&(!$location.search()["uid"] || $location.search()["uid"]==true)) $location.path("/404").replace();
                    });
                }
            }
        })
        .state("search",{
            url: "/search",
            templateUrl: "search.php"
        })
        .state("square",{
            url: "/square",
            templateUrl: "community.php"
        })
        .state("404", {
            url: "/404",
            templateUrl: "404.html"
        });
        $urlRouterProvider.otherwise('main');
        //remove #
        //$locationProvider.html5Mode(true);
});