/**
 * Created by mazih on 2016/9/9.
 */
app.controller('writeTopicController',function ($scope){


    /**
     * 初始化赋值
     */
    $scope.pageData = {
        customUrl:"",
        tags:""
    };


    /**
     * 复制粘贴功能
     */
    // 定义一个新的复制对象
    var clip = new ZeroClipboard( document.getElementById("d_clip_button"), {
        moviePath: "ZeroClipboard.swf"
    } );

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
    $scope.tellmemore = function (){

    };


});
