<?php

 require('../admin/inc/important.php'); 
 require('../admin/inc/db_config.php'); 


 if(isset($_POST['register']))
 {

    $data = filteration($_POST);

    if(strlen($data['pass'])<8){
        echo 'inv_pass';
        exit;
    }
    
    if($data['pass'] != $data['cpass']){
        echo 'pass-missmatch';
        exit;
    }
    if(intval($data['dob'])>2022){
        echo 'inv_dob';
        exit;
    }

    if(!preg_match('/^[0-9]{10}+$/', $data['phone_no'])){

        echo 'inv_phone';
       
    }
  
    else{


        // check user exits or not 
        $u_exist = select("SELECT * FROM `register` WHERE `email`=? OR `phone`=? LIMIT 1",[$data['email'],$data['phone_no']],"ss");

        if(mysqli_num_rows($u_exist)!=0){
            $u_exist_fetch = mysqli_fetch_assoc($u_exist);
            echo ($u_exist_fetch['email']== $data['email'])? 'email-already' : 'phone-already';
            exit;

        }

        // $enc_pass = password_hash($data['pass'],PASSWORD_BCRYPT);

        $query ="INSERT INTO `register`(`name`, `phone`, `email`, `Address`, `country`, `DOB`, `password`, `pincode`) VALUES (?,?,?,?,?,?,?,?)";
        $value =[$data['name'],$data['phone_no'],$data['email'],$data['address'],$data['country'],$data['dob'],$data['pass'],$data['pincode']];

        if (insert($query,$value,'ssssssss')){
        echo 1;
        }
        else{
        echo 'ins_failed';
        }
    }
 }


 if(isset($_POST['login']))
{
    $data = filteration($_POST);

    $u_exist = select("SELECT * FROM `register` WHERE `email`=? OR `phone`=? LIMIT 1",[$data['email_mob'],$data['email_mob']],"ss");

    if(mysqli_num_rows($u_exist)==0){
        echo 'inv_email_mob';

        
    }
    else{
        $u_fetch =mysqli_fetch_assoc($u_exist);
        if($u_fetch['status']==0){
            echo 'Inactive';
        }
        else{
            if($data['pass'] != $u_fetch['password']){
                echo 'invalid_pass';
            }
            else{
                session_start();
                $_SESSION['login'] =true;
                $_SESSION['uID']= $u_fetch['id'];
                $_SESSION['uName']= $u_fetch['name'];
                $_SESSION['uPhone']= $u_fetch['phone'];
                echo 1;


            }
        }
    }

}




if(isset($_POST['forgot'])){

    $data = filteration($_POST);
    $email_check = select("SELECT * FROM `register` WHERE `email`=? ",[$data['email']],"s");

    if(mysqli_num_rows( $email_check)==0){
        echo 'email_inv';
    }
    else{
        if($data['npass'] != $data['cpass']){
            echo 'pass-missmatch';
            exit;
        }
        if(strlen($data['npass'])<8){
            echo 'inv_pass';
            exit;
        }
          else{
              $query="UPDATE `register` SET `password`=? WHERE `email`=?";
              $values= [$data['npass'],$data['email']];
              if(update($query,$values,'ss')){
                echo 1;
               
              }
              else{
                echo 'fail';
              }
              
             
          }
    }




}



?>