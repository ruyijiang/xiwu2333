/**
 * Created by 马子航 on 2016/5/22.
 */

function unique(arr){
    var tmp = new Array();
    for(var m in arr){
        tmp[arr[m]]=1;
    }

    //再把键和值的位置再次调换
    var tmparr = new Array();

    for(var n in tmp){
        tmparr.push(n);
    }
    return tmparr;
}