
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
                guarder: function($q,$location,checkStatus){
                    var allowed = checkStatus.checkLoginStatus();
                    console.log(checkStatus.LoginStatus);
                    if(allowed==1){
                        //允许访问时执行
                        //$location.path("/signup").replace();
                        //$state.go("/signup");
                        alert ("1234");
                    }else{
                        //不允许访问时执行
                        //$location.path("/blog").replace();
                        //$state.go("/blog");
                        alert ("5678");
                    }
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