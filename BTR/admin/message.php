<?php
session_start();
require('inc/db_config.php');
require('inc/important.php');
session_regenerate_id(true);

        if (isset($_GET['seen'])) {

            $frm_data = filteration($_GET);
            if ($frm_data['seen'] == 'all') {
            } else {
                $q = "UPDATE `getintouch` SET `seen`=?  WHERE `sr_no`=?";
                $values = [1, $frm_data['seen']];
                if (update($q, $values, 'ii')) {
                    alert('success', "marked as read");
                } else {
                    alert('error', 'operation failed');
                }
            }
        }


        
        if (isset($_GET['del'])) {

            $frm_data = filteration($_GET);
            if ($frm_data['del'] == 'all') {
            } else {
                $q = "DELETE FROM `getintouch`   WHERE `sr_no`=?";
                $values = [$frm_data['del']];
                if (delete($q, $values, 'i')) {
                    alert('success', "data deleted");
                } else {
                    alert('error', 'operation failed');
                }
            }
        }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Query Panel</title>
    <?php require('inc/link.php'); ?>


    <style>
        .custom-btn {
            background-color: #2ec1ac;

        }
    </style>

    <link rel="stylesheet" href="../admin//css/common.css" />

</head>

<body class="bg-light">
    <?php require('inc/header.php'); ?>
    <div class="container-fluid " id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden ">
                <h3 class="mb-4 h-font">Contact Us Queries</h3>
                <!-- general settings  -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="table-responsive-md" style="height: 450px; overflow-y:scroll;">
                            <table class="table table-hover border">
                                <thead class="sticky-top">
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col" width="20%">Email</th>
                                        <th scope="col">Date</th>
                                        <th scope="col" width="30%">Message</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $q = "select * from `getintouch` ORDER BY `sr_no` DESC";
                                    $data = mysqli_query($conn, $q);
                                    $i = 1;

                                    while ($row = mysqli_fetch_assoc($data)) {
                                        $seen = "";
                                        if ($row['seen'] != 1) {
                                            $seen = "<a href='?seen=$row[sr_no]' class='btn btn-sm rounded btn-primary me-2 mb-2'>Mark as read </a>";
                                        }
                                        $seen .= "<a href='?del=$row[sr_no]' class='btn btn-sm rounded btn-danger  '>delete</a>";

                                        echo <<<query
                                        <tr>
                                            <td>$i</td>
                                            <td>$row[name]</td>
                                            <td>$row[phone_no]</td>
                                            <td>$row[email]</td>
                                            <td>$row[Date]</td>
                                            <td>$row[message]</td>
                                            <td>$seen</td>
                                        </tr>
                                        query;
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>