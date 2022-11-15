<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BTR-Bardiya Tiger Resort</title>
    <?php require('inc/links.php'); ?>

    <style>
        .cont_cls {
            position: absolute;
            left: 0;
            right: 0;
            top: 50%;
            text-align: left;
            transform: translateY(-50%);
            color: white;
        }

        .container {
            padding-top: 150px;
        }
    </style>


</head>

<body>
    <?php require('inc/header.php'); ?>

    <!--start of hero section  -->

    <div class="container-fluid px-lg-4 mt-4">
        <img src="images/slider4.jpg" class="d-block w-100" height="500px" width="1500px">
        <h2 class="fw-bold h-font text-center cont_cls">Contact US</h2>
    </div>
    <!--end of hero section  -->
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 p-4 mb-lg-0 mb-5 bg-white rounded">
                <iframe class=" w-100 rounded " height="320px" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7015.726793845038!2d81.247048!3d28.453534000000005!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa011c5c0e8e676fc!2sBardia%20Tiger%20Resort!5e0!3m2!1sen!2snp!4v1660059751950!5m2!1sen!2snp" loading="lazy"></iframe>
            </div>
            <div class="col-lg-6 col-md-6 ">
                <h3 class="h-font text-center mb-lg-2 mb-3"> GET IN TOUCH</h3>

                <form method="post" class="bg-white p-md-5 p-5 mb-5 border">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" pattern="[a-zA-Z][a-zA-Z ]{2,}" title="only characters are allowed" required class="form-control shadow-none mb-1" />
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" name="phone" required class="form-control shadow-none" />

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" required class="form-control shadow-none m-1" />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12 form-group">
                            <label for="message">Write Message</label>
                            <textarea type="text" pattern="[a-zA-Z][a-zA-Z ]{2,}" title="only characters are allowed" name="message" required class="form-control shadow-none" cols="30" rows="8"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="submit" name="send" value="Send Message" onchange="phonevalidation" class="btn btn-primary text-white font-weight-bold shadow-none" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require('inc/footer.php'); ?>

    <?php
    $hname = 'localhost';
    $uname = 'root';
    $pass = '';
    $db = 'BTR_db';
    $conn = mysqli_connect($hname, $uname, $pass, $db);
    if (!$conn) {
        die("cannot connect to database" . mysqli_connect_errno());
    }

    if (isset($_POST['send'])) {
        //get the data from the form
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        //query to insert and save data into the database
        if (!preg_match('/^[0-9]{10}+$/', $phone)) {
            alert('error', 'invalid number');
        } else {

            $sql = "insert into getintouch(name,phone_no,email,message) values('$name','$phone','$email','$message')";

            //execute query and save data into database
            $result = mysqli_query($conn, $sql);

            //check whether the data is inserted into database

            if ($result) {
                alert('success', 'message sent successfully');
            } else {
                alert('error', 'something went wrong');
            }
        }
    }


    ?>
</body>

</html>