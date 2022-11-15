<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BTR-confirm Booking</title>
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
    <?php require('inc/header.php'); ?>
    <?php

        /*check room id from url is present or not
            user is login or not  
            */
        if (!isset($_GET['id'])) {
            redirect('Rooms.php');
        } else if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
            redirect('Rooms.php');
        }

        //filter and get room and user data
        $data = filteration($_GET);
        $res = select("SELECT * FROM `room` WHERE  `id`=? AND `status`=? AND `removed`=?", [$data['id'], 1, 0], 'iii');

        if (mysqli_num_rows($res) == 0) {
            redirect('Rooms.php');
        }
        $room_data = mysqli_fetch_assoc($res);
        $_SESSION['room'] = [
            "id" => $room_data['id'],
            "name" => $room_data['name'],
            "price" => $room_data['price'],
            "payment" => null,
            "available" => false,

        ];

        $user_result = select("SELECT * FROM `register` WHERE `id`=? LIMIT 1", [$_SESSION['uID']], "i");
        $user_data = mysqli_fetch_assoc($user_result);




    ?>



    <div class="container ">
        <div class="row">
            <div class=" col-12 my-5 px-4">
                <h2 class="fw-bold ">CONFIRM BOOKINGS </h2>
            </div>
            <div style="font-size: 14px;">
                <a href="index.php" class="text-secondary text-decoration-none">Home</a>
                <span> > </span>
                <a href="Rooms.php" class="text-secondary text-decoration-none">Rooms</a>
                <span> > </span>
                <a href="#" class="text-secondary text-decoration-none">Confirm</a>
            </div>



            <div class="col-lg-7 col-md-12 px-4 ">

                <?php

                    $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
                    $thumb_q = mysqli_query($conn, "SELECT * FROM `room_images` where `room_id`='$room_data[id]' AND `thumb`='1'");

                    if (mysqli_num_rows($thumb_q) > 0) {
                        $thumb_res = mysqli_fetch_assoc($thumb_q);
                        $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
                    }

                    echo <<<data
                            <div class="card p-3 shadow-sm rouded">
                            <img src="$room_thumb" class="img-fluid rounded mb-3" alt="$room_data[name]">
                            <h5>$room_data[name]</h5>
                            <h6>NPR $room_data[price]</h6>
                            
                            </div>

                            data;

                    //code for checking whther the user is log in or not
                    //if login  call the booking confirm function

                    $book_btn = "";
                    $login = 0;
                    if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                        $login = 1;
                    }
                    $book_btn = "<button onclick='checkloginTobook($login,$room_data[id])' class='btn  text-black w-100  custom-bg shadow-none mb=lg-2 mb-2'>Book Now</button>";

                ?>
            </div>

            <div class="col-lg-5 col-md-12 px-4 ">
                <div class="card mb-4 border-0 shadow-sm rounded-6">
                    <div class="card-body">
                        <form action="pay_now.php" method="POST" id="booking_form">
                            <h6 class="mb-3">BOOKING DETAILS</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label ">Name</label>
                                    <input type="text" name="name" value="<?php echo $user_data['name'] ?>" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label ">Phone Number</label>
                                    <input type="text" name="phone" value="<?php echo $user_data['phone'] ?>" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label ">Address</label>
                                    <textarea name="address" class="form-control shadow-none" rows="1" required><?php echo $user_data['Address'] ?> </textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label ">Check-in</label>
                                    <input type="date" name="checkin" onchange="check_availability()" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label ">Check-out</label>
                                    <input type="date" name="checkout" onchange="check_availability()" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-12">
                                    <div class="spinner-border text-info mb-2 d-none" id="loader_info" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <h6 class="mb-3 text-danger" id="pay_info">Provide checkin and checkout date!</h6>
                                    <button name="pay_now" type="submit" class="btn btn-primary w-100 custom-bg shadow-none  mb-1 " disabled >Complete Booking</button>
                                </div>
                            </div>                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require('inc/footer.php'); ?>

    <script>
        let booking_form = document.getElementById('booking_form');
        let loader_info = document.getElementById('loader_info');
        let pay_info = document.getElementById('pay_info');

        function check_availability() {
            let checkin_value = booking_form.elements['checkin'].value;
            let checkout_value = booking_form.elements['checkout'].value;

            booking_form.elements['pay_now'].setAttribute('disabled', true);

            if (checkin_value != '' && checkout_value != '') {
                pay_info.classList.add('d-none');
                pay_info.classList.replace('text-dark', 'text-danger');
                loader_info.classList.remove('d-none');

                let data = new FormData();
                data.append('check_availability', '');
                data.append('check_in', checkin_value);
                data.append('check_out', checkout_value);



                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/confirm_book.php", true);

                xhr.onload = function() {
                    let data = JSON.parse(this.responseText);
                    if (data.status == 'check_in_out_equal') {
                        pay_info.innerText = "You cannot checkout on same date!";

                    } else if (data.status == 'check_out_early') {
                        pay_info.innerText = "check out date is earlier than check in date!";
                    } else if (data.status == 'check_in_early') {
                        pay_info.innerText = " you cannot check in before today's date!";
                    } else if (data.status == 'unavailable') {
                        pay_info.innerText = "room is not available";
                    } else {
                        pay_info.innerHTML = "No. of days =" + data.days + "<br> Total amount to pay =" + data.payment;
                        pay_info.classList.replace('text-danger', 'text-dark');
                        booking_form.elements['pay_now'].removeAttribute('disabled');


                    }
                    pay_info.classList.remove('d-none');
                    loader_info.classList.add('d-none');
                    



                }
                xhr.send(data);
            }

        }

   


    </script>



</body>

</html>