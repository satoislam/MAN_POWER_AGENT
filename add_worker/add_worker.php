<?php
$page = "Dashboard";
require_once("../header.php");
require_once("../sidebar.php");
require_once("../db_config.php");

if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $iqama_number = $_POST['iqama_number'];
  $local_number = $_POST['local_number'];
  $whatsapp_number = $_POST['whatsapp_number'];

  $photo = explode('.', $_FILES['photo']['name']);
  $photo_extention = end($photo);
  $photo_name = $name.'.'.$photo_extention;
  move_uploaded_file($_FILES['photo']['tmp_name'],'../assets/uploads/worker_photos/'.$photo_name);
 

  $iqama_photo = explode('.', $_FILES['iqama_photo']['name']);
  $iqama_photo_extention = end($iqama_photo);
  $iqama_photo_name = $iqama_number.'.'.$iqama_photo_extention;
  // print_r($iqama_photo_name);
  // exit;
  move_uploaded_file($_FILES['iqama_photo']['tmp_name'],'../assets/uploads/iqama_photos/'.$iqama_photo_name);

  $current_address = $_POST['current_address'];
  $working_place = $_POST['working_place'];
  $daily_salary = $_POST['salary'];
  $ot_rate = $_POST['ot_rate'];
  $passport_number = $_POST['passport_number'];
  $current_address = $_POST['current_address'];
  $status = $_POST['status'];

$worker = $conn->query("INSERT INTO `worker`(`name`, `iqama_number`, `local_number`, `whatsapp_number`, `photo`, `iqama_photo`, `current_address`, `working_place`, `daily_basic_salary`, `ot_rate`, `passport_number`, `status`) VALUES ('$name','$iqama_number','$local_number','$whatsapp_number','$photo_name','$iqama_photo_name','$current_address',' $working_place','$daily_salary','$ot_rate','$passport_number','$status')");

 ?>
<script> 
 window.location.assign("view_worker.php");
</script> 

<?php } ?>


<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-10">
        <h1 style="text-align: center; color:green;margin-left: 17%;">Add Worker</h1>
      </div>
      <div class="col-md-2">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="view_worker.php" class="btn btn-sm btn-success">All Workers</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <!-- <h2 class="card-title text-center">code goes here</h2> -->

            <form action="" method="post" enctype="multipart/form-data">
            <div id="new">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="Name">Name</label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="Enter Worker Name" required>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="Iqama numbe">Iqama number</label>
                      <input type="text" class="form-control" name="iqama_number" id="iqama_number" placeholder="Iqama Number" required>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="Local number">Local number</label>
                      <input type="text" class="form-control" name="local_number" id="local_number" placeholder=" Local Number" required>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="WhatsApp number">WhatsApp number</label>
                      <input type="text" class="form-control" name="whatsapp_number" id="whatsapp_number" placeholder="WhatssApp Number" required>
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="Photo">Photo</label>
                      <input type="file" class="" name="photo" id="photo">
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="Iqama Photo">Iqama Photo</label>
                      <input type="file" class="" name="iqama_photo" id="iqama_photo">
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="Current Address">Current Address</label>
                      <input type="text" class="form-control" name="current_address" id="current_address" placeholder=" Current Address" required>
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="Working Place">Working Place</label>
                      <input type="text" class="form-control" name="working_place" id="working_place" placeholder=" Working Place" required>
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="salary">Daily Basic Salary</label>
                      <input type="text" class="form-control" name="salary" id="salary" placeholder="Daily Basic Salary" required>
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="over_time">Over Time Rate</label>
                      <input type="text" class="form-control" name="ot_rate" id="ot_rate" placeholder="Over Time Rate" required>
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="Passport Number">Passport Number</label>
                      <input type="text" class="form-control" name="passport_number" id="passport_number" placeholder="Passport Number" required>
                    </div>
                  </div>

                  <div class="col-6">
              <div class="form-group">
               <label for="status">Select Status</label><br>
               <input type="radio" name="status" value="active" checked><span>Active</span> |
               <input type="radio" name="status" value="inactive"><span>Inactive</span>
            </div>
          </div> 

                </div>
                <hr style="border: 1px solid #ccc;">
              </div>
              <input type="submit" name="submit" value="Submit" class="btn btn-block btn-success"></input>

            </form>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<?php require("../footer.php"); ?>