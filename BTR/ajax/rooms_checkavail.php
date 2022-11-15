<?php

require('../admin/inc/important.php');
require('../admin/inc/db_config.php');
date_default_timezone_set("Asia/kolkata");
session_start();

if(isset($_GET['fetch_room']))
{ 
        // check availability decode 
        $chk_avail = json_decode($_GET['chk_avail'],true);
        if($chk_avail['checkin']!='' && $chk_avail['checkout']!='' )
        {

            $today_date = new DateTime(date("Y-m-d"));
            $checkin_date = new DateTime($chk_avail['checkin']);
            $checkout_date = new DateTime($chk_avail['checkout']);

            if ($checkin_date == $checkout_date) {
                echo "<h3 class='text-center text-danger'>No rooms  available to show</h3><br/>
                <h3 class='text-center text-danger'>check in date and checkout date can not be same.</h3>";
                exit;
            } else if ($checkout_date < $checkin_date) {
               echo "<h3 class='text-center text-danger'>No rooms  available to show</h3><br/><h3 class='text-center text-danger'>you can not check out earlier than the check in date.</h3>";
                exit;
            } else if ($checkin_date < $today_date) {
                echo "<h3 class='text-center text-danger'>No rooms  available to show</h3>";
                exit;
            }
        }

        // guests data decode 
        $chk_guest = json_decode($_GET['guests'],true);
        $adults =($chk_guest['adult']!='')?$chk_guest['adult']:0;
        $childrens = ($chk_guest['children'] != '') ? $chk_guest['children'] : 0;
        
        
        




        //code to count the number of rooms and varible for displaying the output
         $count_room=0;  
         $output ="";  
    

        //  query for availability filter by check in and check out data with guest also 

        $res = select("SELECT * FROM `room` WHERE `adult`>=? AND `children`>=?  AND `status`=? AND `removed`=?  order by `id` desc ", [$adults,$childrens,1, 0], 'iiii');
        while ($room_data = mysqli_fetch_assoc($res)) 
        {
            //check availability logic by counting the number of rooms allotted and remaining rooms
            if($chk_avail['checkin'] != '' && $chk_avail['checkout'] != ''){
                    $booking_count = "SELECT COUNT(booking_id) AS `total_bookings` FROM `booking_order`
                WHERE booking_status = ? AND room_id=?
                AND check_out> ? AND check_in< ?";
                    $values = ['confirmed', $room_data['id'] , $chk_avail['checkin'], $chk_avail['checkout']];
                    $booking_fetch = mysqli_fetch_assoc(select($booking_count, $values, 'siss'));

                    //query to fetch the quantity of the rooms 
                    if (($room_data['quantity'] - $booking_fetch['total_bookings']) == 0) {
                    continue;
                    }


            }

                

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


            //get thumbnail of image
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
            $book_btn = "<button onclick='checkloginTobook($login,$room_data[id])' class='btn btn-outline-white-primary text-black w-100  custom-bg shadow-none mb=lg-2 mb-2'>Book Now</button>";


            //print room card 
            $output.="
                <div class='card mb-4 border-0 shadow rooms'>
                    <div class='row g-0 p-3 align-items-center'>
                        <div class='col-md-4 mb-lg-0 mb-md-0 mb-3'>
                            <img src='$room_thumb' class='img-fluid rounded ' alt='$room_data[name]'>
                        </div>
                        <div class='col-md-5 px-lg-3 px-md-3 px-0'>
                            <h5 class='mb-2'>$room_data[name]</h5>
                                <div class='features mb-2'>
                                        <h6 class='mb-1 '>Features</h6>
                                        $features_data
                                    
                                </div>
                                <div class='facilities mb-2'>
                                        <h6 class='mb-1 '>Facilities</h6>
                                        <span class='badge rounded-pill bg-light text-dark text-wrap'>
                                        WIFI
                                        </span>
                                        <span class='badge rounded-pill bg-light text-dark text-wrap'>
                                        AC
                                        </span>
                                        <span class='badge rounded-pill bg-light text-dark text-wrap'>
                                        Television
                                        </span>
                                </div>

                                <div class='Guest mb-lg-0 mb-md-0 mb-3'>
                                    <h6 class='mb-1 '>Guests</h6>
                                    <span class='badge rounded-pill bg-light text-dark text-wrap'>
                                    $room_data[adult] Adult
                                    </span>
                                    <span class='badge rounded-pill bg-light text-dark text-wrap'>
                                    $room_data[children] children
                                </span>
                                
                                    
                            </div>
                        </div>
                        <div class='col-md-2 text-center'>
                            <h6 class='mb-3'>NPR $room_data[price]</h6>
                            $book_btn
                            <a href='room_details.php? id=$room_data[id]' class='btn btn-outline-white-primary text-black w-100  custom-bg shadow-none'>View details</a>

                        </div>
                    </div>
                </div>                          
            ";
            $count_room++;
        }

        if($count_room >0){
            echo $output;
        }
        else
        {
            echo "<h3 class='text-center text-danger'>No rooms  available to show</h3>";
        }
}



?>