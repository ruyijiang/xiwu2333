/**
 * Created by mazih on 2016/8/5.
 */

app.controller('testC',function (){

    var ueditor = UE.getEditor('ueditor-main'); //启用UEditor
    console.log(ueditor);

    ueditor.addListener("ready", function () {
// editor准备好之后才可以使用
        ueditor.setContent('可以了');
    });



});