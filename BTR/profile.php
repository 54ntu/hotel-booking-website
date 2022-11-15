<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BTR-profile page</title>
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

<body >
    <?php
    
    require('inc/header.php'); 
    if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)){
        redirect('index.php');
    }
    $user_result = select("SELECT * FROM `register` WHERE `id`=? LIMIT 1", [$_SESSION['uID']], "i");

    if(mysqli_num_rows($user_result)==0){
        redirect('index.php');
    }
    $user_fetch = mysqli_fetch_assoc($user_result);

    ?>

    <div class="container ">
        <div class="row">
            <div class=" col-12 my-5 px-4">
                <h2 class="fw-bold h-font ">Profile  </h2>
            </div>
             
        </div>
    </div>


    <div class=" col-12 p-4  mb-5  ">
        <div class="bg-white  p-3 p-md-4 rounded shadow">
            <form id="profile_info">
                <h6 class="mb-3 fw-bold h-font">Basic information</h6>
                    <div class="row mb-5">
                        <div class="col-md-4 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" value="<?php echo $user_fetch['name'] ?>" class="form-control shadow-none" required>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                        <label class="form-label">Phone No</label>
                        <input type="Number" name="phone" value="<?php echo $user_fetch['phone'] ?>" class="form-control shadow-none" required>
                        </div>
                       
                        <div class="col-md-4 mb-3">
                        <label class="form-label">Pincode</label>
                        <input type="Number" name="pincode" value="<?php echo $user_fetch['pincode'] ?>" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-4 mb-3">
                        <label class="form-label">DOB</label>
                        <input type="date" name="dob" value="<?php echo $user_fetch['DOB'] ?>" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-8 ">
                        <label class="form-label">Address</label>
                        <textarea name="address"  class="form-control shadow-none" required> <?php echo $user_fetch['Address'] ?></textarea>
                        </div>
                    </div>
                    <div class=" d-flex">
                    <button type="submit"  class="btn btn-dark custom-bg  shadow-none mb-2 me-2">save changes</button>
                    </div>
                    

            </form>

        </div>

    </div>

    <?php require('inc/footer.php'); ?>

    <script>
        let profile_info =document.getElementById('profile_info');
        profile_info.addEventListener('submit',function(e){
            e.preventDefault();
            let data = new FormData();
            data.append('profile_info','');
            data.append('name',profile_info.elements['name'].value);
            
            data.append('phone',profile_info.elements['phone'].value);
            data.append('pincode',profile_info.elements['pincode'].value);
            data.append('dob',profile_info.elements['dob'].value);
            data.append('address',profile_info.elements['address'].value);

                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/profile_ajax.php", true);

                xhr.onload = function() {
                   if(this.responseText == 'phone_already'){

                   }
                   
                   else if(this.responseText == 0){
                    alert('error','no changes made');

                   }
                   else{
                    alert('success','save changes!');
                   }
                    
                }
                xhr.send(data);

        });
       
    </script>



</body>

</html>