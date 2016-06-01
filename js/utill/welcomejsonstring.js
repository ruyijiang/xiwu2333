/**
 * Created by mazih on 2016/5/10.
 */

/**
 * 专门用来解析interface接口传入的json字符串
 * @param data接受的json字符串
 */
function welcomejsonstring(data,returndata){
    returndata?returndata:0;
    data = eval( "(" + data + ")");
    var status = data.statuscode;
    var message = data.message;
    if(status == '1'){
        //alert ("success");
        status = true;
    }else if(status == '0'){
        alert (message);
        status = false;
    }else if(status == '3'){
        //只在检测用户是否登陆时使用
    }else{
        alert ("错误代码：300.未知系统错误，请联系管理员");
        status = false;
    }
    if(returndata == "message"){
        return message;
    }else{
        return status;
    }
}

/**
 * 专门用来解析interface接口传入的类json对象数组字符串
 * @param data接受的json对象数组
 */
function welcomejsonarrstring(data){
    data = "[" + data + "]";
    data = eval("("+data+")");
    return data;
}
