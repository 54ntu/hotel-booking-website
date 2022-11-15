<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BTR-B-status</title>
    <?php require('inc/links.php'); ?>
</head>
<body>
<?php  require('inc/header.php'); ?>
 


<div class="container mt-5">


    <?php 
    
    date_default_timezone_set("Asia/kolkata");
    


    if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
        redirect('index.php');
    }


    if (isset($_POST['pay_now'])) {

        //insert bookings details into the database
        $frm_data = filteration($_POST);

        $query1 = "INSERT INTO `booking_order`( `user_id`, `room_id`, `check_in`, `check_out`,
            `booking_status`, `trans_amt`) 
        VALUES (?,?,?,?,?,?)";
        insert($query1,[$_SESSION['uID'],$_SESSION['room']['id'],$frm_data['checkin'],$frm_data['checkout'],'confirmed',$_SESSION['room']['payment']],'iissss');

        $booking_id= mysqli_insert_id($conn);

        $query2 = "INSERT INTO `booking_details`( `booking_id`, `room_name`, `price`, `total_pay`, `user_name`, `phonen0`, `address`) VALUES
            (?,?,?,?,?,?,?)";

        insert($query2,[ $booking_id,$_SESSION['room']['name'], $_SESSION['room']['price'],$_SESSION['room']['payment'],$frm_data['name'],$frm_data['phone'],$frm_data['address']],'issssss');


        echo<<<data
        <div class="col-12 px-4">
        <h3 class='fw-bold text-blue'>Booking status</h3>
            <p class="fw-bold alert alert-success">
            <i class="bi bi-check-circle-fill"></i>
                Booking successful!
            <br><br>
            <a href='bookings.php'>Go to My Bookings</a>
        </div>
        data;


    }

    

    ?>


</div>

<?php require('inc/footer.php'); ?>  
</body>
</html>
