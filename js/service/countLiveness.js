/**
 * Created by 马子航 on 2016/5/30.
 */

app.factory("liveness",['$http','$interval',function($http,$interval,$timeout){
    var LivenessScoreArr = [];


    return {
        countLivenessInTimer : countLivenessInTimer,
        sendLivenessOnUnload : sendLivenessOnUnload,
        LivenessScoreArr : LivenessScoreArr
    };

    function countLivenessInTimer(){
        console.log("i am in factory liveness,if you success,delete me..");
        /*if(isIE()){
            //为ie浏览器准备的定时传送数据
            var timer_forIe = $interval(function (){},5*60*1000);
            timer_forIe.then(function (){
                alert ("i love IE");
                var promise = $http.post();
                promise.success(function (){

                });
            });
        }else{*/
            //为ie浏览器之外浏览器准备的
            var Duration = 0;
            var timer = $interval(function (){
                Duration += 2;
                var ClientDatetime = new Date();
                var ClientHour = ClientDatetime.getHours();//小时数0-23
                var ClientMin = ClientDatetime.getMinutes();

                if(ClientHour == 23 && (ClientMin == 58 || ClientMin == 59)){
                    this.sendLivenessOnUnload();
                    LivenessScoreArr = [];
                }else{
                    LivenessScoreArr[ClientHour] = Duration;
                }

                console.log(LivenessScoreArr);
                sendLivenessOnUnload();
            },5000);

        //}
    }



    function sendLivenessOnUnload(){
        //上传数据到服务器
        $.ajax({
            method:'POST',
            url:'library/xwBE-0.0.1/php/setScore_action.php',
            data:{'commitname':'onlineDuration','extra':LivenessScoreArr}
        });
        console.log("send to setScore_action");
    }




    //工具函数
    function isIE(){
        if(!!window.ActiveXObject || "ActiveXObject" in window)
            return true;
        else
            return false;
    }
}]);