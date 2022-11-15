<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BTR-room details</title>
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
    if (!isset($_GET['id'])) {
        redirect('Rooms.php');
    }

    $data = filteration($_GET);
    $res = select("SELECT * FROM `room` WHERE  `id`=? AND `status`=? AND `removed`=?", [$data['id'], 1, 0], 'iii');

    if (mysqli_num_rows($res) == 0) {
        redirect('Rooms.php');
    }
    $room_data = mysqli_fetch_assoc($res);


    ?>



    <div class="container ">
        <div class="row">
            <div class=" col-12 my-5 px-4">
                <h2 class="fw-bold "><?php echo $room_data['name'] ?> </h2>
                <a href="index.php" class="text-secondary text-decoration-none">Home</a>
                <span> >>> </span>
                <a href="Rooms.php" class="text-secondary text-decoration-none">Rooms</a>
            </div>






            <div class="col-lg-7 col-md-12 px-4 bg-dark">
                <div id="room_carousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $room_img = ROOMS_IMG_PATH . "thumbnail.jpg";
                        $img_q = mysqli_query($conn, "SELECT * FROM `room_images` where `room_id`='$room_data[id]'");
                        if (mysqli_num_rows($img_q) > 0) {
                            $active_class = 'active';
                            while ($img_res = mysqli_fetch_assoc($img_q)) {

                                echo "
                                    <div class='carousel-item $active_class' data-bs-interval='10000'>
                                    <img src=' " . ROOMS_IMG_PATH . $img_res['image'] . "' class='d-block w-100 rounded' >
                                    </div>
                                    ";
                                $active_class = '';
                            }
                        } else {
                            echo "
                                    <div class='carousel-item active' data-bs-interval='10000'>
                                    <img src=' $room_img' class='d-block w-100' >
                                    </div>
                                    ";
                        }


                        $book_btn = "";
                        $login = 0;
                        if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                            $login = 1;
                        }
                        $book_btn = "<button onclick='checkloginTobook($login,$room_data[id])' class='btn  text-black w-100  custom-bg shadow-none mb=lg-2 mb-2'>Book Now</button>";





                        ?>

                    </div>

                </div>

            </div>

            <div class="col-lg-5 col-md-12 px-4 ">
                <div class="card mb-4 border-0 shadow-sm rounded-6">
                    <div class="card-body">
                        <?php
                        echo <<<price
                        <h5 class='mb-2'>NPR $room_data[price]</h5>
                    price;

                        $feature_q = mysqli_query($conn, "SELECT f.name from `features` f INNER JOIN
                            `room_feature` rfea ON f.id =rfea.feature_id
                            where rfea.room_id='$room_data[id]' ");

                        $features_data = "";
                        while ($fea_row = mysqli_fetch_assoc($feature_q)) {
                            $features_data .= " <span class='badge rounded-pill bg-light text-dark text-wrap'>
                          $fea_row[name]
                        </span>";
                        }
                        echo <<<features
                            <div class='mb-3 ' style='font-size:18px;'>
                                <h6 class='mb-1 ' style='font-size:22px;'>Features</h6>
                                $features_data                            
                            </div>

                        features;


                        echo <<<guests
                            <div class='mb-4'>
                                 <h6  style='font-size:18px;'>Guests</h6>
                                 <span class='badge rounded-pill bg-light text-dark text-wrap' style='font-size:14px;'>
                                  $room_data[adult] Adult
                                 </span>
                                <span class='adge rounded-pill bg-light text-dark text-wrap' style='font-size:14px;'>
                                  $room_data[children] children
                                </span>
                            </div>

                        guests;


                        echo <<<booknow
                        $book_btn
                        booknow;
                        ?>

                    </div>
                </div>
            </div>

            <div class="col-12 px-4 mt-4">
                <div class="mb-4">
                    <h5>Description</h5>
                    <p>
                        <?php echo $room_data['description'] ?>
                    </p>
                </div>


            </div>

        </div>
    </div>
    <?php require('inc/footer.php'); ?>


</body>

</html>