<?php
   require('admin/inc/important.php');

   session_start();
   session_destroy();
   redirect('index.php');


?>
