<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BTR-Bardiya Tiger Resort</title>
    <?php require('inc/links.php') ?>

    <style>
        .pop:hover{
            border-top-color:#2ec1ac !important;
            transform: scale(1.03);
            transition: all 0.3s;
        }
        .h-line{
            width: 150px;
            margin: 0 auto;
            height: 1.7px;
            }

            .cont_cls {
            position: absolute;
            left: 0;
            right: 0;
            top: 50%;
            text-align: left;
            transform: translateY(-50%);
            color: white;
        }

        
   </style
</head>
<body>
    <?php  require('inc/header.php'); ?>

    <!--start of hero section  -->

     <div class="container-fluid px-lg-4 mt-4">
        <img src="images/rooms.jpg" class="d-block w-100" height="500px" width="1500px">
        <h2 class="fw-bold h-font text-center  text-dark cont_cls">AMENITIES</h2>
    </div>
    <!--end of hero section  -->


    <div class="my-4  ">
        <h2 class="fw-bold h-font text-center">OUR AMENITIES</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-4" data-aos="fade in">
        Guests are like our Gods.So to provide the best services and
        facilities to our guest and make<br> their stay memorable is our main moto.   
        We provide various facilities<br> to our guest as per the need of the guest.And we 
       </p>
    </div>


   <!--start our amenities   --> 

    <div class="container mt-4">
        <div class="row">

        <?php 
            $res=selectAll('facility');
            $path= FACILITIES_IMAGE_PATH;
            
            while($row = mysqli_fetch_assoc($res)){
                echo <<<data
                
                        <div class="col-lg-4 col-md-6 mb-5 px-4">
                        <div class="bg-white rounded shadow border-top p-4 border-4 border-dark pop">
                            <div class="d-flex align-items-center mb-2">
                                <img src='$path$row[icon]' width="40px">
                                <h5 class="m-0 ms-3">$row[name]</h5>
                            </div>
                            <ul>
                            <li>$row[description]</li>
                            
                            </ul>                           
                        </div>
                    </div>
                data;
            }
        
        ?>

      <!--now we can delete thiss-->
            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow border-top p-4 border-4 border-dark pop">
                    <div class="d-flex align-items-center mb-2">
                        <img src="images/facilities/wfi.svg" width="40px">
                        <h5 class="m-0 ms-3">Wifi</h5>
                    </div>
                    <ul>
                    <li>Standard tier wireless internet (WiFi) access included.</li>
                    <li>WiFi available in public areas and guest rooms, including meeting rooms, at participating hotels.</li>
                    <li>WiFi bandwidth and speed may vary by hotel.</li>

                    
                    </ul>
                    
                </div>

            </div>
            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow border-top p-4 border-4 border-dark pop">
                    <div class="d-flex align-items-center mb-2">
                        <img src="images/facilities/meeting.svg" width="40px">
                        <h5 class="m-0 ms-3">Meeting Rooms</h5>
                    </div>
                    <ul>
                        <li>Large space for the meeting is available.</li>
                        <li>Around 150 people can attend the meetings and events at once.</li>
                        <li>Comfortable chairs,tables and all the necessary equipments for the meetings, events are also available.</li>                    
                    </ul>
                    
                </div>

            </div>
            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow border-top p-4 border-4 border-dark pop">
                    <div class="d-flex align-items-center mb-2">
                        <img src="images/facilities/p-circle.svg" width="40px">
                        <h5 class="m-0 ms-3"> Parking</h5>
                    </div>
                    <ul>
                        <li>Car Parking Available.</li>
                        <li>Parking of vehicle either by the owner or by the car valet of hotel and is entirely at owner's risk.</li>
                        <li>Parking is totally Free</li>
                        <li>Valet Parking is Available</li>                    
                    </ul>
                    
                </div>

            </div>
            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow border-top p-4 border-4 border-dark pop">
                    <div class="d-flex align-items-center mb-2">
                        <img src="images/facilities/room-service.svg" width="40px">
                        <h5 class="m-0 ms-3">Room Service</h5>
                    </div>
                    <ul>
                        <li>Room services is provided 24 hours.</li>
                        <li>Well trained staffs.</li>
                        <li>Guests can order from the telephone provided in each room.</li>
                        <li>Food will be delivered in the rooms.</li>
                        <li>Alcoholic drinks also available </li>
                    
                    
                    
                    </ul>
                    
                </div>

            </div>
            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow border-top p-4 border-4 border-dark pop">
                    <div class="d-flex align-items-center mb-2">
                        <img src="images/facilities/swimming.svg" width="40px">
                        <h5 class="m-0 ms-3">Swimming Pool</h5>
                    </div>
                   <ul>
                    <li>Keeping fun and entertainment in mind we have a swimming pool facility also.</li>
                    <li>Guest can enjoy while taking a bath in the pool after returning from the walk or visit to the National park. </li>
                    
                    
                   </ul> 
                </div>

            </div>
            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow border-top p-4 border-4 border-dark pop">
                    <div class="d-flex align-items-center mb-2">
                        <img src="images/facilities/house-keeping.svg" width="40px">
                        <h5 class="m-0 ms-3">House Keeping</h5>
                    </div>
                    <ul>
                        <li>Dry Cleaning Pickup/Laundry.</li>  
                        <li>Daily Housekeeping</li> 
                        <li>Housekeeping Full Service.</li>   
                        <li>Dry Cleaning Hours: 8:00 AM to 8:00 PM</li>
                    </ul>
                    
                </div>

            </div>
        </div>
    </div>
    <!--end of  our amenities   --> 


    <?php require('inc/footer.php'); ?>  

</body>
</html>