<?php
/**
 * Created by PhpStorm.
 * User: mazih
 * Date: 2016/5/17
 * Time: 9:57
 */
require("../connectDB.php");
require("../all.php");
?>
<?php
    @$country = $_GET["country"];
    @$province = $_GET["province"];
    $a = new interfaceResponse();
    if($province=="" && $country){
        //province为空，且国家不为空时
        //请求的是province
        $str = "";
        $sql = "SELECT REGION_NAME FROM region WHERE PARENT_ID = '1'";
        $qry = $db->query($sql);
        while ($row = $qry->fetch_assoc()){
            $str .= $row["REGION_NAME"].",";
        }
        echo $str;

    }else if($province!=="" && $country){
        //province为空，且国家不为空时
        //请求的是city
        $sql = "SELECT REGION_CODE,REGION_ID FROM region WHERE REGION_NAME = '$province' ";
        $qry = $db->query($sql);
        $row = $qry->fetch_assoc();
        $result_id = $row["REGION_ID"];
        $result_code = $row["REGION_CODE"];
        $result_code = substr($result_code,0,3);
        $result_code_r = substr($result_code,3,6);

        if($result_code == "110" || $result_code == "120"  ||  $result_code == "310" || $result_code == "500"){
            //分别是北京、天津、上海、重庆
            $sql = "SELECT REGION_NAME FROM region WHERE REGION_CODE LIKE '".$result_code."%' AND REGION_CODE NOT LIKE '%100' AND REGION_CODE NOT LIKE '%200' AND REGION_CODE NOT LIKE '%000'";//
        }else{
            $sql = "SELECT REGION_NAME FROM region WHERE REGION_CODE LIKE '".$result_code."%' AND PARENT_ID = '$result_id' ";
        }
        $qry = $db->query($sql);
        $str = "";
        while ($row = $qry->fetch_assoc()){
            $str .= $row["REGION_NAME"].",";
        }
        echo $str;






    }else{
        //应该是想请求国家，但是目前不做国际化
    }
?>