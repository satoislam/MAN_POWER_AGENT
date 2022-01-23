<?php
$page = "Dashboard";
require_once("../header.php");
require_once("../sidebar.php"); 
require_once("../db_config.php");
$id=$_GET['id'];
 $update = $conn->query("SELECT * FROM `worker` WHERE id=$id");
 $result=$update->fetch_assoc();
 

 if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $iqama_numbe = $_POST['iqama_number'];
    $local_number = $_POST['local_number'];
    $whatsapp_number = $_POST['whatsapp_number'];
  
    $photo = $_FILES['photo']['name'];
    $file_name = date('Y-m-d-h-i-s').basename($_FILES['photo']['name']);
    $folder = './uploads/'.$file_name;
    move_uploaded_file($_FILES['photo']['tmp_name'],$folder);
  
    $iqama_photo = $_FILES['iqama_photo']['name'];
    $file_name = date('Y-m-d-h-i-s').basename($_FILES['iqama_photo']['name']);
    $folder = './uploads/'.$file_name;
    move_uploaded_file($_FILES['photo']['tmp_name'],$folder);
  
    $current_address = $_POST['current_address'];
    $working_place = $_POST['working_place'];
    $passport_number = $_POST['passport_number'];
    $current_address = $_POST['current_address'];
    $status = $_POST['status'];

    if($_FILES['photo']['name'] && $_FILES['iqama_photo']['name'] ){
        $worker = $conn->query("UPDATE `worker` SET `name`='$name',`iqama_number`='$iqama_numbe',`local_number`=' $local_number',`whatsapp_number`='$whatsapp_number',`photo`='$file_name',`iqama_photo`='$file_name',`current_address`='$current_address',`working_place`='$working_place ',`passport_number`='$passport_number',`status`='$status' WHERE id='$id'");
    }else{
        $worker = $conn->query("UPDATE `worker` SET `name`='$name',`iqama_number`='$iqama_numbe',`local_number`=' $local_number',`whatsapp_number`='$whatsapp_number',`current_address`='$current_address',`working_place`='$working_place ',`passport_number`='$passport_number',`status`='$status' WHERE id='$id'");
    };

     ?>

        <script> 
      window.location.assign("view_worker.php");
     </script> 
         
 <?php } ?>  



<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Dashboard</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
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


          <form action="" method="post" enctype="multipart/form-data">
            <div id="new">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="Name">Name</label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="Enter Worker Name" value="<?php echo $result['name']; ?>">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="Iqama numbe">Iqama numbe</label>
                      <input type="text" class="form-control" name="iqama_number" id="iqama_numbe" placeholder="Iqama Numbe" value="<?php echo $result['iqama_number']; ?>">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="Local number">Local number</label>
                      <input type="text" class="form-control" name="local_number" id="local_number" placeholder=" Local Number" value="<?php echo $result['local_number']; ?>">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="WhatsApp number">WhatsApp number</label>
                      <input type="text" class="form-control" name="whatsapp_number" id="whatsapp_number" placeholder="WhatssApp Number"  value="<?php echo $result['whatsapp_number']; ?>">
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="Photo">Photo</label>
                      <input type="file" class="" name="photo" id="photo" value="<?php echo $result['photo']; ?>">
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="Iqama Photo">Iqama Photo</label>
                      <input type="file" class="" name="iqama_photo" id="iqama_photo" value="<?php echo $result['iqama_photo']; ?>">
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="Current Address">Current Address</label>
                      <input type="text" class="form-control" name="current_address" id="current_address" placeholder=" Current Address" value="<?php echo $result['current_address']; ?>">
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="Working Place">Working Place</label>
                      <input type="text" class="form-control" name="working_place" id="working_place" placeholder="Working Place" value="<?php echo $result['working_place']; ?>">
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="Passport Number">Passport Number</label>
                      <input type="text" class="form-control" name="passport_number" id="passport_number" placeholder="Passport Number" value="<?php echo $result['passport_number']; ?>">
                    </div>
                  </div>

             <div class="col-6">
              <div class="form-group">
              <label for="status">Select Status:</label><br>
               <input type="radio" name="status" value="active" <?php if($result['status']=='active'){echo "checked";} ?> ><span>Active</span> |
               <input type="radio" name="status" value="inactive" <?php if($result['status']=='inactive'){echo "checked";} ?>><span>Inactive</span>
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