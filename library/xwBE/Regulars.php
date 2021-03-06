<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/5/20
 * Time: 16:06
 */
?>
<?php
$Regular_Phone = "/^[1][3578][0-9]{9}$/";//匹配手机号，格式：{13xxxxxxxxx | 15xxxxxxxxx | 18xxxxxxxxx | 17xxxxxxxxx}
$Regular_Tel = "/^0\d{3}-\d{7}$|^0\d{3}\d{7}$|^0\d{2}-\d{8}$|^0\d{2}\d{8}$/";//匹配国内固话，格式：{123-12345678 | 1234-1234567 | 123412345678 | 12341234567}
$Regular_Email = "/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/";//匹配电子邮箱，格式：{x[.x]@x[.xx].x}
$Regular_Time = "/^(\d{1,2}:\d{1,2}){1,2}$/";//匹配时间，格式：{H:i:s | H:i | i:s}
$Regular_Date = "/^\d{4}-0\d{1}-[012]{1}\d{1}|[12]\d{3}-0\d{1}-3[0-1]{1}|[12]\d{3}-1[0-2]{1}-[012]{1}\d{1}|[12]\d{3}-1[0-2]{1}-3[0-1]{1}$/";//匹配日期，格式：{xxxx-xx-xx}
$Regular_QQ = "/^[1]\d{4,11}$/";//匹配qq号，格式：{从10000开始的5到12位数字}
$Regular_Url = "/^(http|https)+://[\S]*([.]\S)+/";//匹配url，格式：{http | https://定位符}
$Regular_Idcard = "/^\d{17}[\d|xX]$|^\d{18}$/";//匹配身份证号，格式：{15或18位 | 15位数字、17位数字加数字、17位数字加x|X}

/**适配性验证**/
$Regular_Chinese = "/[\u4e00-\u9fa5]/";//匹配中文
$Regular_Password = "/^\w{6,24}$/";//匹配密码，格式：{6-24位 | 数字、英文、下划线}
$Regular_Htmltag = "/<(\S*?)[^>]*>.*?</>|<.*? />/";//匹配html标签
$Regular_Duration = "/[0-2]\d:[0-6]\d/";//匹配活跃度算法所接受的在线时间的数据报
$Regular_Html = "//";//匹配html标签
$Regular_LetterTagWithColor = "/.*?<[span|p|font|i|] .*?href=\"(.*?)\" .*? style=\".*?\">.*?/";//匹配带颜色的文字表义html标签





?>
