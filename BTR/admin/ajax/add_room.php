<?php
require('../inc/important.php');
require('../inc/db_config.php');
adminLogin();


    if(isset($_POST['add_room'])){
      $feature=filteration(json_decode($_POST['features']));
      // $facilities=filteration(json_decode($_POST['facility']));
      $frm_data= filteration($_POST);
      $flag=0;
      $q1= "INSERT INTO `room` ( `name`, `price`, `quantity`, `adult`, `children`, `description`) VALUES (?,?,?,?,?,?)";
      $values=[$frm_data['name'],$frm_data['prices'],$frm_data['quantity'],$frm_data['adult'],$frm_data['children'],$frm_data['desc']];
      if(insert($q1,$values,'siiiis')){
        $flag=1;

      } 
      $room_id = mysqli_insert_id($conn);
      $q2 ="INSERT INTO `room_feature` (`room_id`, `feature_id`) VALUES (?,?)";
      // creating a prepare statement 

      if($stmt = mysqli_prepare($conn,$q2)){
        foreach ($feature as $f) {
          mysqli_stmt_bind_param($stmt,'ii',$room_id,$f);
          mysqli_stmt_execute($stmt);
          
        }
        mysqli_stmt_close($stmt);
      }
      else{
        $flag=0;
        die('query cannnot be prepared-insert');
      }


      if($flag){
        echo 1;
      }
      else{
        echo 0;
      }
    }
     
    // code for get_all_rooms index

    if(isset($_POST['get_all_rooms'])){
      $res=select("SELECT * FROM `room` WHERE `removed`=?",[0],'i');
      $i=1;

      $data='';

      while($row= mysqli_fetch_assoc($res)){
      if($row['status']==1){
      $status ="<button onclick='toggle_status($row[id],0)' class='btn btn-sm btn-dark shadow-none' >active</button>";
      }
      else{
      $status ="<button onclick='toggle_status($row[id],1)' class='btn btn-sm btn-warning shadow-none'>Inactive</button>";
      }
      $data.="
      <tr class='align-middle'>
        <td>$i</td>
        <td>$row[name]</td>
        <td>
          <span class='badge rounded-pill bg-light text-dark'>
          Adult:$row[adult]              
          </span><br>
          <span class='badge rounded-pill bg-light text-dark'>
          Children:$row[children]              
          </span>
        </td>
        <td>$row[price]</td>
        <td>$row[quantity]</td>
        <td>$status</td>
          <td>
            <button type='button' onclick=\" room_images($row[id],'$row[name]')\" class='btn btn-info shadow-none' data-bs-toggle='modal' data-bs-target='#room_images'>
            <i class='bi bi-images '></i>
            </button>
            <button type='button' onclick='remove_room($row[id])' class='btn btn-danger shadow-none'>
              <i class='bi bi-trash '></i>
              </button>
          </td>  
            


      </tr>        

      ";
      $i++;
      }
      echo $data;
    }
    // code end for get_all_rooms index

    // code for get_room index 

    if(isset($_POST['get_room'])){
      $frm_data=filteration($_POST);

      $res1=select("SELECT * FROM `room` WHERE `id`=?",[$frm_data['get_room']],'i');
      $res2=select("SELECT * FROM `room_feature` WHERE  `room_id`=?",[$frm_data['get_room']],'i');

      $roomdata=mysqli_fetch_assoc($res1);
      $features= [];
      if(mysqli_num_rows($res2)>0){
        while($row=mysqli_fetch_assoc($res2)){
          array_push($features,$row['feature_id']);

        }
      }

      $data=["roomdata" => $roomdata,"features" => $features];
      $data=json_encode($data);
      echo $data;


    }

    if(isset($_POST['toggle_status'])) {

          $frm_data=filteration($_POST);
          $q= "UPDATE `room` SET `status`=? WHERE `id`=?";
          $val=[$frm_data['value'],$frm_data['toggle_status']];
          if(update($q,$val,'ii')){
            echo 1;

          }
          else{
            echo 0;

            }
    }

