<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BTR-Bardiya Tiger Resort</title>
  <?php require('inc/links.php'); ?>

  <style>
    .cont_cls {
      position: absolute;
      left: 0;
      right: 0;
      top: 50%;
      text-align: left;
      transform: translateY(-50%);
      color: white;
    }

    .roomdiv:hover {
      background-color: #bbdefb;

    }

    .h-line {
      width: 150px;
      margin: 0 auto;
      height: 1.7px;
    }

    .rooms:hover {
      background-color: #bbdefb;

    }

    .custom-bg {
      background-color: #2ec1ac;
    }
  </style>
</head>

<body>
  <?php
  require('inc/header.php');
  $checkin_default_value = "";
  $checkout_default_value = "";
  $adult_default_value = "";
  $children_default_value = "";

  if (isset($_POST['check_availability'])) {
    $frm_data = filteration($_POST);

    $checkin_default_value = $frm_data['checkin'];
    $checkout_default_value = $frm_data['checkout'];
    $adult_default_value = $frm_data['adult'];
    $children_default_value = $frm_data['children'];
  }




  ?>

  <!--start of hero section  -->

  <div class="container-fluid px-lg-4 mt-4">
    <img src="images/rooms.jpg" class="d-block w-100" height="500px" width="1500px">
    <h2 class="fw-bold h-font text-center  text-dark cont_cls">OUR ROOMS</h2>
  </div>
  <!--end of hero section  -->




  <!-- start of rooms details  -->

  <div class="container-fluid " data-aos="fade-up">
    <div class="row">
      <div class=" roomtitle mt-5 mb-5" style="text-align: center">
        <h2 class="h-font">Select Rooms</h2>
        <div class="h-line bg-dark  mb-3  align-items-center"></div>
      </div>

      <!-- start  filters section  -->
      <div class="col-lg-3 md-lg-0 mb-5  mt-lg-5 mt-mb-3 mt-sm-2 ps-4" data-aos="fade-up">
        <nav class="navbar navbar-expand-lg rouded shadow ">
          <div class="container-fluid flex-lg-column align-items-stretch">
            <a class="navbar-brand" href="#">Filters</a>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#filterdropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <!-- check availability section  -->
            <div class="collapse navbar-collapse align-items-stretch flex-lg-column mt-2" id="filterdropdown">
              <div class="border bg-light p-3 rounded mb-2">
                <h5 class=" d-flex align-items-center justify-content-between mb-3" style="font-size: 18px">
                  <span> CHECK AVAILABILITY</span>
                  <button onclick="check_avail_clear()" class="btn btn-sm text-secondary d-none" id="check_avail_btn">Reset</button>
                </h5>
                <label class="form-label">Check in</label>
                <input type="date" class="form-control shadow-none mb-1" id="checkin" value="<?php echo $checkin_default_value ?>" onchange="check_avail_filter()" />
                <label class="form-label">Check Out</label>
                <input type="date" class="form-control shadow-none mb-1" id="checkout" value="<?php echo $checkout_default_value ?>" onchange="check_avail_filter()" />
              </div>

              <!-- Guests section  -->
              <div class="border bg-light p-3 rounded mb-5">
                <h5 class=" d-flex align-items-center justify-content-between mb-3" style="font-size: 18px">
                  <span> GUESTS</span>
                  <button onclick="guest_clear()" class="btn btn-sm text-secondary d-none" id="guest_btn">Reset</button>
                </h5>
                <div class="d-flex">
                  <div class="me-4">
                    <label class="form-label">Adults</label>
                    <input type="number" oninput="guest_filter()" class="form-control shadow-none" value="<?php echo $adult_default_value ?>" id="adult" min="1" ; />
                  </div>
                  <div>
                    <label class="form-label">Children</label>
                    <input type="number" id="children" min="1" oninput="guest_filter()" value="<?php echo $children_default_value ?>" class="form-control shadow-none" />
                  </div>
                </div>
              </div>

              
            </div>
          </div>
        </nav>
      </div>
      <!-- end filters section   -->

      <!-- start card section   -->
      <div class="col-lg-9 col-md-12 px-4 " id="room_data">


        <?php


        ?>

      </div>

    </div>
  </div>

  <script>
    let room_data = document.getElementById('room_data');
    let checkin = document.getElementById('checkin');
    let checkout = document.getElementById('checkout');
    let check_avail_btn = document.getElementById('check_avail_btn');



    // accessing the data of the guests 
    let adult = document.getElementById('adult');
    let children = document.getElementById('children');
    let guest_btn = document.getElementById('guest_btn');

  





    // code for checking the availability of the rooms 
    function fetch_room() {

      let chk_avail = JSON.stringify({
        checkin: checkin.value,
        checkout: checkout.value
      })

      let guest = JSON.stringify({
        adult: adult.value,
        children: children.value
      })

     


      let xhr = new XMLHttpRequest();
      xhr.open("GET", "ajax/rooms_checkavail.php?fetch_room&chk_avail=" + chk_avail + "&guests=" + guest , true);
      xhr.onprogress = function() {
        room_data.innerHTML = `<div class="spinner-border text-info mb-2 d-block mx-auto" id="loader" role="status">
              <span class="visually-hidden">Loading...</span>
          </div>`;
      }

      xhr.onload = function() {
        room_data.innerHTML = this.responseText;

      }
      xhr.send();
    }


    function check_avail_filter() {
      if (checkin.value != '' && checkout.value != '') {
        fetch_room();
        check_avail_btn.classList.remove('d-none');
      }
    }

    function check_avail_clear() {
      checkin.value = '';
      checkout.value = ''
      check_avail_btn.classList.add('d-none');
      fetch_room();

    }


    // code for filtering on the basis of guest number 
    function guest_filter() {
      if (adult.value > 0 || children.value > 0) {
        fetch_room();
        guest_btn.classList.remove('d-none');
      }
    }


    function guest_clear() {
      adult.value = '';
      children.value = '';
      guest_btn.classList.add('d-none');
      fetch_room();

    }


  


    fetch_room();
  </script>
  <?php require('inc/footer.php'); ?>


</body>

</html>