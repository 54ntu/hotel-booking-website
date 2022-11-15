<?php 

require('../inc/important.php');
require('../inc/db_config.php');
adminLogin();


if(isset($_POST['get_users']))
{
    $res=selectAll('register');

    $i=1;

    $data='';

    while($row= mysqli_fetch_assoc($res))
    {
        $del_btn="<button onclick='rem_user($row[id])' class='btn  btn-danger shadow-none'>
        <i class='bi bi-trash'></i>
       </button>";
        $status = "<button onclick='toggle_status($row[id],0)' class='btn btn-sm btn-dark shadow-none' >active</button>";
        if(!$row['status']){
        $status = "<button onclick='toggle_status($row[id],1)' class='btn btn-sm btn-danger shadow-none' >Inactive</button>";

        }

        $data.="
        <tr>
        
        <td>$i</td>
        <td>$row[name]</td>
        <td>$row[email]</td>
        <td>$row[phone]</td>
        <td>$row[Address]</td>
        <td>$row[pincode]</td>
        <td>$row[DOB]</td>
        <td>$row[country]</td>
        <td>$row[password]</td>
         <td>$status</td>
        <td>$row[datetime]</td>
       
        
        </tr>
        
        ";
    $i++;
    }
    echo $data;
}



if(isset($_POST['toggle_status'])) {

    $frm_data=filteration($_POST);
    $q= "UPDATE `register` SET `status`=? WHERE `id`=?";
    $val=[$frm_data['value'],$frm_data['toggle_status']];
    if(update($q,$val,'ii')){
      echo 1;

    }
    else{
      echo 0;

      }
}

// if(isset($_POST['rem_user'])){
//     $frm_data= filteration($_POST);
   
//     $res1 =delete("DELETE FROM `register` WHERE `id`=?",[$frm_data['user_id']],'i');
   

//     if($res1 ){
//       echo 1;
//     }
//     else{
//       echo 0;
//     }

//   }


?>