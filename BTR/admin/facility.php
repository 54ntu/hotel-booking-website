<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-facility Panel</title>
    <?php require('inc/link.php'); ?>


    <style>
        .custom-btn {
            background-color: #2ec1ac;

        }

        .h-line {
            width: 150px;
            margin: auto 0;
            height: 1.7px;
        }
    </style>

    <link rel="stylesheet" href="../admin//css/common.css" />

</head>

<body class="bg-light">
    <?php require('inc/header.php'); ?>
    <div class="container-fluid " id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden ">
                <h3 class="mb-4 h-font">Facilities and Features</h3>
                <div class="h-line bg-dark mb-lg-2"></div>
                <!-- start of  features  -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex  align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Features</h5>
                            <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#feature_m">
                                <i class="bi bi-plus"></i> Add
                            </button>
                        </div>
                        <div class="table-responsive-md" style="height: 350px; overflow-y:scroll;">
                            <table class="table table-hover border">
                                <thead class="sticky-top">
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="features_data">
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>

                <!-- start of facilities  -->

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex  align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Facilities</h5>
                            <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#facility_m">
                                <i class="bi bi-plus"></i> Add
                            </button>
                        </div>


                        <div class="table-responsive-md" style="height: 350px; overflow-y:scroll;">
                            <table class="table table-hover border">
                                <thead class="sticky-top">
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Icon</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="facilities_data">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end of facilities  -->

                <!-- start and features Modal -->
                <div class="modal fade" id="feature_m" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="feature_id_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add features</h5>
                                </div>
                                <div class="modal-body">
                                    <div class=" mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="feature_name" class="form-control shadow-none" required>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn  custom-btn text-dark shadow-none">SUBMIT</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
                <!-- end of features modal  -->


                <!-- start of facility modal  -->

                <div class="modal fade" id="facility_m" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="facility_id_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add facility</h5>
                                </div>
                                <div class="modal-body">
                                    <div class=" mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="facility_name" class="form-control shadow-none" required>
                                    </div>
                                    <div class=" mb-3">
                                        <label class="form-label">Icon</label>
                                        <input type="file" name="facility_icon" accept=".svg" class="form-control shadow-none" required>
                                    </div>
                                    <div class=" mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea type="text" name="facility_des" class="form-control shadow-none" rows="2" required></textarea>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" name="submit" class="btn  custom-btn text-dark shadow-none">SUBMIT</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>

                <!-- end of facility modal  -->
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <?php require('inc/scripts.php'); ?>
    <script>
        let feature_id_form = document.getElementById('feature_id_form');
        let facility_id_form = document.getElementById('facility_id_form');

        //code for features
        feature_id_form.addEventListener('submit', function(e) {
            e.preventDefault();
            add_feature();


        });

        function add_feature() {
            let data = new FormData();
            data.append('name', feature_id_form.elements['feature_name'].value);
            data.append('add_feature', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features_facilities.php", true);

            xhr.onload = function() {
                var myModal = document.getElementById('feature_m');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();


                if (this.responseText==1) {
                    alert('success', 'New feature added!');
                    feature_id_form.elements['feature_name'].value = '';
                    get_features();
                } else {
                    alert('error', 'server Down! feature');
                }
            }
            xhr.send(data);

        }


        function get_features() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features_facilities.php", true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                document.getElementById('features_data').innerHTML = this.responseText;

            }
            xhr.send('get_features');
        }


        function rem_feature(val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features_facilities.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (this.responseText==1) {
                    alert('success', 'feature removed!');
                    get_features();

                }
                 else {
                    alert('error', 'server down features');
                }
            }
            xhr.send('rem_feature&val=' + val);
         
        }


        // code for facility    
        facility_id_form.addEventListener('submit',function(e){
            e.preventDefault();
            add_facility();
        });


        function add_facility(){
            let data = new FormData();
            data.append('name',facility_id_form.elements['facility_name'].value);
            data.append('icon',facility_id_form.elements['facility_icon'].files[0]);
            data.append('desc',facility_id_form.elements['facility_des'].value);
            data.append('add_facility','');

            let xhr=new XMLHttpRequest();
            xhr.open("POST","ajax/features_facilities.php",true);

            xhr.onload =function(){
                var myModal = document.getElementById('facility_m');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if(this.responseText == 'inv_img'){
                    alert('error','only SVG images are allowed!');

                }
                else if(this.responseText == 'inv_size'){
                    alert('error','image should be less than 1 MB!');
                }
                else if(this.responseText == 'upd_failed'){
                    alert('error','image upload failed.Server down!');
                }
                else{
                    alert('success','new facility added');
                    facility_id_form.reset();
                    get_facility(); 
                }


            }
            xhr.send(data);

        }


        function get_facility(){
            let xhr= new XMLHttpRequest();
            xhr.open("POST","ajax/features_facilities.php",true);
            xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');

            xhr.onload= function(){
                document.getElementById('facilities_data').innerHTML=this.responseText;

            }
            xhr.send('get_facility');
        }


        function rem_facility(val){
            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/features_facilities.php",true);
            xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

            xhr.onload =function(){
                if(this.responseText==1){
                    alert('success','facility removed!');
                    get_facility();

                }
                else if(this.responseText =='room_added'){
                    alert('error','facility is added in Room');

                }
                else{
                    alert('error','server down faccility');
                }
            }
            xhr.send('rem_facility=' +val);
        }


        window.onload = function() {
            get_features();
             get_facility();
        }
    </script>


</body>

</html>