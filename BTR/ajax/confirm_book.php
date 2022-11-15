<?php 


require('../admin/inc/important.php'); 
require('../admin/inc/db_config.php'); 


if(isset($_POST['check_availability'])){
    $frm_data = filteration($_POST);

    $status ="";
    $result ="";

    // check in and out validation 
    
    $today_date = new DateTime(date("Y-m-d"));
    $checkin_date =new DateTime($frm_data['check_in']);
    $checkout_date =new DateTime($frm_data['check_out']);

    if($checkin_date == $checkout_date){
        $status = 'check_in_out_equal';
        $result =json_encode(["status"=>$status]);

    }
    else if ($checkout_date< $checkin_date){
        $status = 'check_out_early';
        $result =json_encode(["status"=>$status]);


    }
    else if($checkin_date < $today_date){
        $status = 'check_in_early';
        $result = json_encode(["status"=>$status]);
    }

    // check booking availability if status is blank  return the error 

    if($status!= ''){
        echo $result;
    }
    else{
        session_start();
        //run query to check room is available or not

         $booking_count = "SELECT COUNT(booking_id) AS `total_bookings` FROM `booking_order`
         WHERE booking_status = ? AND room_id=?
         AND check_out> ? AND check_in< ?";
         $values = ['confirmed', $_SESSION['room']['id'],$frm_data['check_in'],$frm_data['check_out']];
         $booking_fetch = mysqli_fetch_assoc(select($booking_count,$values,'siss'));

        //query to fetch the quantity of the rooms 
        $roomq_result = mysqli_fetch_assoc(select("SELECT `quantity` FROM `room` where `id`=?",[$_SESSION['room']['id']],'i'));
        if(($roomq_result['quantity']- $booking_fetch['total_bookings'])==0){
            $status ='unavailable';
            $result = json_encode(['status'=>$status]);
            echo $result;
            exit;
        }




        $count_days = date_diff($checkin_date,$checkout_date)->days;
        $payment = $_SESSION['room']['price']*$count_days;
        $_SESSION['room']['payment'] =$payment;
        $_SESSION['room']['available'] = true;

        $result = json_encode(["status"=>'available',"days"=>$count_days,"payment"=>$payment]);
        echo $result;

    }

}


?>