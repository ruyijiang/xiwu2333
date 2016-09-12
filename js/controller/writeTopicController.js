/**
 * Created by mazih on 2016/9/9.
 */
app.controller('writeTopicController',function ($scope){

    $scope.pageData = {
        customUrl:"",
        tags:""
    };


    $scope.tellmemore = function (){
        console.log($scope.pageData.tags);
    };












});
