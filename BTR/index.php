<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BTR-Bardiya Tiger Resort</title>
    <?php require('inc/links.php'); ?>
    <Style>
        .availability-form {
            margin-top: -50px;
            z-index: 2;
            position: relative;
        }

        .custom-bg {
            background-color: #2ec1ac;
        }

        .custom-bg:hover {
            background-color: #279e8c;
        }

        @media screen and (max-width:575px) {
            .availability-form {
                margin-top: 20px;
                padding: 0 35px;

            }
        }
    </style>
</head>

<body class="bg-light">
    <?php require('inc/header.php'); ?>
    <!-- start of the carousel  -->
    <div class="container-fluid px-lg-4 mt-4">
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">

                    <img src="images/presidentialroom.jpg" class="d-block w-100" alt="first slide" height="500px" width="1500px">

                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="images/hero_4.jpg" class="d-block w-100" alt="second slide" height="500px" width="1500px">
                </div>
                <div class="carousel-item">
                    <img src="images/hero_2.jpg" class="d-block w-100" alt="third slide" height="500px" width="1500px">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- end of carousel  -->

    <!-- check availability  -->
    <div class="container availability-form">
        <div class="row">
            <div class="col-lg-12 bg-white shadow p-4 rounded">
                <h5 class="mb-4 text-center">checking Availability</h5>
                <form method="POST" action="Rooms.php">
                    <div class="row align-items-end">
                        <div class="col-lg-3  mb-3">
                            <label class="form-label" style="font-weight: 500;">Check-in</label>
                            <input type="date" class="form-control shadow-none" name="checkin" required>
                        </div>
                        <div class="col-lg-3  mb-3">
                            <label class="form-label" style="font-weight: 500;">Check-out</label>
                            <input type="date" class="form-control shadow-none " name="checkout" required>
                        </div>

                        <div class="col-lg-3  mb-3">
                            <label class="form-label" style="font-weight: 500;">Adults</label>
                            <select class="form-select shadow-none " name="adult">

                                <?php
                                $guest_query = mysqli_query($conn, "SELECT MAX(adult) as `max_adult`, MAX(children) as `max_children` from room where `status`='1' AND `removed`='0'");
                                $guest_result = mysqli_fetch_assoc($guest_query);

                                for ($i = 1; $i <= $guest_result['max_adult']; $i++) {
                                    echo " <option value='$i'>$i</option>";
                                }
                                ?>


                            </select>

                        </div>
                        <div class="col-lg-2  mb-3">
                            <label class="form-label" style="font-weight: 500;">Child</label>
                            <select class="form-select shadow-none " name="children">
                                <?php
                                for ($i = 1; $i <= $guest_result['max_children']; $i++) {
                                    echo " <option value='$i'>$i</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <input type="hidden" name="check_availability">
                        <div class="col-lg-1 mb-lg-3 mt-2">
                            <button type="submit " class="btn text-black border-outlined shadow-none custom-bg">Submit</button>
                        </div>
                    </div>



                </form>
            </div>
        </div>
    </div>
    <!-- end of check availability  -->

    <!-- our rooms  -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR ROOMS</h2>
    <div class="container">
        <div class="row ">
            <?php
            $res = select("SELECT * FROM `room` WHERE `status`=? AND `removed`=? order by `id` desc  LIMIT 3 ", [1, 0], 'ii');
            while ($room_data = mysqli_fetch_assoc($res)) {

                //get features of room
                $feature_q = mysqli_query($conn, "SELECT f.name from `features` f INNER JOIN
                    `room_feature` rfea ON f.id =rfea.feature_id
                where rfea.room_id='$room_data[id]' ");

                $features_data = "";
                while ($fea_row = mysqli_fetch_assoc($feature_q)) {
                    $features_data .= " <span class='badge rounded-pill bg-light text-dark text-wrap'>
                    $fea_row[name]
                </span>";
                }


                // //get thumbnail of image
                $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
                $thumb_q = mysqli_query($conn, "SELECT * FROM `room_images` where `room_id`='$room_data[id]' AND `thumb`='1'");
                if (mysqli_num_rows($thumb_q) > 0) {
                    $thumb_res = mysqli_fetch_assoc($thumb_q);
                    $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
                }


                $book_btn = "";
                $login = 0;
                if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                    $login = 1;
                }
                $book_btn = "<button onclick='checkloginTobook($login,$room_data[id])' class='btn btn-sm text-white btn-outline-dark custom-bg shadow-none'>Book Now</button>";








                //print room card 
                echo <<<data
                         <div class="col-lg-4 col-md-6 my-3">
                            <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                                <img src="$room_thumb" class="card-img-top rounded">
                                    <div class="card-body ">
                                            <h5 >$room_data[name]</h5>
                                            <h6 class="mb-4">NPR $room_data[price]</h6>
                                            <div class="features mb-2">
                                                <h6 class="mb-1 ">Features</h6>
                                                $features_data                                        
                                            </div>
                                            <div class='mb-3'>
                                                <h6 class="mb-1 ">Guests</h6>
                                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                                    $room_data[adult] Adult
                                                </span>
                                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                                $room_data[children] children
                                                </span>
                                             </div>

                                        <div class="d-flex justify-content-evenly mb-2">
                                           $book_btn
                                           <a href="room_details.php? id=$room_data[id]" class="btn btn-sm btn-outline-dark custom-bg shadow-none">View details</a>
                                        </div>                          
                                    </div>
                            </div>
                        </div>                         
                    data;
            }
            ?>

            <!-- facilities section  -->
            <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Our Facilitites</h2>

            <div class="container">
                <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
                    <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-3 my-3">
                        <img src="images/facilities/wfi.svg" width="80px">
                        <h5 class="mt-3"> Free Wifi</h5>
                    </div>
                    <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-3 my-3">
                        <img src="images/facilities/p-circle.svg" width="80px">
                        <h5 class="mt-3">Free Parking</h5>
                    </div>
                    <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-3 my-3">
                        <img src="images/facilities/room-service.svg" width="80px">
                        <h5 class="mt-3">Room service</h5>
                    </div>
                    <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-3 my-3">
                        <img src="images/facilities/meeting.svg" width="80px">
                        <h5 class="mt-3">Meeting Rooms</h5>
                    </div>
                    <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-3 my-3">
                        <img src="images/facilities/swimming.svg" width="80px">
                        <h5 class="mt-3">Swimming Pool</h5>
                    </div>
                    <div class="col-lg-12 text-center mt-5">

                        <a href="facilities.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none ">MORE Facilities >>> </a>

                    </div>
                </div>
            </div>

            <!-- end of facility section  -->


            <!-- start of reach us section  -->
            <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font ">REACH US </h2>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
                        <iframe class="w-100 rounded" height="320px" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7015.726793845038!2d81.247048!3d28.453534000000005!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa011c5c0e8e676fc!2sBardia%20Tiger%20Resort!5e0!3m2!1sen!2snp!4v1660059751950!5m2!1sen!2snp" loading="lazy"></iframe>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="bg-white p-4 mb-4 rounded">
                            <h5>Call Us</h5>
                            <a href="tel:+977 9868240503" class="d-inline-block mb-2 text-decoration-none text-dark">
                                <i class="bi bi-telephone-fill"></i> +9779868240503
                            </a><br>
                            <a href="tel:+977 9868240503" class="d-inline-block  text-decoration-none text-dark">
                                <i class="bi bi-telephone-fill"></i> +977 9851014616
                            </a>
                        </div>
                        <div class="bg-white p-4 mb-4 rounded">
                            <h5>Follow Us</h5>
                            <a href="#" class="d-inline-block mb-2 ">
                                <span class="badge bg-light text-dark fs-6 p-2">
                                    <i class="bi bi-twitter me-1"></i> Twitter
                                </span>
                            </a><br>
                            <a href="https://www.facebook.com/santaram.chaudhary.792" class="d-inline-block mb-2 ">
                                <span class="badge bg-light text-dark fs-6 p-2">
                                    <i class="bi bi-facebook me-1"></i> Facebook
                                </span>
                            </a><br>
                            <a href="#" class="d-inline-block mb-2 ">
                                <span class="badge bg-light text-dark fs-6 p-2">
                                    <i class="bi bi-instagram me-1"></i> Instagram
                                </span>
                            </a>

                        </div>
                    </div>
                </div>
            </div>

            <!-- end of reach us section  -->


            <?php require('inc/footer.php'); ?>
</body>

</html>