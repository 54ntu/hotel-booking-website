<?php
   //frontend purpose data
    define('SITE_URL','http://127.0.0.1/BTR/');
    define('FACILITIES_IMAGE_PATH',SITE_URL.'images/feature/');
    define('ROOMS_IMG_PATH',SITE_URL.'images/rooms/');
    

// i have to solve the problem related to image folder path so that it will display the svg image 

    //bckend purpose data
    define('UPLOAD_IMAGE_PATH',$_SERVER['DOCUMENT_ROOT'].'/BTR/images/');
    define('FACILITY_FOLDER','feature/');
    define('ROOMS_FOLDER','rooms/');


    
function adminLogin(){
    session_start();
    if(!(isset( $_SESSION['adminLogin']) &&  $_SESSION['adminLogin']==true)){
        echo" <script>
            window.location.href='adminlogin.php';
            </script>";
    }
    session_regenerate_id(true);


}


function redirect($url){
echo"
    <script>
    window.location.href='$url';
    </script>";
}

function alert($type,$msg)
{
    $bs_class=($type=="success")? "alert-success" :"alert-danger";
    echo <<<alert
        <div class="alert $bs_class alert-dismissible fade show  custom_alert" role="alert">
            <strong class="me-2">$msg</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    alert;

    
}


function uploadSVGImage($image,$folder){
    $valid_mime =['image/svg +xml'];
    $img_mime=$image['type'];

    if(!in_array($img_mime,$valid_mime)){
        return 'inv_img'; //invalid image mime or format

    }

    else if(($image['size']/(1024*1024))>1){
        return 'inv_size'; //invalid size greater than 1 MB

    }

    else{
        $ext= pathinfo($image['name'],PATHINFO_EXTENSION);
        $rname= 'IMG_'.random_int(11111,99999).".$ext";

        $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
        if(move_uploaded_file($image['tmp_name'],$img_path)){
            return $rname;
        }
        else{
            return 'upd_failed';
        }
    }

}



function uploadImage($image,$folder){
    $valid_mime =['image/jpeg','image/png','image/webp'];
    $img_mime =$image['type'];

    if(!in_array($img_mime,$valid_mime)){
        return 'inv_img';
    }
    else if(($image['size']/(1024*1024))>2){
        return 'inv_size';
    }
    else{
        $ext= pathinfo($image['name'],PATHINFO_EXTENSION);
        $rname= 'IMG_'.random_int(11111,99999).".$ext";

        $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
        if(move_uploaded_file($image['tmp_name'],$img_path)){
            return $rname;
        }
        else{
            return 'upd_failed';
        }
    }


    


}

function deleteImage($image,$folder){
   if(unlink(UPLOAD_IMAGE_PATH.$folder.$image)){
    return true;
   } 
   else{
    return false;
   }
}



?>