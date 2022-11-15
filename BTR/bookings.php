<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BTR-My Bookings</title>
    <?php require('inc/links.php'); ?>

    <style>
        .custom-bg {
            background-color: #2ec1ac;

        }

        .custom-bg:hover {
            background-color: #279e8c;
        }
    </style>


</head>

<body>
    <?php
    require('inc/header.php');

    //   code for checking whether the user is login or not 
    if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
        redirect('index.php');
    }


    ?>



    <div class="container ">

        <div class=" col-12 my-5 px-4">
            <h2 class="fw-bold  h-font">My BOOKINGS </h2>
            <a href="index.php" class="text-secondary text-decoration-none">Home</a>
            <span> >>> </span>
            <a href="#" class="text-secondary text-decoration-none">Bookings</a>
        </div>

        <?php
        $query = " SELECT bo.*, bd.*  FROM `booking_order` bo INNER JOIN
                `booking_details` bd ON  bo.booking_id = bd.booking_id where bo.booking_status=?
                AND (bo.user_id =?) ORDER BY bo.booking_id  DESC";

        $result = select($query, ['confirmed', $_SESSION['uID']], 'si');
        while ($data = mysqli_fetch_assoc($result)) {

            $date = date("d-m-y", strtotime($data['datetime']));
            $checkin = date("d-m-y", strtotime($data['check_in']));
            $checkout = date("d-m-y", strtotime($data['check_out']));


            $btn = "";

            if ($data['booking_status'] == 'confirmed') {

                $btn = "<button type='button' onclick='can_booking($data[booking_id])' class='btn btn-danger btn-sm shadow-none'>cancel booking</button>";
            }
            echo <<<bookings
                        <div class='container'>
                        <div class='row'>
                        <div class='col-md-4 px-4 mb-4 '  >
                            <div class='bg-white  p-3 rounded shadow'>
                                    <h5 class='fw-bold'>$data[room_name]</h5>
                                    <p> NPR$data[price]</p>
                                    <p>
                                    <b>Check in : </b> $checkin<br>
                                    <b>Check in : </b> $checkout
                                    </p>
                                    <p>
                                    <b>Amount: </b> NPR$data[total_pay]<br>
                                    <b>Booking status :</b>$data[booking_status]<br>
                                    <b>Payment status : </b> $data[trans_status]
                                    </p>
                                    <p>
                                    $btn
                                    </p>
                                <div>                        
                        </div>
                        
                        </div>
                        </div>
                    
                        bookings;
        }
        ?>
    </div>


    <?php require('inc/footer.php') ?>

    <script>
        function can_booking(id) {
            if (confirm('Are you sure to cancel booking?')) {

                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/cancel_booking.php", true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');


                xhr.onload = function() {

                    if (this.responseText == 1) {
                        window.location.href = "bookings.php?cancel_status=true";
                        

                    } else {
                        alert('error', 'cancellation failed!');
                    }
                }
                xhr.send('can_booking&id=' + id);



            }


        }
    </script>

</body>

</html>