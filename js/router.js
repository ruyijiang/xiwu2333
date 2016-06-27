
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
            //如果用户没有登陆，是不允许访问myhome路由的，需要跳转到person路由
            resolve:{
                guarder: function($location,checkStatus,$state){
                    var allowed = checkStatus.checkLoginStatus();
                    allowed.then(function (httpCont){
                        allowed = httpCont.statuscode;
                        console.log(allowed);
                        if(allowed!=="1") $location.url("/person?uid=random")
                    });
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