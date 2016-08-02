<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/8/1
 * Time: 10:46
 */
require("../../connectDB.php");
require("../../all.php");
?><?php
//header('Content-type: application/json');

@$UserDota2Id = $_POST["dota2uid"];
@$matchamount = $_POST["amount"];

$status = $reminder = "";
$a = new interfaceResponse();

$matchesMapperWeb = new Dota2Api\Mappers\MatchesMapperWeb();
$matchesMapperWeb->setAccountId($UserDota2Id);
@$matchesShortInfo = $matchesMapperWeb->load();
if($matchesShortInfo !== null){

    $KDA = 0.0;
    $mnum = 0;
    $status = 0;

    foreach ($matchesShortInfo as $key=>$matchShortInfo) {

        $matchMapper = new Dota2Api\Mappers\MatchMapperWeb($key);
        $match = $matchMapper->load();
        @$slots = $match->getAllSlots();

        foreach($slots as $slot) {

            if($slot->get('account_id') == $UserDota2Id){
                //是指定玩家
                if($slot->get('deaths')==0){
                    $KDA += ($slot->get('kills')+$slot->get('assists'))/1;
                    //$KDA = number_format(($KDA + ($slot->get('kills')+$slot->get('assists')/1))/$mnum,1)."<br>";
                }else{
                    $KDA += ($slot->get('kills')+$slot->get('assists'))/$slot->get('deaths');
                    //$KDA = number_format(($KDA + ($slot->get('kills')+$slot->get('assists')/$slot->get('deaths')))/$mnum,1)."<br>";
                }

                $status = 1;
                $mnum++;


                if($status == 0){
                    $reminder = "没有在任何一场比赛中搜索到指定数字ID的玩家信息";
                    echo $a->normalrespond($status,$reminder);
                }else if($status == 1){
                    echo "比赛ID是：".$key."</br>";
                    echo "本场比赛的KDA是：".($slot->get('kills')+$slot->get('assists'))/$slot->get('deaths')."</br>";
                    echo number_format($KDA/$mnum,1);
                }

            }

        }

    }
    echo number_format($KDA/$mnum,1);


}else{
    $status = 0;
    $reminder = "无法请求数据，参数不正确或STEAM服务器出现问题";
    echo $a->normalrespond($status,$reminder);
}