// code for adding the room image 
    if(isset($_POST['add_image'])){
      $frm_data = filteration($_POST);
      $img_r = uploadImage($_FILES['image'],ROOMS_FOLDER);

      if($img_r == 'inv_size'){
        echo $img_r;
      }
      else if ($img_r == 'inv_img'){
        echo $img_r;
      }
      else if($img_r == 'upd_failed'){
        echo $img_r;
      }
      else{
          $q="INSERT INTO `room_images`(`room_id`, `image`) VALUES (?,?)";
          $values=[$frm_data['room_id'],$img_r];
          $res=insert($q,$values,'is');
          echo $res;

    }


}
// end code for adding the room image 


// code for fetching the room images 
  if(isset($_POST['get_room_images'])){
    $frm_data = filteration($_POST);
    $res = select("SELECT * FROM `room_images` where `room_id`=?", [$frm_data['get_room_images']], 'i');
    $path = ROOMS_IMG_PATH;

    while($row = mysqli_fetch_assoc($res)){
      if($row['thumb'] ==1){
        $thumb_btn ="<i class='bi bi-check-lg text-ligth bg-success px-2 py-1 rounded fs-3'></i>";
      }
      else{
        $thumb_btn ="<button onclick='thumb_image($row[sr_no],$row[room_id])' class='btn  btn-secondary shadow-none'>
        <i class='bi bi-check-lg'></i>
       </button>";
      }
     
      echo<<<data
      <tr class='align-middle'>
          <td><img src='$path$row[image]' class='img-fluid' width='300px' height='200px'></td>
          <td>$thumb_btn</td>
          <td>
            <button onclick='rem_image($row[sr_no],$row[room_id])' class='btn  btn-danger shadow-none'>
             <i class='bi bi-trash'></i>
            </button>
          </td>
      </tr>

      data;
    }

    


  }

  // code for rem_images 
  if(isset($_POST['rem_image']))
  {
    $frm_data= filteration($_POST);
    $values= [$frm_data['image_id'],$frm_data['room_id']];
    $q= "SELECT * FROM `room_images` WHERE `sr_no`=? AND `room_id`=?";
    $res = select($q,$values,'ii');
    $img = mysqli_fetch_assoc($res);

    if(deleteImage($img['image'],ROOMS_FOLDER)){
      $q1= "DELETE FROM `room_images` WHERE `sr_no`=?  AND `room_id`=?";
      $res = delete($q1,$values,'ii');
      echo $res;
    }
    else{
      echo 0;
    }

  }

  if(isset($_POST['remove_room'])){
    $frm_data= filteration($_POST);
    $res =select("SELECT * FROM `room_images` WHERE `room_id`=?",[$frm_data['room_id']],'i');

    while($row = mysqli_fetch_assoc($res)){
      deleteImage($row['image'],ROOMS_FOLDER);

    }
    $res1 =delete("DELETE FROM `room_images` WHERE `room_id`=?",[$frm_data['room_id']],'i');
    $res2 =delete("DELETE FROM `room_feature` WHERE `room_id`=?",[$frm_data['room_id']],'i');
    $res3 =update("UPDATE `room` SET  `removed`=? WHERE `id`=?",[1,$frm_data['room_id']],'ii');

    if($res1 || $res2 ||$res3){
      echo 1;
    }
    else{
      echo 0;
    }

  }

  if(isset($_POST['thumb_image']))
  {
    $frm_data= filteration($_POST);
    $q1 = "UPDATE `room_images` SET `thumb`=? WHERE `room_id`=?";
    $value1 = [0,$frm_data['room_id']];
    $res1 = update($q1,$value1,'ii');

    $q2 = "UPDATE `room_images` SET `thumb`=? WHERE `sr_no`=? AND `room_id`=?";
    $value2 = [1,$frm_data['image_id'],$frm_data['room_id']];
    $res2 = update($q2,$value2,'iii');

    echo  $res2;
  }





?>