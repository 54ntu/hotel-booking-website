<!-- start of footer section  -->
<div class="container-fluid bg-white mt-5">
    <div class="row">
        <div class="col-lg-4 p-4">
            <h3 class="fs-3 mb-2">Contact Us</h3>

            <a href="tel:+977 9868240503" class="d-inline-block mb-2 text-decoration-none text-dark">
                <i class="bi bi-telephone-fill"></i> +9779868240503
            </a><br>
            <a href="tel:+977 9868240503" class="d-inline-block  text-decoration-none text-dark mb-lg-4 mb-md-4">
                <i class="bi bi-telephone-fill"></i> +977 9851014616
            </a>
            <h5>Bardiya</h5>
            <i class="bi bi-geo-alt"></i><a href="https://www.google.com/maps/dir//28.4544538,81.2456449/@28.451853,81.2451965,17.36z?hl=en" class="text-decoration-none text-dark"> Thakurbaba, Bardia<br>
                Bardia National Park</a>



        </div>
        <div class="col-lg-4 p-4 ">
            <h5 class="mb-3">Quick Links</h5>
            <a href="index.php" class="d-inline-block mb-2 text-dark text-decoration-none">Home</a><br>
            <a href="Rooms.php" class="d-inline-block mb-2 text-dark text-decoration-none">Rooms</a><br>
            <a href="facilities.php" class="d-inline-block mb-2 text-dark text-decoration-none">Facilities</a><br>
            <a href="contact.php" class="d-inline-block mb-2 text-dark text-decoration-none">Contacts</a><br>
            <a href="About.php" class="d-inline-block mb-2 text-dark text-decoration-none">About us</a><br>
            <a href="admin/adminlogin.php" class="d-inline-block mb-2 text-dark text-decoration-none">Admin</a>
        </div>
        <div class="col-lg-4 p-4">
            <h5 class="mb-3">Follow Us</h5>
            <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none ">
                <i class="bi bi-twitter me-1"></i> Twitter
            </a><br>
            <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">
                <i class="bi bi-facebook me-1"></i> Facebook
            </a><br>
            <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none ">
                <i class="bi bi-instagram me-1"></i> Instagram
            </a><br>
        </div>


    </div>
    <div class="h-font text-center bg-dark text-white p-2 mb-lg-2 mb-md-1">
        <h6>Design and developed by santaram</h6>
    </div>
</div>

<!-- end of footer section  -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>


<script>
    function alert(type, msg, position = 'body') {
        let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
        let element = document.createElement('div');
        element.innerHTML = `
        <div class="alert ${bs_class} alert-dismissible fade show  " role="alert">
            <strong class="me-2">${msg}</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> 
        `;

        if (position == 'body') {
            document.body.append(element);
            element.classList.add('custom_alert')

        } else {
            document.getElementById(position).appendChild(element);
        }
        setTimeout(remALert, 2000);
    }

    function remALert() {
        document.getElementsByClassName('alert')[0].remove();
    }


    // code for registration 
    let register_form = document.getElementById('register-form');

    register_form.addEventListener('submit', function(e) {
        e.preventDefault();

        let data = new FormData();

        data.append('name', register_form.elements['name'].value);
        data.append('email', register_form.elements['email'].value);
        data.append('phone_no', register_form.elements['phone'].value);
        data.append('country', register_form.elements['country'].value);
        data.append('address', register_form.elements['address'].value);
        data.append('pincode', register_form.elements['pincode'].value);
        data.append('dob', register_form.elements['dob'].value);
        data.append('pass', register_form.elements['pass'].value);
        data.append('cpass', register_form.elements['cpass'].value);
        data.append('register', '');



        var myModal = document.getElementById('registerModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();


        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php", true);

        xhr.onload = function() {

            if (this.responseText == 'inv_pass') {
                alert('error', 'password lenght must be 8 characters or more!');
            } else if (this.responseText == 'inv_dob'){
                alert('errror','invalid date of birth!');
            }
            else if (this.responseText == 'pass-missmatch') {
                alert('error', "Password mismatch!");
            } else if (this.responseText == 'ins_failed') {
                alert('error', "Registration failed!");
            } else if (this.responseText == 'email-already') {
                alert('error', 'email  is already registered');
            } else if (this.responseText == 'phone-already') {
                alert('error', 'Phone number  is already registered');
            } else if (this.responseText == 'inv_phone') {
                alert('error', 'invalid mobile number!');
            } else if (this.responseText == 'inv_name') {
                alert('error', 'number is not allowed in name field!');
            } else {
                alert('success', "Registration successful register!");
                register_form.reset();
            }

        }
        xhr.send(data);

    });

    // end code for registration 




    // code for login 
    let login_form = document.getElementById('login-form');

    login_form.addEventListener('submit', function(e) {
        e.preventDefault();

        let data = new FormData();

        data.append('email_mob', login_form.elements['email_mob'].value);
        data.append('pass', login_form.elements['pass'].value);

        data.append('login', '');



        var myModal = document.getElementById('loginModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();


        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php", true);

        xhr.onload = function() {

            if (this.responseText == 'inv_email_mob') {
                alert('error', "invalid email or mobile!");
            } else if (this.responseText == 'Inactive') {
                alert('error', "Account is suspended!");
            } else if (this.responseText == 'invalid_pass') {
                alert('error', 'incorrect password!');
            } else {
                let fileurl = window.location.href.split('/').pop().split('?').shift();
                if (fileurl == 'room_details.php') {
                    window.location = window.location.href;
                } else {
                    window.location = window.location.pathname;

                }
            }

        }
        xhr.send(data);
    });


    //  code for forgot password 

    let forgot_form = document.getElementById('forgot-form');

    forgot_form.addEventListener('submit', function(e) {

        e.preventDefault();
        let data = new FormData();

        data.append('email', forgot_form.elements['email'].value);
        data.append('npass', forgot_form.elements['Npass'].value);
        data.append('cpass', forgot_form.elements['cpass'].value);
        data.append('forgot', '');


        var myModal = document.getElementById('forgotModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();


        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php", true);


        xhr.onload = function() {

            if (this.responseText == 'email_inv') {
                alert('error', "invalid email !");
            } else if (this.responseText == 'pass-missmatch') {
                alert('error', "Password doesnot match!");
            } else if (this.responseText == 'fail') {
                alert('error', 'updation failed!');
            } else {
                alert('success', 'your password changed successfully!');
                forgot - form.reset();
            }

        }
        xhr.send(data);


    });


    function checkloginTobook(status, room_id) {
        if (status) {
            window.location.href = 'confirm_bookings.php?id=' + room_id;
        } else {
            alert('error', 'please login to book!');
        }
    }
</script>