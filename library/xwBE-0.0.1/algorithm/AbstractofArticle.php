<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/6/2
 * Time: 16:14
 */
?>
<?php
$status = $reminder = "";
@$uid = $_SESSION["uid"];

@$content = $_POST["content"];

/**
 * 提取文章摘要
 * @param $content : 需要被提取的文章正文
 * @param string $configuration ： 指定好的摘要
 * @return string ： 返回提取结果
 */
function getAbstract($content,$configuration=''){
    $abstract = "";//目标位置
    $tempContent = "";//临时正文
    $maxlen = 400;//摘要最长长度

    if($configuration){//指定了摘要信息
        //------------------------------------------------------------------------------------------------------------->出口1：硬指定摘要
        return $abstract = $configuration;
    }else{//没有指定，则进入算法
        $tempContent = strip_tags($content);
        if (preg_match("/(摘要:|摘要：|概要:|概要：|概览:|概览：|序言:|序言：|序:|序：|abstract:)/", $tempContent)) {
            $tempContentArr = preg_split("/(摘要:|摘要：|概要:|概要：|概览:|概览：|序言:|序言：|序:|序：|abstract:)/", $tempContent, 2);
            echo ($tempContentArr[1]);
            $a = strpos($tempContentArr[1],"。");
            $a>=$maxlen?$a=$maxlen:$a;
            $abstract = substr($tempContentArr[1],0,$a);
            return $abstract;
            //--------------------------------------------------------------------------------------------------------->出口2：通过关键词软指定摘要
        }else if(preg_match_all("/<h[0-5].*?>(.*?)<\/h[0-5]>/", $content, $matches)){
            return abc($matches[1],$abstract,$maxlen);
            //--------------------------------------------------------------------------------------------------------->出口3：根据标题标签进行提取
        }else if(preg_match_all("/.*?<[strong|em].*?>(.*?)<\/(strong|em)>/",$content, $matches)){
            return abc($matches[1],$abstract,$maxlen);
            //--------------------------------------------------------------------------------------------------------->出口4：根据特殊文字标签进行提取
        }else if(preg_match_all("/.*?<[span|p|font|i].*?style=\".*?[color:|font-weight:].*?\">(.*?)<\/(span|p|font|i)>/",$content, $matches)){
            return abc($matches[1],$abstract,$maxlen);
            /*foreach ($matches[1] as $key => $value){
                if(strlen($abstract) + strlen($value)<$maxlen) $abstract .= $value . " ";
            }
            $abstract = strip_tags($abstract);
            return $abstract;*/
            //--------------------------------------------------------------------------------------------------------->出口5：根据一般文字标签的颜色进行提取
        }else if(preg_match("/(如下：|如下:|如下，|首先：|首先:|首先，|最后：|最后:|最后，|然而:|然而：|然而，|不仅如此：|不仅如此:|不仅如此，|通常：|通常:|通常，)/", $tempContent,$matches)){
            print_r($matches);
            $c = strpos($tempContent,$matches[1]);
            $tempContent = substr($tempContent,$c);
            $d = strpos($tempContent,"。");
            $d>=$maxlen?$d=$maxlen:$d;
            $abstract = substr($tempContent,0,$d);
            echo $abstract;
            return $abstract;
            //--------------------------------------------------------------------------------------------------------->出口6：根据关键词进行提取
        }else{
            $d = strpos($tempContent,"。");
            $e = strpos($tempContent,"\n") -4;
            if($d+$e>=$maxlen){
                $d>$e?$min = $e:$min = $d;
                $abstract .= substr($tempContent,0,$min);
            }else{
                $abstract .= substr($tempContent,0,$d);
                $abstract .= substr($tempContent,0,$e);
            }
            return $abstract;
            //--------------------------------------------------------------------------------------------------------->出口7：条件均不满足，则提取文章前$maxlen个字符
        }
    }
}


?>

<?php
//抽象的重复函数
function abc($Source,$Target,$maxlen){
    foreach ($Source as $key => $value){
        if(strlen($Target) + strlen($value)<$maxlen) $Target .= $value . " ";
    }
    $Target = strip_tags($Target);
    return $Target;
}
?>
