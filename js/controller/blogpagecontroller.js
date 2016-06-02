app.controller('blogpagecontroller',function ($scope,$rootScope,$http){
    $("[data-toggle='tooltip']").tooltip();//开启tooltip

    $scope.tellmemore = function () {
        $.ajax({
            async:false,
            data:{},
            url:'library/xwBE-0.0.1/algorithm/AbstractofArticle.php',
            success:function (data) {
                alert (data);
            }
        })
    }
    
});