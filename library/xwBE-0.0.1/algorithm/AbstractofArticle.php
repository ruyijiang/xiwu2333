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

getAbstract('<p style="white-space: normal;"><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);">豆瓣网（以下简称豆瓣）非常重视对您的个人隐私保护，有时候我们需要某些信息才能为您提供您请求的服务，本隐私声明解释了这些情况下的数据收集和使用情况</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);">　　本隐私声明适用于豆瓣的所有相关服务，随着豆瓣服务范围的扩大，隐私声明的内容可由豆瓣随时更新，且毋须另行通知。更新后的隐私声明一旦在网页上公布即有效代替原来的隐私声明。</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);"/><span class="wrap" style="display: block; color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(242, 251, 242);"></span></p><h3 style="white-space: normal; margin: 20px 0px 1px 4px; padding: 0px; font-size: 14px; font-weight: normal; font-stretch: normal; font-family: Arial, Helvetica, sans-serif; color: rgb(102, 102, 102); line-height: 1.8;">我们收集哪些信息</h3><p style="white-space: normal;"><embed type="application/x-shockwave-flash" class="edui-faked-music" pluginspage="http://www.macromedia.com/go/getflashplayer" src="http://box.baidu.com/widget/flash/bdspacesong.swf?from=tiebasongwidget&url=&name=%E5%B1%8B%E9%A1%B6&artist=%E6%B8%A9%E5%B2%9A%2C%E5%91%A8%E6%9D%B0%E4%BC%A6&extra=%E7%88%B1%E5%9B%9E%E6%B8%A9&autoPlay=false&loop=true" width="400" height="95" align="none" wmode="transparent" play="true" loop="false" menu="false" allowscriptaccess="never" allowfullscreen="true"/></p><p style="white-space: normal;"><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);">　　您能在匿名的状态下访问豆瓣并获取信息。当我们需要能识别您的个人信息或者可以与您联系的信息时，我们会征求您的同意。通常，在您注册豆瓣或申请开通新的功能时，我们可能收集这些信息：姓名，Email地址，住址和电话号码，并征求您的确认。</span><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);"/><br style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);"/><span class="wrap" style="display: block; color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(242, 251, 242);"></span></p><h3 style="margin: 20px 0px 1px 4px; padding: 0px; font-size: 14px; font-weight: normal; font-stretch: normal; font-family: Arial, Helvetica, sans-serif; color: rgb(102, 102, 102); line-height: 1.8;">关于您的个人信息</h3><p><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);">　　豆瓣严格保护您个人信息的安全。我们使用各种安全技术和程序来保护您的个人信息不被未经授权的访问、使用或泄露。</span><br style="white-space: normal; color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);">　　豆瓣会在法律要求或符合豆瓣的相关服务条款、软件许可使用协议约定的情况下透露您的个人信息，或者有充分理由相信必须这样做才能：(a) 满足法律或行政法规的明文规定，或者符合豆瓣网站适用的法律程序；（b）符合豆瓣相关服务条款、软件许可使用协议的约定；(c) 保护豆瓣的权利或财产，以及 (d) 在紧急情况下保护豆瓣员工、豆瓣产品或服务的用户或大众的个人安全。</span><br style="white-space: normal; color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);">　　豆瓣不会未经您的允许将这些信息与第三方共享，本声明已经列出的上述情况除外。</span><br style="white-space: normal; color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);"/><br style="white-space: normal; color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);"/><span class="wrap" style="display: block; color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(242, 251, 242);"><h3 style="margin: 20px 0px 1px 4px; padding: 0px; font-size: 14px; font-weight: normal; font-stretch: normal; font-family: Arial, Helvetica, sans-serif; color: rgb(102, 102, 102); line-height: 1.8;">Cookie的使用</h3></span><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);">　　使用 Cookie 能帮助您实现您的联机体验的个性化，您可以接受或拒绝 Cookie ，大多数 Web 浏览器会自动接受 Cookie，但您通常可根据自己的需要来修改浏览器的设置以拒绝 Cookie。</span><br style="white-space: normal; color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);">　　豆瓣有时会使用 Cookie 以便知道哪些网站受欢迎，使您在访问豆瓣时能得到更好的服务。Cookie不会跟踪个人信息。</span><br style="white-space: normal; color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);">　　当您注册豆瓣时，豆瓣亦会使用 Cookie。在这种情况下，豆瓣会收集并存储有用信息，当您再次访问豆瓣时，我们可辨认您的身份。来自豆瓣的 Cookie 只能被豆瓣读取。</span><br style="white-space: normal; color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);">　　如果您的浏览器被设置为拒绝 Cookie，您仍然能够访问豆瓣的大多数网页。</span><br style="white-space: normal; color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);"/><br style="white-space: normal; color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);"/><span class="wrap" style="display: block; color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(242, 251, 242);"><h3 style="margin: 20px 0px 1px 4px; padding: 0px; font-size: 14px; font-weight: normal; font-stretch: normal; font-family: Arial, Helvetica, sans-serif; color: rgb(102, 102, 102); line-height: 1.8;">关于免责说明</h3></span><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);">　　就下列相关事宜的发生，豆瓣不承担任何法律责任：</span><br style="white-space: normal; color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);">　　　* 由于您将用户密码告知他人或与他人共享注册帐户，由此导致的任何个人信息的泄露，或其他非因豆瓣原因导致的个人信息的泄露；</span><br style="white-space: normal; color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);">　　　* 豆瓣根据法律规定或政府相关政策要求提供您的个人信息；</span><br style="white-space: normal; color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);">　　　* 任何第三方根据豆瓣各服务条款及声明中所列明的情况使用您的个人信息，由此所产生的纠纷；</span><br style="white-space: normal; color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);">　　　* 任何由于黑客攻击、电脑病毒侵入或政府管制而造成的暂时性网站关闭；</span><br style="white-space: normal; color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);">　　　* 因不可抗力导致的任何后果；</span><br style="white-space: normal; color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);"/><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);">　　　* 豆瓣在各服务条款及声明中列明的使用方式或免责情形。</span></p><p><br/></p><p><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);"></span></p><span style="color: rgb(17, 17, 17); font-family: Helvetica, Arial, sans-serif; font-size: 12px; line-height: 19.44px; background-color: rgb(255, 255, 255);"><br/></span>');


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
            echo $abstract."。";
            return $abstract;
            //--------------------------------------------------------------------------------------------------------->出口2：通过关键词软指定摘要
        }else if(preg_match_all("/<h[0-5].*?>(.*?)<\/h[0-5]>/", '1234'/*$content*/, $matches)){
            foreach ($matches[1] as $key => $value){
                if(strlen($abstract) + strlen($value)<$maxlen) $abstract .= $value . " ";
            }
            $abstract = strip_tags($abstract);
            echo $abstract."。";
            return $abstract;
            //--------------------------------------------------------------------------------------------------------->出口3：根据标题标签进行提取
        }else if(preg_match_all("/.*?<[strong|em].*?>(.*?)<\/(strong|em)>/",$content, $matches)){
            foreach ($matches[1] as $key => $value){
                if(strlen($abstract) + strlen($value)<$maxlen) $abstract .= $value . " ";
            }
            $abstract = strip_tags($abstract);
            echo $abstract."。";
            return $abstract;
        }else if(preg_match_all("/.*?<[span|p|font|i].*?style=\".*?[color:|font-weight:].*?\">(.*?)<\/(span|p|font|i)>/",'1234'/*$content*/, $matches)){
            foreach ($matches[1] as $key => $value){
                if(strlen($abstract) + strlen($value)<$maxlen) $abstract .= $value . " ";
            }
            $abstract = strip_tags($abstract);
            echo $abstract."。";
            return $abstract;
            //--------------------------------------------------------------------------------------------------------->出口4：根据文字标签的颜色进行提取
        }else if(preg_match("/(如下：|如下:|如下，|首先：|首先:|首先，|最后：|最后:|最后，|然而:|然而：|然而，|不仅如此：|不仅如此:|不仅如此，|通常：|通常:|通常，)/", $tempContent,$matches)){
            print_r($matches);
            $c = strpos($tempContent,$matches[1]);
            $tempContent = substr($tempContent,$c);
            $d = strpos($tempContent,"。");
            $d>=$maxlen?$d=$maxlen:$d;
            $abstract = substr($tempContent,0,$d);
            echo $abstract."。";
            return $abstract;
            //--------------------------------------------------------------------------------------------------------->出口5：根据关键词进行提取
        }else{
            $a = strpos($tempContent,"。");
            $a>=$maxlen?$a=$maxlen:$a;
            $abstract = substr($tempContent,0,$a);
            echo $abstract."。";
            return $abstract;
            //--------------------------------------------------------------------------------------------------------->出口6：条件均不满足，则提取文章前$maxlen个字符
        }
    }
    return $abstract;
}
?>
