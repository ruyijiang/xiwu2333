<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/6/24
 * Time: 17:03
 */
require("../connectDB.php");
require("../all.php");
?>
<?php
    $timing = $_GET["timing"];


    $a = new interfaceResponse();
    $status = $reminder = "";

    if($timing){

        $sql = "SELECT searid,content,times FROM searchings ORDER BY times DESC LIMIT 0,1";
        $qry = $db->query($sql);
        $row = $qry->fetch_assoc();
        $result_searid = $row["searid"];
        $result_content = $row["content"];
        $result_times = $row["times"];

        $status = 1;
        $dataArr = array ('statuscode'=>$status,'searid'=>$result_searid,'content'=>$result_content,'times'=>$result_times);

        foreach ( $dataArr as $key => $value ) {
            $dataArr[$key] = urlencode ($value);
        }

        $dataArr = urldecode ( json_encode ( $dataArr ));
        echo $dataArr;

    }else{
        $status = 0;
        $reminder = "缺少关键参数";
        echo $a->normalrespond($status,$reminder);
    }

?>