<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/5/26
 * Time: 18:43
 * 用户活跃度算法类
 */
require("connectDB.php");
require("all.php");



    class liveness{
        /*分值*/
        private $sc_article = 50;//写文章。
        private $sc_openteam = 25;//开放组队。
        private $sc_shareurl = 40;//分享本网链接。
        private $sc_onlineduration = 35;//在线时长。
        private $sc_commentsomeone = 18;//评价一个人。
        private $sc_inviting = 35;//分享了本网。
        private $sc_invited = 60;//成功邀请一个人加入本网。


        /**
         * 配置liveness类属性的方法
         * @param $config : 配置key/val对象
         */
        public function liveness_config($config){
            @$this->sc_article = $config->sc_article;
            @$this->sc_openteam = $config->sc_openteam;
            @$this->sc_shareurl = $config->sc_shareurl;
            @$this->sc_onlineduration = $config->sc_onlineduration;
            @$this->sc_commentsomeone = $config->sc_commentsomeone;
            @$this->sc_inviting = $config->sc_inviting;
            @$this->sc_invited = $config->sc_invited;
        }


        /**
         * 记录某个用户今日的liveness数值
         * @param $uid : 只能是session用户自己
         * @param $commitname : 获得分数的操作的名称，如writearticle、login、comment etc,
         * @param $score : 对应这个操作，所打的分数
         */
        public function setLiveness($commitname,$score){
            $_En = new _environment();
            $uip = $_En->getIp();

            /******创建文件夹和文件******/
            $lj = preg_split('/\/{1}/',$_SERVER["PHP_SELF"]);//PHP5.3及以后的写法
            $folder = $lj[count($lj)-5];//得到根目录文件夹
            $a = "";
            if(!empty($_SESSION["uid"])){
                $a = $_SESSION["uid"];
                $tg = "/RegisteredUser/";
                $filename = $a.".txt";
                $file = $folder."../../../data/liveness".$tg.$filename;

                if(!file_exists($file)){
                    if(!file_exists(dirname($file))){//如果目录不存在
                        mkdir(dirname($file),0777);//则创建一个目录，并赋予0777模式权限
                        $cf = fopen($file,"w");//则创建一个文件，并富裕可读写权限
                        fclose($cf);
                    }else{//如果目录存在
                        $cf = fopen($file,"w");//则创建一个文件，并富裕可读写权限
                        fclose($cf);
                    }
                }
            }


            /******记录内容******/
            $pagename = preg_split('/\/{1}/',$_SERVER["PHP_SELF"]);
            $pagename = $pagename[count($pagename)-1];//Source
            $now = "20".date('y-m-d H:i:s',time());//Time
            $commit = $commitname;//Commit
            $sc = $score;//Score

            if(!$pagename || !$now){
                echo "时间和页面获取失败";
            }else{
                if(!empty($_SESSION["uid"])){
                    $a = $_SESSION["uid"];
                    $tg = "/RegisteredUser/";
                    $filename = $a.".txt";
                    $file = "../../../data/liveness".$tg.$filename;

                    $filestream = fopen($file,"a");
                    fwrite($filestream,"['Source:'".$pagename.",'Time':".$now.",'Commit:'".$commit."]{".$sc."}");
                    //[Source:abcd.php,Time:2016/05/27,Commit:writearticle]{60}
                    fclose($filestream);
                }
            }

        }//End of setLiveness function




        /**
         * 获取并输出用户某一个时段的活跃度对象
         * @param $uid : 用户uid
         * @param $timestart : 开始时间(timestamp)
         * @param $timeend : 结束时间(timestamp)
         * p.s. 如果没有$timestart和$timeend，则获取的是今天的liveness
         */
        public function getLiveness($uid,$timestart,$timeend){
            
        }//End of getLiveness function


    }

    /**
     * @param $time : 时间
     * @param $mod : 目标格式
     */
    function _altertime($time){
        //如果没有$mod，则自动转换
        $a = strpos($time, '-');
        $b = strpos($time, '.');
        if(!empty($a) || !empty($b)){
            //有-或. 则说明是iso格式时间

        }else{
            //没有-或.则说明是timestamp

        }


        //先检测iso时间的格式分隔符。如果有，则说明当前是iso时间，否则是时间戳

    }
?>
