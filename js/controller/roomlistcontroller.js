app.controller('roomlistController',function ($scope,$http,$rootScope){
    alterOnlineStatus(1);

    $rootScope.MainPageActivity = $rootScope.UserListActivity = 0;
    $rootScope.RoomListActivity = 1;

});