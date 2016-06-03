<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/6/2
 * Time: 14:52
 */
require("../connectDB.php");
require("../all.php");
require("../algorithm/AbstractofArticle.php");
?>
<?php
    $status = $reminder = 0;
    @$uid = $_POST["uid"];
    if(!$uid) $uid = $_SESSION["uid"];

    $sql = "SELECT * FROM articles WHERE uid = '$uid' ";
    $qry = $db->query($sql);
    while($row = $qry->fetch_assoc()){
        $result_title = $row["title"];
        $result_time = $row["time"];
        $result_content = $row["content"];
        $result_abstract = getAbstract($result_content);


        $dataArr = array ('title'=>$result_title,'time'=>$result_title,'abstact'=>$result_abstract);
        foreach ( $dataArr as $key => $value ) {
            $dataArr[$key] = urlencode ($value) ;
        }
        $dataArr = urldecode ( json_encode ( $dataArr )). ",";
        echo $dataArr;
    }

?>