<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/5/30
 * Time: 9:43
 * 生成24位不重复随机字母和数字组合，用于当作邀请码使用
 * 使用官方推荐的生成GUID方法来生成邀请码
 */
?>
<?php
    function create_InCode($namespace = '') {
        static $guid = '';
        $uid = uniqid("", true);
        $data = $namespace;
        $data .= $_SERVER['REQUEST_TIME'];
        $data .= $_SERVER['HTTP_USER_AGENT'];
        @$data .= $_SERVER['LOCAL_ADDR'];
        @$data .= $_SERVER['LOCAL_PORT'];
        $data .= $_SERVER['REMOTE_ADDR'];
        $data .= $_SERVER['REMOTE_PORT'];
        $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
        $guid = '{' .
            substr($hash, 0, 8) .//8
            '-' .
            substr($hash, 8, 4) .//12
            '-' .
            substr($hash, 12, 4) .//16
            '-' .
            substr($hash, 16, 4) .//20
            '-' .
            substr($hash, 20, 6) .//26
            '}';
        return $guid;
    }
?>
