/**
 * Created by 马子航 on 2016/5/15.
 */


function alterOnlineStatus(ToNum){
    var timing = Math.round(new Date().getTime()/1000);
    var Tonum = ToNum;
    Tonum == 1?localStorage.OnlineStatus = "1":localStorage.OnlineStatus = "0";

    $.ajax({
        type:'POST',
        async:true,
        url:'../../library/xwBE/php/closepage_updatedata.php',
        data:{"timing":timing,"mod":ToNum},
        success: function (data){
        }
    });//End of $.ajax()

}//End of alterOnlineStatus()