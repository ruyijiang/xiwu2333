
app.factory("loginqq",function($http, $q){
    var AppId = "1105264899";
    var AppKey = "yfseoYphxrJGifEG";
    var TestUrl = "http://119.147.19.43";
    var FormalUrl = "openapi.tencentyun.com";//腾讯给了2个正式URL，不知道是哪一个，所以按照接口测试的进行了一次覆盖
    var FormalUrl = "https://graph.qq.com/user/get_user_info";
    var ApiDir = "/v3/user/total_vip_info";
    var OpenId = "";
    var OpenKey = "";
    var sig = "";
    var format = "json";
    var AutoGen = "oauth_consumer_key=100330589&access_token=8F213E64ADF35A84682922988F23D87E&openid=29C54E1BD044A52A961F521ADFFC50EF&format=json";
    var UserContext = {};
    return {
        getqq:getqq,
    }
    
    function getqq(SendContent/*发送内容*/){
        SendContent = AutoGen;
        //以上是试验环境，实际使用时删除，以使得参数能够传入函数
        
        var promise = $http.jsonp(FormalUrl +"?"+SendContent+"callback=JSON_CALLBACK")
        .then(function (httpCont){//httpCont和下面一个then的fn中的参数data,同是服务器拿回来的数据
            if(httpCont.statusText != "error"){
                //链接到qq服务器了
                /*UserContext = {
                    Username: httpCont.nickname,
                    UserAvatar_100px: httpCont.figureurl_qq_2,
                    UserAvatar_40px: httpCont.figureurl_qq_1 ,
                    UserGender: httpCont.gender,
                    UserProvince: httpCont.province ,
                    UserCity: httpCont.city,
                    UserBirthYear: httpCont.year,
                }//End of UserContextObj <- 这段没有什么意义了，因为打开json字段并不在qq服务里进行了*/
                return httpCont.data;
            }//End of if(){}
            else {
                //没有链接到qq服务器
                return $q.reject({
                    code:httpCont.status,
                    message:"与腾讯get_user_info链接失败"
                })
            }//End of else{}
        })//End of then()
        .then(function(data){
            var statusCode = data.ret;
            if(statusCode >= 0 && statusCoud !== "100029"){
                return data;
            }
            else {
                return $q.reject({
                    code:data.statusCode,
                    message:data.message
                })
            }//End of else{}
        })//End of then()   
        return promise;
    }//End of 自定义get()
    
})//End of factory
console.log("loginqq service is on");