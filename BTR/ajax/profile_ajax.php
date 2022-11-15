<?php 

require('../admin/inc/important.php'); 
require('../admin/inc/db_config.php'); 


if(isset($_POST['profile_info']))
{
    $frm_data = filteration($_POST);
    session_start();

    $u_exist = select("SELECT * FROM `register` WHERE  `phone`=? AND `id`!= ? LIMIT 1",[$frm_data['phone'],$_SESSION['uID']],"si");


    if(mysqli_num_rows($u_exist)!=0){
        echo 'phone-already';
        
    }
    else{
      $query = "UPDATE `register` SET `name`=?,`phone`=?,`Address`=?,`DOB`=?,`pincode`=? wHERE `id`=?";
      $values = [$frm_data['name'], $frm_data['phone'], $frm_data['address'], $frm_data['dob'], $frm_data['pincode'], $_SESSION['uID']];

      if (update($query, $values, 'sssssi')) {
         $_SESSION['uName'] = $frm_data['name'];
         echo 1;
      } else {
         echo 0;
      }

    }
   
   
    


}


?>