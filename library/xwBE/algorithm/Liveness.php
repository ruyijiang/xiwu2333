<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/5/26
 * Time: 18:43
 */
?>
<?php
@$uid = $_SESSION["uid"];

//计算活跃度分数
function countScore($commitname,$extra=''){
    //再对extra进行数据包拆解
    $FinalScore = (float)0.00;

    if($extra && $commitname == "onlineDuration"){//******************************************************onlineDuration
        //当存在$duration时，是为了给在线时间打分的
        //extra在这里的内容，是时间组成的数组

        $Dscore = (float)0.00;//Dscore means "Duration score"

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

        $FinalScore += $Dscore;
    }


    if($extra && $commitname == "writeBlog"){
        //为了给写文章打分的
        //extra在这里的内容，是文章的字符串长度
        $Blscore = (float)0.00;//Bscore means "Blog score"

        if($extra>20 && $extra<=100){
            $Blscore += 2025;//15min * 35 + 1500创意分
        }else if($extra>100 && $extra<=200){
            $Blscore += 2300;//20min * 35 + 1600创意分
        }else if($extra>200 && $extra<=300){
            $Blscore += 2700;//25min * 40 + 1700创意分
        }else if($extra>300 && $extra<=400){
            $Blscore += 3190;//30min * 43 + 1900创意分
        }else if($extra>400 && $extra<=800){
            $Blscore += 3940;//40min * 46 + 2100创意分
        }else if($extra>800 && $extra<=2000){
            $Blscore += 3750;//50min * 35 + 2000创意分
        }else if($extra>2000){
            $Blscore += 2940;//60min * 24 + 1500创意分
        }else{
            $Blscore += 0;//文章长度在1-20，不给分。
        }

        $FinalScore += $Blscore;

    }


    if($commitname == "openTeam"){
        //为了给开放组队打分的
        //这里之所以没有用到$extra，是因为这里仅有一个浮动维度，就是时间段，这里在后端取值，不需要前段发送过来。而开放组队是每次开放，都实时向数据库添加活跃度。
        $Otscore = (float)0.00;//Otscore means "Open team score"

        $tnow = date("H");
        $tnow = (int)$tnow;

        if($tnow>=9 && $tnow<12){
            $Otscore += 285;
        }else if($tnow>=14 && $tnow<17){
            $Otscore += 265;
        }else if($tnow>=19 && $tnow<24){
            $Otscore += 190;
        }else{
            $Otscore += 250;
        }

        $FinalScore += $Otscore;

    }


    if($commitname == "setTopic"){
        //为了给开放组队打分的
        //这里之所以没有用到$extra，是因为这里仅有一个浮动维度，就是时间段，这里在后端取值，不需要前段发送过来。而开放组队是每次开放，都实时向数据库添加活跃度。
        $Tscore = (float)0.00;//Otscore means "Topic score"
        $Tscore += 3400;
        $FinalScore += $Tscore;

    }


    switch ($commitname){

        case "inviteNew":
            //成功一个分数，失败一个分数
            $FinalScore += 4725;
            break;
        case "Share":
            $FinalScore += 40;
            break;
        case "makeComment":
            //根据字数算分
            $FinalScore += 18;
            break;
    }


    return $FinalScore;

}


?>
