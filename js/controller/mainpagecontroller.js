
app.controller('maincontroller',function ($scope,$rootScope){
    $("[data-toggle='tooltip']").tooltip();//开启tooltip
    $rootScope.LoginActivity = $rootScope.SignupAcivity = $rootScope.UserListActivity = $rootScope.RoomListActivity = 0;
    $rootScope.MainPageActivity = 1;

});