/**
 * Created by 马子航 on 2016/7/26.
 */

app.factory("loadAndsaveHerosInfo",['$http',function($http){
    var HerosInfo = [];


    return {
        HerosInfo : HerosInfo,
        loadAndsaveHerosInfo : loadAndsaveHerosInfo,
        loadHeroInfo : loadHeroInfo
    };

    function loadAndsaveHerosInfo(){
        $http({
            method: 'GET',
            url: 'library/xwBE-0.0.1/Interface/getDota2Info/getHerosInfo.php'
        }).success(function (data){
        }).then(function (httpCont){
            this.HerosInfo = httpCont.data;
            console.log(this.HerosInfo);
        });
    }

    function loadHeroInfo(index){
        if(HerosInfo.length>=107){
            //已经load了英雄数据
            return HerosInfo[outputHeroInfoIndex(index)];
        }else{
            //尚未load英雄数据
            this.loadAndsaveHerosInfo();
            return HerosInfo[outputHeroInfoIndex(index)];
        }
    }




    //辅助函数
    function outputHeroInfoIndex(index){
        var AffectedRows = null;
        for(var i=0;i<HerosInfo.length;i++){
            if(HerosInfo[i].id == index){
                AffectedRows = i;
            }
        }
        return AffectedRows;
    }





}]);