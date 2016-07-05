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

    $status = $reminder = "";
    $a = new interfaceResponse();


    if($pri!=='competition'&&$pri!=='article') $pri='user';//当priority不是三者之一的时候，默认为user

    if($con){


        if($pri == "user"){
            //查询用户

            $sql_user = "SELECT * FROM users WHERE uid = '$con' ";
            $qry = $db->query($sql_user);
            @$row_all = mysqli_num_rows($qry);//总条数
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

                    $dataArr = urldecode ( json_encode ( $dataArr ));
                    echo $dataArr;
                    insertIntoDatabase($con);
                }
                //----------------------------------------------------------------------------------------------------->出口1：搜索的是用户，且通过uid
            }else{
                $sql = "SELECT * FROM users WHERE name = '$con' ";
                $qry = $db->query($sql);
                @$row_all = mysqli_num_rows($qry);//总条数
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

                        $dataArr = urldecode ( json_encode ( $dataArr ));
                        echo $dataArr;
                        insertIntoDatabase($con);
                    }
                    //------------------------------------------------------------------------------------------------->出口2：搜索的是用户，且通过name
                }else{
                    $sql = "select * from users where name like '%$con%' ";
                    $qry = $db->query($sql);
                    @$row_all = mysqli_num_rows($qry);//总条数
                    $dataArr = "";
                    if($row_all>0){
                        while ($row = $qry->fetch_assoc()){
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

                            $dataArr = array ('name'=>$username,'callingcardname'=>$result_callingcard,'slogan'=>$slogan,'gender'=>$gender,'province'=>$province,'city'=>$city,'uid'=>$uid,'score'=>$score);

                            foreach ( $dataArr as $key => $value ) {
                                $dataArr[$key] = urlencode ($value);
                            }

                            $dataArr = urldecode ( json_encode ( $dataArr )).",";
                            echo $dataArr;
                            insertIntoDatabase($con);
                        }
                        //--------------------------------------------------------------------------------------------->出口3：是在通过name搜索用户名，但是模糊搜索
                    }else{
                        $sql = "select * from users where slogan = '$con' ";
                        $qry = $db->query($sql);
                        @$row_all = mysqli_num_rows($qry);//总条数
                        if($row_all>0){
                            while ($row = $qry->fetch_assoc()) {
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

                                $dataArr = array('name' => $username,'callingcardname'=>$result_callingcard, 'slogan' => $slogan, 'gender' => $gender, 'province' => $province, 'city' => $city, 'uid' => $uid, 'score' => $score);

                                foreach ($dataArr as $key => $value) {
                                    $dataArr[$key] = urlencode($value);
                                }

                                $dataArr = urldecode(json_encode($dataArr));
                                echo $dataArr;
                                insertIntoDatabase($con);
                            }
                            //----------------------------------------------------------------------------------------->出口4：是在通过slogan搜索用户名
                        }else{
                            $sql = "select * from users where slogan like '%$con%' ";
                            $qry = $db->query($sql);
                            @$row_all = mysqli_num_rows($qry);//总条数
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
                                    insertIntoDatabase($con);
                                    //--------------------------------------------------------------------------------->出口5：是在通过slogan搜索用户名，但是模糊搜索
                                }
                            }else{
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

            $sql = "SELECT * FROM articles WHERE title = '$con' ";
            $qry = $db->query($sql);
            @$row_all = mysqli_num_rows($qry);//总条数
            if($row_all>0){
                while ($row = $qry->fetch_assoc()){
                    $aid = $row["aid"];
                    $title = $row["title"];
                    //$aid = $row["abstract"];摘要
                    $atime = $row["time"];
                    $aauthor = $row["uid"];

                    $sql2 = "SELECT name FROM users WHERE uid = '$aauthor' ";
                    $qry2 = $db->query($sql2);
                    $row2 = $qry2->fetch_assoc();
                    $aauthor = $row2["name"];//作者用户名
                    //------------------------------------------------------------------------------------------------->出口7：搜索的是文章标题，精准搜索标题
                    $dataArr = array ('aid'=>$aid,'time'=>$atime,'name'=>$aauthor,'title'=>$title);

                    foreach ( $dataArr as $key => $value ) {
                        $dataArr[$key] = urlencode ($value);
                    }

                    $dataArr = urldecode ( json_encode ( $dataArr ));
                    echo $dataArr;
                    insertIntoDatabase($con);
                }
            }else{
                $sql = "SELECT * FROM articles WHERE title LIKE '%$con%' ";
                $qry = $db->query($sql);
                @$row_all = mysqli_num_rows($qry);//总条数
                if($row_all>0){
                    while ($row = $qry->fetch_assoc()){
                        $aid = $row["aid"];
                        $title = $row["title"];
                        //$aid = $row["abstract"];摘要
                        $atime = $row["time"];
                        $aauthor = $row["uid"];

                        $sql2 = "SELECT name FROM users WHERE uid = '$aauthor' ";
                        $qry2 = $db->query($sql2);
                        $row2 = $qry2->fetch_assoc();
                        $aauthor = $row2["name"];//作者用户名
                        //--------------------------------------------------------------------------------------------->出口8：搜索的是文章标题，模糊搜索标题
                        $dataArr = array ('aid'=>$aid,'time'=>$atime,'name'=>$aauthor,'title'=>$title);

                        foreach ( $dataArr as $key => $value ) {
                            $dataArr[$key] = urlencode ($value);
                        }

                        $dataArr = urldecode ( json_encode ( $dataArr )).",";
                        echo $dataArr;
                        insertIntoDatabase($con);
                    }
                }else{
                    $sql = "SELECT * FROM articles WHERE content LIKE '%$con%' ";
                    $qry = $db->query($sql);
                    @$row_all = mysqli_num_rows($qry);//总条数
                    if($row_all>0){
                        while ($row = $qry->fetch_assoc()){
                            $aid = $row["aid"];
                            $title = $row["title"];
                            //$aid = $row["abstract"];摘要
                            $atime = $row["time"];
                            $aauthor = $row["uid"];

                            $sql2 = "SELECT name FROM users WHERE uid = '$aauthor' ";
                            $qry2 = $db->query($sql2);
                            $row2 = $qry2->fetch_assoc();
                            $aauthor = $row2["name"];//作者用户名
                            //----------------------------------------------------------------------------------------->出口9：搜索的是文章内容，模糊搜索
                            $dataArr = array ('aid'=>$aid,'time'=>$atime,'name'=>$aauthor,'title'=>$title);

                            foreach ( $dataArr as $key => $value ) {
                                $dataArr[$key] = urlencode ($value);
                            }

                            $dataArr = urldecode ( json_encode ( $dataArr )).",";
                            echo $dataArr;
                            insertIntoDatabase($con);
                        }
                    }else{
                        $status = 0;
                        $reminder = "没有结果article";
                        echo $a->normalrespond($status,$reminder);
                        //--------------------------------------------------------------------------------------------->出口10：在article里搜索，没有搜到任何相关结果
                    }
                }
            }
        }else if($pri == "competition"){
            //查询比赛
            //暂时没有
        }
    }else{
        $status = 0;
        $reminder = "没有结果competition";
        echo $a->normalrespond($status,$reminder);
    }



    /**把搜索内容写入数据库**/
    function insertIntoDatabase($content){
        require("../connectDB.php");

        $a = new _environment();
        $tnow = $a->getTime();
        $b = new interfaceResponse();

        /**先检测该关键词是否已经存在于数据库了**/
        $sql = "SELECT times,searid FROM searchings WHERE content='$content'";
        $qry = $db->query($sql);
        $row_all = mysqli_num_rows($qry);
        if($row_all>0){
            //content已经在数据库里存在了 -> 执行Update
            $row = $qry->fetch_assoc();
            $Otimes = (int)$row["times"];
            $Osearid = $row["searid"];
            $Otimes += 1;
            $sql2 = "UPDATE searchings SET times = '$Otimes' WHERE searid = '$Osearid' ";
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
            $sql2 = "INSERT INTO searchings VALUES ('','$content','1','$tnow','none')";
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