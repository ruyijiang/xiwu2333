
//配置路由
app.config(function ($stateProvider, $urlRouterProvider, $locationProvider) {
    $stateProvider
        .state("/", {
            url: "/main",
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
            templateUrl: "homepage.php",
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
        .state("open_setting",{
            url: "/open_setting",
            templateUrl: "open_settingpage.php"
        })
        .state("createroom",{
            url: "/createroom",
            templateUrl: "roomdetail.php"
        })


        .state("testDB",{
            url: "/testdb",
            templateUrl: "library/xwBE-0.0.1/php/signup_action.php?email=3444828174@qq.com&password=mzh_13102262280&gender=male",
            title: "新用户注册"
        })
        .state("testlogin",{
            url: "/testlogin",
            templateUrl: "library/xwBE-0.0.1/php/login_action.php?email=1444828173@qq.com&password=mzh_13102262280"
        })
        .state("createroomtest",{
            url: "/createroomtest",
            templateUrl: "library/xwBE-0.0.1/php/createroom_action.php?room_name=烧花鸭的春夏秋冬&owner_say=快点来内战&open_strategy=1&room_password=zxczxc&pw_reminder=烧鸭给群主起的中文名是什么？&server=dxsh,dxzj,dxgd,dxhz&personlimit=11&tt=under4000&winningrate=above45%&score=80&blacklist=shy,zxc,yado,aa,cit&tags=1,2,3"
        })
        .state("testuserexport",{
            url: "/testuserexport",
            templateUrl: "library/xwBE-0.0.1/php/userlist_export.php"
        })
        .state("hideroomtest",{
            url: "/hideroom_action",
            templateUrl: "library/xwBE-0.0.1/php/hideroom_action.php?rid=1"
        })
        .state("testout",{
            url: "/testlogout",
            templateUrl: "library/xwBE-0.0.1/php/logout_action.php",
        })
        .state("testdata",{
            url: "/testdata",
            templateUrl: "library/xwBE-0.0.1/php/EchartData_Export.php",
        })

        /*.state("myhomeWithPulse",{
            url: '/myhome', {params: {'data': null}}
            templateUrl: 'homepage.php',
            controller: 'homepagecontroller'
        })
        /*
        .state("myhome.pulse",{
            url: "/myhome?tab",
            templateUrl: 'homepage.php',
            resolve:{
                module: lazyModule(['/mainpage']),
            }
        })*/



        .state("404", {
            url: "/404",
            templateUrl: "404.html"
        })
        $urlRouterProvider.otherwise('/main');
        //remove # 
        //$locationProvider.html5Mode(true);
});