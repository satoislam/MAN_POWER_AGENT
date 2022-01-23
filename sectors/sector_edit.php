<?php
$page = "sector";
require_once("../header.php");
require_once("../sidebar.php");
require_once("../db_config.php"); ?>

<?php 
          $d=$_GET['ram'];
          $sector_da = $conn->query("SELECT * FROM `sectors` WHERE id=$d");

          $result=$sector_da->fetch_assoc();
          

      if(isset($_POST['sector_name'])) {
       $sector=$_POST['sector_name'];
       

              
      $conn->query("UPDATE `sectors` SET `sector_name` = '$sector' WHERE `sectors`.`id` = $d");

           ?>

    <script>
    window.location.href=("sectors.php");
    </script>
      
   <?php } ?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Update Sectors</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Update Sector</li>
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
            <h1 class="card-title text-center">Add Sector</h1>
            
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form action="" method="post">

            <label for="sector_name">Sector Name:</label>
            <input type="text"name="sector_name"class="form-control"placeholder="Enter sector name" value="<?php echo $result['sector_name'] ?>">

            <td colspan="6">
               <input type="Submit" value="Submit"class="btn btn-outline-primary btn btn-block">
            </td>

            <br>
          </form>
      
        

          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<?php require("../footer.php"); ?>