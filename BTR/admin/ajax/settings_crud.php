<?php

require('../inc/db_config.php');
require('../inc/important.php');
 adminLogin();


 if(isset($_post['get_general'])){

    $q = "SELECT * FROM `settings` WHERE  `sr_no`=?";
    $value=[1];
    $res =select($q,$value,'i');
    $data = mysqli_fetch_assoc($res);
    $json_data = json_encode($data);
    echo $json_data;
   
 }



 
 if(isset($_post['upd_shutdown'])){
$frm_data = ($_post['upd_shutdown'])? 1:0;
$q = "UPDATE `settings` SET`shutdown`=? WHERE  `sr_no`=?";
$values = [$frm_data,1];
$res = update($q,$values,'ii');
echo $res;

}
?>