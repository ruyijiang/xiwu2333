/**
 * Created by 马子航 on 2016/4/15.
 */
app.controller('writeblogcontroller',function ($scope, $location){
    var ueitor = UE.getEditor('ueditor-main'); //启用UEditor


    /**
     * 如果采用AJAX方式提交表单，则在form ng-submit属性上添加此函数
     * @returns {boolean}
     */
    $scope.articlesubmit = function () {
        $("#submit_btn").button('loading');//提交时按钮disable
        //获取要提交的内容
        var a_title = $("input#a_title").val();//文章标题
        var a_content = ueitor.getContent();//文章内容
        a_cotent = htmldecode(a_content);

        if(!ueitor.hasContents()){
            $("#submit_btn").button('reset');
            alert ("还没有写文章正文");
            $("#identifier").modal("show");
            return false;
        }
        //根据标题和内容，发送请求
        $.ajax({
            url:'../../library/xwBE-0.0.1/php/writeblog_action.php',
            method:'POST',
            async: false,
            dataType: 'json',
            data:{"title":a_title,"content":a_content},
            success: function (data){
                if(data.statuscode == '0'){
                    alert (data.message);
                    $("#submit_btn").button('reset');
                    return false;
                }else if(data.statuscode !== '0'){
                    alert ("发表成功");
                    $location.url("/blog?aid="+data.statuscode).replace();
                    return true;
                    //提交成功，跳转到文章blog
                }else{
                    alert ("文章发表异常#A001，请联系管理员");
                    $("#submit_btn").button('reset');
                    return false;
                }
            },
            error: function (){
                alert ("文章发表异常#A002，请联系管理员");
                $("#submit_btn").button('reset');
                return false;
            }
        })
    };

    $("[data-toggle='tooltip']").tooltip();//开启tooltip
});