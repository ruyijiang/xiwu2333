<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/5/8
 * Time: 22:10
 */
require("../connectDB.php");
require("../all.php");
?>
<?php
//流程:
    @$con = $_GET["content"];
    @$pri = $_GET["priority"];
    @$sta = $_GET["startnum"];

    $status = $reminder = "";
    $a = new interfaceResponse();


    if($pri!=='competition'&&$pri!=='article') $pri='user';//当priority不是三者之一的时候，默认为user

    if($con){


        if($pri == "user"){
            //查询用户

            $sql_user = "SELECT * FROM users WHERE uid = '$con' LIMIT $sta,15  ";
            $qry = $db->query($sql_user);
            @$row_all = mysqli_num_rows($qry);//总条数
            $affected_rows_num = 0;
            if($row_all>0){

                while ($row = $qry->fetch_assoc()){
                    $username = $row["name"];
                    $slogan = $row["slogan"];
                    $gender = $row["gender"];
                    $province = $row["province"];
                    $city = $row["city"];
                    $uid = $row["uid"];
                    $score = $row["score"];
                    $sql3 = "SELECT content FROM callingcard WHERE uid = '$uid'";
                    $qry3 = $db->query($sql3);
                    $row3 = $qry3->fetch_assoc();
                    $result_callingcard = $row3["content"];

                    $dataArr = array ('name'=>$username,'callingcardname'=>$result_callingcard,'slogan'=>$slogan,'gender'=>$gender,'province'=>$province,'city'=>$city,'uid'=>$uid,'score'=>$score);

                    foreach ( $dataArr as $key => $value ) {
                        $dataArr[$key] = urlencode ($value);
                    }

                    $dataArr = urldecode ( json_encode ( $dataArr )).",";
                    echo $dataArr;
                    insertIntoDatabase('搜索用户',$con,1);
                    $affected_rows_num++;
                }
                echo "{\"row_num\":".$affected_rows_num."}";
                //----------------------------------------------------------------------------------------------------->出口1：搜索的是用户，且通过uid
            }else{
                $sql = "SELECT * FROM users WHERE name = '$con' LIMIT $sta,15  ";
                $qry = $db->query($sql);
                @$row_all = mysqli_num_rows($qry);//总条数
                $affected_rows_num = 0;
                if($row_all>0){
                    while ($row = $qry->fetch_assoc()){
                        $username = $row["name"];
                        $slogan = $row["slogan"];
                        $gender = $row["gender"];
                        $province = $row["province"];
                        $city = $row["city"];
                        $uid = $row["uid"];
                        $score = $row["score"];
                        $sql3 = "SELECT content FROM callingcard WHERE  uid = '$uid'";
                        $qry3 = $db->query($sql3);
                        $row3 = $qry3->fetch_assoc();
                        $result_callingcard = $row3["content"];

                        $dataArr = array ('name'=>$username,'callingcardname'=>$result_callingcard,'slogan'=>$slogan,'gender'=>$gender,'province'=>$province,'city'=>$city,'uid'=>$uid,'score'=>$score);

                        foreach ( $dataArr as $key => $value ) {
                            $dataArr[$key] = urlencode ($value);
                        }

                        $dataArr = urldecode ( json_encode ( $dataArr )).",";
                        echo $dataArr;
                        insertIntoDatabase('搜索用户',$con,1);
                        $affected_rows_num++;
                    }
                    echo "{\"row_num\":".$affected_rows_num."}";
                    //------------------------------------------------------------------------------------------------->出口2：搜索的是用户，且通过name
                }else{
                    $sql = "select * from users where name like '%$con%' LIMIT $sta,15 ";
                    $qry = $db->query($sql);
                    @$row_all = mysqli_num_rows($qry);//总条数
                    $affected_rows_num = 0;
                    if($row_all>0){
                        while ($row = $qry->fetch_assoc()){
                            $username = $row["name"];
                            $slogan = $row["slogan"];
                            $gender = $row["gender"];
                            $province = $row["province"];
                            $city = $row["city"];
                            $uid = $row["uid"];
                            $score = $row["score"];
                            $sql3 = "SELECT content FROM callingcard WHERE uid = '$uid'";
                            $qry3 = $db->query($sql3);
                            $row3 = $qry3->fetch_assoc();
                            $result_callingcard = $row3["content"];

                            $dataArr = array ('name'=>$username,'callingcardname'=>$result_callingcard,'slogan'=>$slogan,'gender'=>$gender,'province'=>$province,'city'=>$city,'uid'=>$uid,'score'=>$score);

                            foreach ( $dataArr as $key => $value ) {
                                $dataArr[$key] = urlencode ($value);
                            }

                            $dataArr = urldecode ( json_encode ( $dataArr )).",";
                            echo $dataArr;
                            insertIntoDatabase('搜索用户',$con,1);
                            $affected_rows_num++;
                        }
                        echo "{\"row_num\":".$affected_rows_num."}";
                        //--------------------------------------------------------------------------------------------->出口3：是在通过name搜索用户名，但是模糊搜索
                    }else{
                        $sql = "select * from users where slogan = '$con' LIMIT $sta,15 ";
                        $qry = $db->query($sql);
                        @$row_all = mysqli_num_rows($qry);//总条数
                        $affected_rows_num = 0;
                        if($row_all>0){
                            while ($row = $qry->fetch_assoc()) {
                                $username = $row["name"];
                                $slogan = $row["slogan"];
                                $gender = $row["gender"];
                                $province = $row["province"];
                                $city = $row["city"];
                                $uid = $row["uid"];
                                $score = $row["score"];
                                $sql3 = "SELECT content FROM callingcard WHERE uid = '$uid' ";
                                $qry3 = $db->query($sql3);
                                $row3 = $qry3->fetch_assoc();
                                $result_callingcard = $row3["content"];

                                $dataArr = array('name' => $username,'callingcardname'=>$result_callingcard, 'slogan' => $slogan, 'gender' => $gender, 'province' => $province, 'city' => $city, 'uid' => $uid, 'score' => $score);

                                foreach ($dataArr as $key => $value) {
                                    $dataArr[$key] = urlencode($value);
                                }

                                $dataArr = urldecode(json_encode($dataArr)).",";
                                echo $dataArr;
                                insertIntoDatabase('搜索用户',$con,1);
                                $affected_rows_num++;
                            }
                            echo "{\"row_num\":".$affected_rows_num."}";
                            //----------------------------------------------------------------------------------------->出口4：是在通过slogan搜索用户名
                        }else{
                            $sql = "select * from users where slogan like '%$con%' LIMIT $sta,15 ";
                            $qry = $db->query($sql);
                            @$row_all = mysqli_num_rows($qry);//总条数
                            $affected_rows_num = 0;
                            if($row_all>0){
                                while ($row = $qry->fetch_assoc()){
                                    $username = $row["name"];
                                    $slogan = $row["slogan"];
                                    $gender = $row["gender"];
                                    $province = $row["province"];
                                    $city = $row["city"];
                                    $uid = $row["uid"];
                                    $score = $row["score"];
                                    $sql3 = "SELECT content FROM callingcard WHERE  uid = '$uid' ";
                                    $qry3 = $db->query($sql3);
                                    $row3 = $qry3->fetch_assoc();
                                    $result_callingcard = $row3["content"];

                                    $dataArr = array ('name'=>$username,'callingcardname'=>$result_callingcard,'slogan'=>$slogan,'gender'=>$gender,'province'=>$province,'city'=>$city,'uid'=>$uid,'score'=>$score);

                                    foreach ( $dataArr as $key => $value ) {
                                        $dataArr[$key] = urlencode ($value);
                                    }

                                    $dataArr = urldecode ( json_encode ( $dataArr )).",";
                                    echo $dataArr;
                                    insertIntoDatabase('搜索用户',$con,1);
                                    $affected_rows_num++;
                                }
                                echo "{\"row_num\":".$affected_rows_num."}";
                                //--------------------------------------------------------------------------------->出口5：是在通过slogan搜索用户名，但是模糊搜索
                            }else{
                                insertIntoDatabase('搜索用户',$con,0);
                                $status = 0;
                                $reminder = "没有结果user";
                                echo $a->normalrespond($status,$reminder);
                                //------------------------------------------------------------------------------------->出口6：在user里搜索，没有搜到任何相关结果
                            }
                        }
                    }
                }
            }
        }else if($pri == "article"){
            //查询文章

            $sql = "SELECT * FROM articles WHERE title = '$con' LIMIT $sta,15 ";
            $qry = $db->query($sql);
            @$row_all = mysqli_num_rows($qry);//总条数
            $affected_rows_num = 0;
            if($row_all>0){
                while ($row = $qry->fetch_assoc()){
                    $aid = $row["aid"];
                    $title = $row["title"];
                    $abstract = $row["abstract"];
                    $atime = $row["time"];
                    $auid = $row["uid"];

                    $sql2 = "SELECT name FROM users WHERE uid = '$auid' ";
                    $qry2 = $db->query($sql2);
                    $row2 = $qry2->fetch_assoc();
                    $aauthor = $row2["name"];//作者用户名
                    //------------------------------------------------------------------------------------------------->出口7：搜索的是文章标题，精准搜索标题
                    $dataArr = array ('aid'=>$aid,'uid'=>$auid,'abstract'=>$abstract,'time'=>$atime,'name'=>$aauthor,'title'=>$title);

                    foreach ( $dataArr as $key => $value ) {
                        $dataArr[$key] = urlencode ($value);
                    }

                    $dataArr = urldecode ( json_encode ( $dataArr )).",";
                    echo $dataArr;
                    insertIntoDatabase('搜索文章',$con,1);
                    $affected_rows_num++;
                }
                echo "{\"row_num\":".$affected_rows_num."}";
            }else{
                $sql = "SELECT * FROM articles WHERE title LIKE '%$con%' LIMIT $sta,15 ";
                $qry = $db->query($sql);
                @$row_all = mysqli_num_rows($qry);//总条数
                $affected_rows_num = 0;
                if($row_all>0){
                    while ($row = $qry->fetch_assoc()){
                        $aid = $row["aid"];
                        $title = $row["title"];
                        $abstract = $row["abstract"];
                        $atime = $row["time"];
                        $auid = $row["uid"];

                        $sql2 = "SELECT name FROM users WHERE uid = '$auid' ";
                        $qry2 = $db->query($sql2);
                        $row2 = $qry2->fetch_assoc();
                        $aauthor = $row2["name"];//作者用户名
                        //--------------------------------------------------------------------------------------------->出口8：搜索的是文章标题，模糊搜索标题
                        $dataArr = array ('aid'=>$aid,'uid'=>$auid,'time'=>$atime,'abstract'=>$abstract,'name'=>$aauthor,'title'=>$title);

                        foreach ( $dataArr as $key => $value ) {
                            $dataArr[$key] = urlencode ($value);
                        }

                        $dataArr = urldecode ( json_encode ( $dataArr )).",";
                        echo $dataArr;
                        insertIntoDatabase('搜索文章',$con,1);
                        $affected_rows_num++;
                    }
                    echo "{\"row_num\":".$affected_rows_num."}";
                }else{
                    $sql = "SELECT * FROM articles WHERE content LIKE '%$con%' LIMIT $sta,15 ";
                    $qry = $db->query($sql);
                    @$row_all = mysqli_num_rows($qry);//总条数
                    $affected_rows_num = 0;
                    if($row_all>0){
                        while ($row = $qry->fetch_assoc()){
                            $aid = $row["aid"];
                            $title = $row["title"];
                            $abstract = $row["abstract"];
                            $atime = $row["time"];
                            $auid = $row["uid"];

                            $sql2 = "SELECT name FROM users WHERE uid = '$auid' ";
                            $qry2 = $db->query($sql2);
                            $row2 = $qry2->fetch_assoc();
                            $aauthor = $row2["name"];//作者用户名
                            //----------------------------------------------------------------------------------------->出口9：搜索的是文章内容，模糊搜索
                            $dataArr = array ('aid'=>$aid,'time'=>$atime,'abstract'=>$abstract,'uid'=>$auid,'name'=>$aauthor,'title'=>$title);

                            foreach ( $dataArr as $key => $value ) {
                                $dataArr[$key] = urlencode ($value);
                            }

                            $dataArr = urldecode ( json_encode ( $dataArr )).",";
                            echo $dataArr;
                            insertIntoDatabase('搜索文章',$con,1);
                            $affected_rows_num++;
                        }
                        echo "{\"row_num\":".$affected_rows_num."}";
                    }else{
                        insertIntoDatabase('搜索文章',$con,0);
                        $status = 0;
                        $reminder = "没有结果article";
                        echo $a->normalrespond($status,$reminder);
                        //--------------------------------------------------------------------------------------------->出口10：在article里搜索，没有搜到任何相关结果
                    }
                }
            }
        }
        //competiton比赛的搜索，在interface/getMatchInfo.php里进行
    }else{
        $status = 0;
        $reminder = "缺少关键参数，无法进行搜索";
        echo $a->normalrespond($status,$reminder);
    }



    /**把搜索内容写入数据库**/
    function insertIntoDatabase($ClassPri,$content,$isAvailable){
        require("../connectDB.php");

        $a = new _environment();
        $tnow = $a->getTime();
        $b = new interfaceResponse();

        /**先检测该关键词是否已经存在于数据库了**/
        $sql = "SELECT times,searid FROM searchings WHERE content='$content' AND classification = '$ClassPri' AND isAvailable = '$isAvailable'";
        $qry = $db->query($sql);
        $row_all = mysqli_num_rows($qry);
        if($row_all>0){
            //content已经在数据库里存在了 -> 执行Update
            $row = $qry->fetch_assoc();
            $Otimes = (int)$row["times"];
            $Osearid = $row["searid"];
            $Otimes += 1;
            $sql2 = "UPDATE searchings SET times = '$Otimes',lasttime = '$tnow' WHERE searid = '$Osearid' ";
            $qry2 = $db->query($sql2);
            if($qry2){
                //----------------------------------------------------------------------------------------------------->出口1，更新搜索数据库完毕
                return true;
            }else{
                //----------------------------------------------------------------------------------------------------->出口2，更新搜索数据库失败
                return false;
            }
        }else{
            //content没在数据库里存在 -> 执行Insert
            $sql2 = "INSERT INTO searchings(searid,content,times,regtime,lasttime,classification,isAvailable,remark) VALUES ('','$content','1','$tnow','$tnow','$ClassPri','$isAvailable','none')";
            $qry2 = $db->query($sql2);
            if($qry2){
                //----------------------------------------------------------------------------------------------------->出口1，更新搜索数据库完毕
                return true;
            }else{
                //----------------------------------------------------------------------------------------------------->出口2，更新搜索数据库失败
                return false;
            }
        }
    }

?>