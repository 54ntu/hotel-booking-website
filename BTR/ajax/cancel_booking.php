<?php

require('../admin/inc/important.php');
require('../admin/inc/db_config.php');
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    redirect('index.php');
}


    if (isset($_POST['can_booking'])) {
       $frm_data = filteration($_POST);
        $query ="UPDATE `booking_order` SET `booking_status`=?  where `booking_id`=? AND `user_id`=?";

        $values= ['cancelled',$frm_data['id'],$_SESSION['uID']];
        $result = update($query,$values, 'sii');
        echo $result;

    }

?>