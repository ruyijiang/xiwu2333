<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/5/26
 * Time: 18:43
 */
?>
<?php
$status = $reminder = "";
@$uid = $_SESSION["uid"];

//计算活跃度分数
function countScore($commitname,$extra){
    //再对extra进行数据包拆解
    if($extra && $commitname == "onlineDuration"){//******************************************************onlineDuration
        //当存在$duration时，是为了给在线时间打分的
        $Dscore = (float)0.00;

        for ($i=0;$i<count($extra);$i++){//$xa = '20:25' | $xa = '21:60'
            $hourD = $i;//时间段的开端
            $durationHere = $extra[$i];
            if($hourD == 11 || $hourD == 1){
                //1.2倍得分
                $Dscore = $Dscore + $durationHere*1.2*35;
            }else if($hourD == 12 || $hourD == 0){
                //1.3倍得分
                $Dscore = $Dscore + $durationHere*1.3*35;
            }else if($hourD == 19){
                //1.4倍得分
                $Dscore = $Dscore + $durationHere*1.4*35;
            }else if($hourD == 20 || $hourD == 6){
                //1.6倍得分
                $Dscore = $Dscore + $durationHere*1.6*35;
            }else if($hourD == 21 || $hourD == 7){
                //1.8倍得分
                $Dscore = $Dscore + $durationHere*1.8*35;
            }else if($hourD == 22 || $hourD == 23){
                //2倍得分
                $Dscore = $Dscore + $durationHere*2*35;
            }else{
                $Dscore += $durationHere*1*35;
            }
        }//END OF foreach
        return $Dscore;
    }

    switch ($commitname){

        case "inviteNew":
            //成功一个分数，失败一个分数
            return 4725;
            break;
        case "writeBlog":
            //根据字数和关键词算分
            return 50;
            break;
        case "Share":
            return 40;
            break;
        case "openTeam":
            //递减函数
            return 25;
            break;
        case "makeComment":
            //根据字数算分
            return 18;
            break;
    }

}


?>
