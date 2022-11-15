<?php require('inc/important.php'); ?>
<?php require('inc/db_config.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Panel rooms</title>
    <?php require('inc/link.php'); ?>


    <style>
        .custom-btn {
            background-color: #2ec1ac;

        }

        .h-line {
            width: 150px;
            margin: auto 0;
            height: 1.7px;
        }
    </style>

    <link rel="stylesheet" href="../admin//css/common.css" />

</head>

<body class="bg-light">
    <?php require('inc/header.php'); ?>
        <div class="container-fluid " id="main-content">
            <div class="row">
                <div class="col-lg-10 ms-auto p-4 overflow-hidden ">
                    <h3 class="mb-4 h-font">Rooms</h3>
                    <div class="h-line bg-dark mb-lg-2"></div>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="text-end mb-4">
                                <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#add_room_m">
                                    <i class="bi bi-plus "></i> Add
                                </button>
                            </div>
                            <div class="table-responsive-lg" style="height: 450px; overflow-y:scroll;">
                                <table class="table table-hover border text-center">
                                    <thead class="sticky-top">
                                        <tr class="bg-dark text-light">
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Guests</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody id="room_data">
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>

                    <!-- start add room Modal -->
                    <div class="modal fade" id="add_room_m" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <form id="add_room_form" autocomplete="off">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Room</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="name" class="form-control shadow-none" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Prices</label>
                                                <input type="number" name="price" class="form-control shadow-none" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Quantity</label>
                                                <input type="number" min='1' name="quantity" class="form-control shadow-none" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Adult (Max.) </label>
                                                <input type="number" min='1' name="adult" class="form-control shadow-none" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Children (Max.) </label>
                                                <input type="number" min='1' name="children" class="form-control shadow-none" required>
                                            </div>
                                            

                                            <!-- code for features -->                                       
                                            <div class="col-12 mb-3">
                                                <label class="form-label fw-bold">Features</label>
                                                <div class="row">
                                                    <?php
                                                    $res = selectAll('features');
                                                    while ($opt = mysqli_fetch_assoc($res)) {
                                                        echo "                                                
                                                            <div class='col-md-3 mb-1'>
                                                                <label>
                                                                <input type='checkbox' name='feature' value='$opt[id]' class='form-check-input shadow-none '>
                                                                $opt[name]
                                                                </label>                                                    
                                                            </div>                                               
                                                        ";
                                                    }

                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label fw-bold">Description</label>
                                                <textarea name="desc" rows="4" class="form-control shadow-none" required></textarea>

                                            </div>

                                            <!-- code for facility 
                                            <div class="col-12 mb-3">
                                                <label class="form-label fw-bold">Facility</label>
                                                <div class="row">
                                                    <?php
                                                    $res = selectAll('facility');
                                                    while ($opt = mysqli_fetch_assoc($res)) {
                                                        echo "                                                
                                                            <div class='col-md-3 mb-1'>
                                                                <label>
                                                                <input type='checkbox' name='facilities' value='$opt[id]' class='fomr-check-input shadow-none '>
                                                                $opt[name]
                                                                </label>                                                    
                                                            </div>                                               
                                                        ";
                                                    }

                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label fw-bold">Description</label>
                                                <textarea name="desc" rows="4" class="form-control shadow-none" required></textarea>

                                            </div> -->

                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn  custom-btn text-dark shadow-none">SUBMIT</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                    <!-- end of add room  modal  -->
                </div>
            </div>
        </div>


        <!-- Manage room images -->
        <div class="modal fade" id="room_images" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Room Name</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="image-alert"></div>
                    <div class="border-bottom border-3 pb-3 mb-3">
                        <form id="room_image_form">
                            <label class="form-label fw-bold">Add image</label>
                            <input type="file" name="image" accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none mb-3" required>
                            <button  class="btn  custom-btn text-dark shadow-none">ADD</button>
                            <input type="hidden" name="room_id">
                        </form>

                    </div>
                    <div class="table-responsive-lg" style="height: 450px; overflow-y:scroll;">
                                <table class="table table-hover border text-center">
                                    <thead class="sticky-top">
                                        <tr class="bg-dark text-light">
                                            <th scope="col">Image</th>  
                                            <th scope="col">Thumb</th>                                          

                                            <th scope="col">Delete</th>
                                       </tr>
                                    </thead>
                                    <tbody id="image_room_data">

                                    </tbody>
                                </table>
                            </div>

               </div>
           
            </div>
        </div>
        </div>

                

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  
    <?php require('inc/scripts.php'); ?>

    <script>
        let add_room_form = document.getElementById('add_room_form');

        add_room_form.addEventListener('submit', function(e) {
            e.preventDefault();
            add_room();
        });


        function add_room()
        {

            let data = new FormData();
            data.append('add_room', '');
            data.append('name', add_room_form.elements['name'].value);
            data.append('prices', add_room_form.elements['price'].value);
            data.append('quantity', add_room_form.elements['quantity'].value);
            data.append('adult', add_room_form.elements['adult'].value);
            data.append('children', add_room_form.elements['children'].value);
            data.append('desc', add_room_form.elements['desc'].value);
            //  create  features named array and then push the value that are checked into the form       
            let features = [];
            add_room_form.elements['feature'].forEach(element => {
                    if(element.checked){
                    features.push(element.value);
                    }
                });

            //   create  facilities named array and then push the value that are checked into the form  
                // let facility = [];
                // add_room_form.elements['facilities'].forEach(element => {
                //     if(element.checked){
                //     facility.push(element.value);
                //     }
                // });

            data.append('features', JSON.stringify(features));
                data.append('facility', JSON.stringify('facility'));

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/add_room.php", true);

            xhr.onload = function() {
                var myModal = document.getElementById('add_room_m');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if(this.responseText == 1) {
                    alert('success','New room added!');
                    add_room_form.reset();
                    get_all_rooms();


                } else {
                    alert('error', 'server Down! rooms');
                }
            }
            xhr.send(data);

      }


        function get_all_rooms(){
            
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/add_room.php", true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            
            xhr.onload = function() {
                document.getElementById('room_data').innerHTML=this.responseText;
               

            }
            xhr.send('get_all_rooms');
        }


       
   
        function toggle_status(id,val){
            
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/add_room.php", true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            
            xhr.onload = function() {
                if(this.responseText==1){
                    alert('success','status toggled');
                    get_all_rooms();
                }
                else{
                    alert('error','server down -status toggle');
                }
               

            }
            xhr.send('toggle_status=' +id+'&value=' +val);
        }



        let room_image_form = document.getElementById('room_image_form');
        room_image_form.addEventListener('submit',function(e){
            e.preventDefault();
            add_image();

        })


        function add_image(){
            let data = new FormData();
            data.append('image', room_image_form.elements['image'].files[0]);
            data.append('room_id', room_image_form.elements['room_id'].value);
            data.append('add_image','');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/add_room.php", true);

         xhr.onload =function(){
            if(this.responseText == 'inv_img'){
                    alert('error','only jpg,png,webp jpeg images are allowed!','image-alert');

                }
                else if(this.responseText == 'inv_size'){
                    alert('error','image should be less than 1 MB!','image-alert');
                }
                else if(this.responseText == 'upd_failed'){
                    alert('error','image upload failed.Server down!','image-alert');
                }
                else{
                    alert('success','new room added!' ,'image-alert');
                    room_images( room_image_form.elements['room_id'].value,document.querySelector("#room_images .modal-title").innerText);
                    room_image_form.reset();
                   
                }


            }
            xhr.send(data);

        }


    function room_images(id,rname){
        document.querySelector("#room_images .modal-title").innerText= rname;
        room_image_form.elements['room_id'].value = id;
        room_image_form.elements['image'].value = '';

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/add_room.php", true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        
        xhr.onload = function() {
            document.getElementById('image_room_data').innerHTML = this.responseText;
        }
        xhr.send('get_room_images='+id);

    }


     function rem_image(image_id,room_id)
     {
            let data = new FormData();
            data.append('image_id', image_id);
            data.append('room_id', room_id);
            data.append('rem_image','');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/add_room.php", true);

         xhr.onload =function(){
            if(this.responseText == 1){
                alert('success','Image removed!' ,'image-alert');
                room_images( room_id,document.querySelector("#room_images .modal-title").innerText);
                }
                else{
                alert('error','Image removal failed!' ,'image-alert');
                }
            }
            xhr.send(data);


     }

     function remove_room(room_id)
     {
        if(confirm("Are you sure, you want to delete this room")){

            let data = new FormData();
            data.append('room_id', room_id);
            data.append('remove_room','');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/add_room.php", true);

            xhr.onload =function(){
            if(this.responseText == 1){
                alert('success','Room deleted successfully!');
                get_all_rooms();
                }
                else{
                alert('error','Room deletion failed!');
                }
            }
            xhr.send(data);
        }
           


     }


     
     function thumb_image(image_id,room_id)
     {
        let data = new FormData();
        data.append('image_id', image_id);
        data.append('room_id', room_id);
        data.append('thumb_image','');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/add_room.php", true);

        xhr.onload =function(){
        if(this.responseText == 1){
            alert('success','Image thumbnail changed!' ,'image-alert');
            room_images( room_id,document.querySelector("#room_images .modal-title").innerText);
            }
            else{
            alert('error','thumbnailupdate failed!' ,'image-alert');
            }
        }
        xhr.send(data);


     }

    window.onload= function(){
        get_all_rooms();
    }
    </script>
</body>

</html>