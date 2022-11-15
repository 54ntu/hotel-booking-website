<?php
    require('inc/important.php');  
    require('inc/db_config.php');

    session_start();
        if((isset( $_SESSION['adminLogin']) &&  $_SESSION['adminLogin']==true)){
           redirect('dashboard.php');
        }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/login.css" />
    <?php   require('inc/link.php'); ?>
</head>

<body class="bg-light">
    <div class="login-form text-center rounded bg-white shadow overflow-hidden">
        <form method="POST">
            <h4 class="bg-dark text-white py-3">Admin Login Panel</h4>
            <div class="p-4">
                <div class="mb-3">
                    <input type="text" name="admin_name" required class="form-control shadow-none text-center" placeholder="Username" />
                </div>
                <div class="mb-4">
                    <input type="password" name="admin_pass" required class="form-control shadow-none text-center" placeholder="password" />
                </div>
                <button type="submit" name="login" class="btn text-red btn-outlined-black w-100 shadow-none">
                    Login
                </button>
            </div>
        </form>
    </div>

   <?php 
     if(isset($_POST['login']))
     {
        $frm_data=filteration($_POST);
       
        $query ="select * from `admin_data` where `admin_name`=? AND `admin_pass`=?";
        $values = [$frm_data['admin_name'],$frm_data['admin_pass']];
        $datatype="ss";

        $var2=select($query,$values,$datatype);
        if($var2-> num_rows==1){
            $row=mysqli_fetch_assoc($var2);
            $_SESSION['adminLogin']=true;
            $_SESSION['adminId']=$row['sr_no'];
            redirect('dashboard.php');

        }
        else{
            alert('error', 'Login failed-Invalid username or password!');
        }
        

        
     }
   
   
   
   ?>

   


    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>