/**
 * Created by mazih on 2016/9/9.
 */
app.controller('writeTopicController',function ($scope, $http, $q, $timeout, $location){


    /**
     * 初始化赋值
     */
    $scope.pageData = {
        customUrl:"",
        topic_title:"",
        topic_desc:"",
        topic_cate:1,
        topic_tags:"Dota2",
        topic_classification:"radio",
        topic_choices:[
            {
                "content":""
            },
            {
                "content":""
            }
        ]
    };


    /**
     * 复制粘贴功能
     */
    // 定义一个新的复制对象
    var clip = new ZeroClipboard( document.getElementById("d_clip_button"), {
        moviePath: "ZeroClipboard.swf"
    } );


    var ChoicesAmount = 2;
    /**
     * 添加选项
     */
    $scope.addChoice = function (){
        if(ChoicesAmount==8){
            alert ("上限为8条选项，您已不能再添加");
            return false;
        }else{
            var aTemp = {"content":""};
            $scope.pageData.topic_choices.push(aTemp);
            ChoicesAmount++;
        }
    };


    /**
     * 删除对应选项功能
     */
    $scope.removeThisChoice = function (index){
        if(ChoicesAmount==2){
            alert ("至少需要设置2个选项");
            return false;
        }else{
            $scope.pageData.topic_choices.splice(index,1);
            ChoicesAmount--;
        }
    };


    // 复制内容到剪贴板成功后的操作
    clip.on( 'complete', function(client, args) {
        alert("成功复制到剪切板，您可以直接粘贴");
    });

    clip.on( 'error', function() {
        ZeroClipboard.destroy();
        alert("不明原因导致的URL链接复制失败，请联系管理员");
    } );


    /**
     * 提交本页数据
     */
    $scope.saveData = function (){

        if(!$scope.needSelect){
            $scope.pageData.topic_choices = [{"content":""},{"content":""}];
            $scope.pageData.topic_classification = "text";
        }

        if($scope.urlReminder == 0){
            alert ("自定义链接不可使用，请重新填写");
        }else{
            $.ajax({
                url:'../../library/xwBE/Interface/setTopic/setTopic.php',
                type:'POST',
                async:false,
                data: $scope.pageData,
                success: function (data){
                    var _data = eval("(" + data + ")");
                    if(_data.statuscode !== "0"){
                        $location.url("/topic/"+_data.statuscode).replace();
                    }
                }
            })
        }
    };

    $scope.urlReminder = 2;
    $("#customUrl").blur(function (){
        if($scope.pageData.customUrl){
            checkUrl();
        }else if($scope.pageData.customUrl == ""){
            $timeout(function (){
                $scope.urlReminder = 2;
            },0);
        }
    });
    
    function checkUrl() {
        $http({
            method: 'GET',
            url: '../../library/xwBE/Interface/setTopic/checkUrl.php',
            params:{'content': $scope.pageData.customUrl }
        }).success(function (httpCont) {
            if(httpCont.statuscode == 1){
                $scope.urlReminder = 1;
            }else{
                $scope.urlReminder = 0;
            }
        });
    }

    $scope.needSelect = false;

});
