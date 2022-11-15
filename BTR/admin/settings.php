<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-settings</title>
    <?php require('inc/link.php')?>
</head>
<body>
    <?php require('inc/header.php') ?>

   <div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden mt-5">
        <div class="card border-0 shadow">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-5">
                <h5 class="card-title m-0">Shutdown Website</h5>
                <div class="form-check form-switch">
                    <form   id="shutdown-form">
                     <input  onchange="upd_shutdown(this.value)" class="form-check-input " type="checkbox" role="switch" name="shutdown-toggle">
                    </form>
                </div>

            </div>
            <p class="card-text">
                No customers will be allowed to book hotel room, when shutdown mode is turned on.
            </p>
        </div>
        </div>
    </div>
   </div>
    </div>



    <?php require('inc/scripts.php')?>

    <script>
    let general_data;
    function get_general(){
        let shutdown_toggle =document.getElementById('shutdown-toggle');

        let xhr= new XMLHttpRequest();
        xhr.open("POST","ajax/settings_crud.php",true);
        xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');

            xhr.onload= function(){
                

                if(general_data.shutdown ==0){
                    shutdown_toggle.checked = false;
                    shutdown_toggle.value=0;
                }
                else{
                    shutdown_toggle.checked = true;
                    shutdown_toggle.value=1;
                }
            }
            xhr.send('get_general');
    }



    function upd_shutdown(val){

        let xhr= new XMLHttpRequest();
        xhr.open("POST","ajax/settings_crud.php",true);
        xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');

        xhr.onload= function(){
            if(this.responseText == 1){
                alert('success','shutdown mode is activated!');

            }
            else{
                alert('success','shutdown mode is off!');
            }

            get_general();
            
        }
       xhr.send('upd_shutdown=' +val);
    }



window.onload = function(){
    get_general();
}




    </script>
</body>
</html>

