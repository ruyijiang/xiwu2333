<?php
/**
 * Created by PhpStorm.
 * User: 马子航
 * Date: 2016/6/4
 * Time: 15:49
 */
require("../../connectDB.php");
require("../../all.php");
?>
<?php
    $responseCate = $_GET["responseCate"];
    $num_onepage = $_GET["num_onepage"];//每页显示条数
    @$uid = $_GET["uid"];

    if(!$uid) $uid=$_SESSION["uid"];

    if($responseCate == 'article'){
        //-----------------请求的是文章列表的分页
        $sql = "SELECT aid FROM articles WHERE uid='$uid' ";
        $qry = $db->query($sql);
        $row_all = mysqli_num_rows($qry);//总条数
        $page_all = (int)ceil($row_all/$num_onepage);//总页数

        $dataArr = array ('row_all'=>$row_all,'page_all'=>$page_all);

        foreach ( $dataArr as $key => $value ) {
            $dataArr[$key] = urlencode ($value);
        }

        $dataArr = urldecode ( json_encode ( $dataArr ));
        echo $dataArr;

    }else if($responseCate == 'user'){
        //-----------------请求的是用户列表的分页
        
    }
?>
