<?php 
  require('../inc/important.php');
  require('../inc/db_config.php');
  adminLogin();
  
  
  if(isset($_POST['get_booking']))
  {
    $query = " SELECT bo.*, bd.*  FROM `booking_order` bo INNER JOIN `booking_details` bd ON  bo.booking_id = bd.booking_id 
    where bo.booking_status= 'confirmed' ORDER BY bo.booking_id  ASC" ;

    $res = mysqli_query($conn,$query);
    $i =1;
    $table_data ="";

    while($data = mysqli_fetch_assoc($res))
    {


        $date = date("d-m-y",strtotime($data['datetime']));
        $checkin = date("d-m-y",strtotime($data['check_in']));
        $checkout = date("d-m-y",strtotime($data['check_out']));

        $table_data.="
        <tr>
            <td>$i</td>
            <td>
            <span class ='badge bg-primary'>
              User ID : $data[user_id]
              </span>
              <br>
              <b>Name:</b> $data[user_name]
              <br>
              <b>Phone No:</b> $data[phonen0]
                        
            </td>
            <td>
              <b>Room Name:</b> $data[room_name]
              <br>
              <b>Room price: </b> $data[price]
            </td>
            <td>
              <b>check in:</b> $checkin
              <br>
              <b>check out: </b> $checkout
              <br>
              <b>Amount to be paid: </b> $data[trans_amt]
              <br>
              <b>date of booking: </b>$date
              <br>
              <b>booking id: </b> $data[booking_id]

            </td>
            
        
        </tr>
        
        ";
        $i ++;
    }
    echo $table_data;

      
  }



   

?>  