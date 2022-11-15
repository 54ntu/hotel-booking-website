<?php
    session_start();
    require('inc/db_config.php');
    require('inc/important.php');
    session_regenerate_id(true);
?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>user management panel  </title>
    <?php require('inc/link.php');?>
    <style>
        .h-line{
            width: 150px;
            margin:auto 0 ;
            height: 1.7px;
            }

    </style>
</head>

<body>
    <?php require('inc/header.php');?>
    <div class="container-fluid " id="main-content">
      <div class="row">
         <div class="col-lg-10 ms-auto p-4 overflow-hidden ">
            
            <div class="content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="page-title h-font ">Registered Users</h2>
                            <div class="h-line bg-dark mb-lg-4 md-md-2"></div>
                                <!-- Zero Configuration Table -->
                                <div class="panel panel-default">							
                                    <div class="table-responsive">						
                                        <table  class="display table table-striped table-bordered table-hover border text-center " cellspacing="0" style="min-width: 1300px;">
                                            <thead class="sticky-top">
                                                <tr class="bg-dark text-light">
                                                    <th>id</th>
                                                    <th> Name</th>
                                                    <th>Email </th>
                                                    <th>Contact no</th>										
                                                    <th>Address</th>
                                                    <th>pincode</th>
                                                    <th>DOB</th>
                                                    <th>Country</th>
                                                    <th>Password</th>
                                                    <th>status</th>
                                                    <th>Date</th>
                                                    <!-- <th>Action</th> -->

                                                    										
                                                </tr>
                                            </thead>  
                                            <tbody id="tbl_user">

                                            </tbody>
                                            
                                        </table>						
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
	        </div>
         </div>
        </div>
    </div>

<?php require('inc/scripts.php') ?>
<script>
 

 function get_users(){

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/user.php", true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        
        xhr.onload = function() {
            document.getElementById('tbl_user').innerHTML=this.responseText;
            

        }
        xhr.send('get_users');


 }




 function toggle_status(id,val)
   {
            
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/user.php", true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            
            xhr.onload = function() {
                if(this.responseText==1){
                    alert('success','status toggled');
                    get_users();
                }
                else{
                    alert('error','server down -status toggle');
                }
               

            }
            xhr.send('toggle_status=' +id+'&value=' +val);
 }


 window.onload = function(){
    get_users();
 }
 

//  function rem_user(user_id)
// {
//         if(confirm("Are you sure, you want to delete this user")){

//             let data = new FormData();
//             data.append('user_id', user_id);
//             data.append('rem_user','');

//             let xhr = new XMLHttpRequest();
//             xhr.open("POST", "ajax/user.php", true);

//             xhr.onload =function(){
//             if(this.responseText == 1){
//                 alert('success','user deleted successfully!');
//                 get_users();
//                 }
//                 else{
//                 alert('error','user deletion failed!');
//                 }
//             }
//             xhr.send(data);
//         }
           

// }
</script>	
</body>
</html>