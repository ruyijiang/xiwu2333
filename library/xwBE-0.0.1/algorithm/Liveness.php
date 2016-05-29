<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/5/26
 * Time: 18:43
 */
require_once("../Regulars.php");
?>
<?php
$status = $reminder = "";
$uid = $_SESSION["uid"];

function countScore($commitname,$extra){
    //再对extra进行数据包拆解
    if($extra && $commitname == "onlineDuration"){
        //当存在$duration时，是为了给在线时间打分的
        if(preg_match($Regular_Duration,$extra)){
            $Dscore = (float)0.0;
            $HinD = 0;
            //先检测extra是否符合格式
            //extra : 20:25,21:60,22:5

            $arr1 = explode(",",$extra);//$arr1 = ['20:25','21:60','22:5']
            foreach ($arr1 as $xa){//$xa = '20:25' | $xa = '21:60'
                $HinD++;
                $arr2 = explode(":",$xa);//$arr2 = ['20','25']  | $arr2 = ['21','60']
                $hourD = $arr2[0];//时间段的开端
                $durationHere = (float)$arr2[1];//在此时间段内持续时间

                if($hourD == "11" || $hourD == "1"){
                    //1.2倍得分
                    $Dscore = $Dscore + $durationHere*1.2*35;
                }else if($hourD == "12" || $hourD == "0"){
                    //1.3倍得分
                    $Dscore = $Dscore + $durationHere*1.3*35;
                }else if($hourD == "19"){
                    //1.4倍得分
                    $Dscore = $Dscore + $durationHere*1.4*35;
                }else if($hourD == "20" || $hourD == "6" ){
                    //1.6倍得分
                    $Dscore = $Dscore + $durationHere*1.6*35;
                }else if($hourD == "21" || $hourD == "7"){
                    //1.8倍得分
                    $Dscore = $Dscore + $durationHere*1.8*35;
                }else if($hourD == "22" || $hourD == "23"){
                    //2倍得分
                    $Dscore = $Dscore + $durationHere*2*35;
                }
            }//END OF foreach


            //如果用户一天的在线时间分布在15个时间段，且全部在线。则我们怀疑为刷分账号，则只给45%的积分
            if($HinD>15 && $Dscore >= 31500){
                $Dscore == 31500*0.45;
            }
        }
    }

    switch ($commitname){

        case "inviteNew":
            return 60;
            break;
        case "writeBlog":
            return 50;
            break;
        case "Share":
            return 40;
            break;
        case "openTeam":
            return 25;
            break;
        case "makeComment":
            return 18;
            break;
    }

}


?>
