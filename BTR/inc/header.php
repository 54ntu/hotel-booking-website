<!-- start navbar  -->

<nav class="navbar navbar-expand-lg bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">BTR</a>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon "></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active me-2" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="Rooms.php">Rooms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="facilities.php">Facilities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="Contact.php">Contacts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="About.php">About Us</a>
                </li>
            </ul>
            <div class="d-flex">
                <?php
                if (isset($_SESSION['login']) && $_SESSION['login'] == true) {

                    echo <<<data
                <div class="btn-group">
                    <button type="button" class="btn btn-outline-dark dropdown-toggle shadow-none" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                        $_SESSION[uName]
                    </button>
                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        <li><a class="dropdown-item" href="profile.php" >Profile</a></li>
                        <li><a class="dropdown-item" href="bookings.php" >My Bookings</a></li>
                        <li><a class="dropdown-item" href="Logout.php" >Logout</a></li>

                    </ul>
                </div>

                data;
                } else {

                    echo <<<data
                
                <button type="button" class="btn btn-outlined-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                    Login
                </button>
                <button type="button" class="btn btn-outlined-dark shadow-none " data-bs-toggle="modal" data-bs-target="#registerModal">
                    Register
                </button>

                data;
                }

                ?>

            </div>
        </div>
    </div>
</nav>
<!-- end of navbar  -->


<!--start modal for login  -->
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="login-form">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-circle fs-3 me-2"></i>User Login
                    </h5>
                    <button type="reset " class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Email/Mobile</label>
                        <input type="text" name="email_mob" class="form-control shadow-none">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input type="password" name="pass" class="form-control shadow-none">
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <button type="submit" class="btn btn-dark shadow-none ">LOGIN</button>
                        <button type="button" class="btn text-secondary  text-decoration-none shadow-none p-0 " data-bs-toggle="modal" data-bs-target="#forgotModal">
                            Forgot password?
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
<!-- end of modal for login  -->

<!-- modal for registration  -->
<div class="modal fade " id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" id="register-form">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-lines-fill fs-3 me-2"></i>User Registration
                    </h5>
                    <button type="reset " class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <span class="badge rounded-pill text-bg-light text-dark mb-3 text-wrap lh-base">
                        Note:Your details must match with your ID(Adhaar card, DL,passport etc.)
                        that will be required during check in.
                    </span>
                    <div class="container mb-2">
                        <div class="row">
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control shadow-none" pattern="[a-zA-Z][a-zA-Z ]{2,}" title="only characters are allowed" required>
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Phone No</label>
                                <input type="Number" name="phone" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Country</label>
                                <input type="text" name="country" class="form-control shadow-none" pattern="[a-zA-Z][a-zA-Z ]{2,}" title="only characters are allowed" required>
                            </div>

                            <div class="col-md-12 mb-3 p-0">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control shadow-none" rows="1" required> </textarea>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Pincode</label>
                                <input type="Number" name="pincode" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">DOB</label>
                                <input type="date" name="dob" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="pass" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 p-0 ">
                                <label class="form-label">Confirm password</label>
                                <input type="password" name="cpass" class="form-control shadow-none" required>
                            </div>
                        </div>
                    </div>
                    <div class="text-center my-1">
                        <button type="submit" class="btn btn-dark shadow-none w-100 mb-2">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- end modal for registration  -->


<!-- start of forgot pass modal  -->
<div class="modal fade" id="forgotModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="forgot-form">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-circle fs-3 me-2"></i>Forgot password
                    </h5>

                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" required name="email" class="form-control shadow-none">
                    </div>
                    <div class="mb-4">
                        <label class="form-label"> New Password</label>
                        <input type="password" name="Npass" class="form-control shadow-none" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label"> Confirm Password</label>
                        <input type="password" name="cpass" class="form-control shadow-none" required>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <button type="submit" class="btn btn-dark shadow-none w-100 ">Submit</button>
                    </div>
                    <div>
                        <button type="button" class="btn btn-dark shadow-none w-100" data-bs-toggle="modal" data-bs-target="#loginModal">
                            Cancel
                        </button>
                    </div>

                </div>

            </form>

        </div>
    </div>
</div>


<!-- end of forgot pass modal  -->