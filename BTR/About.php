<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BTR-Bardiya Tiger Resort</title>
    <?php require('inc/links.php') ?>

    <style>
        .myimag:hover{            
            transform: scale(1.03);
            transition: all 0.3s;
        }
        .h-line{
        width: 150px;
        margin: auto 0;
        height: 1.7px;
        }

        .about{
            position: absolute; 
            left:0; 
            right:0;
             top:50%; 
             text-align:left; 
             transform:translateY(-50%);
             color: white;
        }

        .aboutus{
            margin-top:10;
        }
       
   </style
</head>
<body>
    <?php  require('inc/header.php'); ?>

    <!--start of hero section  -->

    <div class="container-fluid px-lg-4 mt-4">
      <img src="images/slider3.jpg"  class="d-block w-100"  height="600px" width="1500px">
      <h2 class="fw-bold h-font text-center about">ABOUT US</h2>
    </div>
    <!--end of hero section  -->
   

    <div class="row featurette my-4  aboutus" style="padding:70px">
      <div class="col-md-7">
        <h2 class="h-font" >ABOUT US</h2>
        <div class="h-line bg-dark  mb-3"></div>
        <p class=" fs-4">When there was no mid-range luxury resort around Bardia National Park, nature lovers
        and wildlife conservation activist with support of local business entrepreneurs came
        forward with  Bardia Tiger Resort, commonly known as BTR.BTR was established with the 
        objectives of providing quality service to tourist  so that they can enjoy their time and
        make the stay memorable.</p>
       
      </div>
        <div class="col-md-5">
            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="2000">
                    <img src="images/about.jpg" class="d-block w-100 rounded shadow myimag" >
                    </div>
                    <div class="carousel-item" data-bs-interval="2000 ">
                    <img src="images/about1.jpg" class="d-block w-100 rounded shadow myimag" >
                    </div>
                    <div class="carousel-item">
                    <img src="images/awarness.jpg" class="d-block w-100 rounded shadow myimag" >
                    </div>
                </div>               
            </div>
        </div>
        <div class="p-3 ">
            <p class="fs-4">BTR is located at 5 minutes walking distance in north from the main
           entrance of Bardia National Park. BTR has 50 Deluxe rooms,presidential rooms, and also 10 Cottage rooms, 
           2 conference hall with sitting capacity of 150 and 100 persons, a dining hall with capacity of 50 person at a 
           time as well as enough open sitting space  outside the dining hall. A large cottage area for bonfire with two barbeque 
           station is also available. </p>
   
        </div>

    </div>
  
    <?php require('inc/footer.php'); ?>  

</body>
</html>