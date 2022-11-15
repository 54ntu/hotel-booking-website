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

    <title>Bookings Management panel </title>
    <?php require('inc/link.php'); ?>
    <style>
        .h-line {
            width: 150px;
            margin: auto 0;
            height: 1.7px;
        }

        .custom-bg {
            background-color: #2ec1ac;
            color: black;
        }

        .custom-bg:hover {
            background-color: #279e8c;
        }
    </style>
</head>

<body>
    <?php require('inc/header.php'); ?>
    <div class="container-fluid " id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden ">

                <div class="content-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="page-title h-font ">Booking details</h2>
                                <div class="h-line bg-dark mb-lg-4 md-md-2"></div>
                                <!-- Zero Configuration Table -->
                                <div class="panel panel-default">
                                    <div class="table-responsive">
                                        <table class="display table table-striped table-bordered table-hover border text-center " cellspacing="0" style="min-width: 1300px;">
                                            <thead class="sticky-top">
                                                <tr class="bg-dark text-light">
                                                    <th>id</th>
                                                    <th> User details</th>
                                                    <th>Room details</th>
                                                    <th>Booking details</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody id="tbl_book">

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
        function get_booking() {

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/book_admin.php", true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                document.getElementById('tbl_book').innerHTML = this.responseText;



            }
            xhr.send('get_booking');

        }


        window.onload = function() {
            get_booking();

        }
    </script>
</body>

</html>