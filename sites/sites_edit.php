<?php
$page = "sites";
require_once("../header.php");
require_once("../sidebar.php");
require_once("../db_config.php");?> 

<?php
    $d=$_GET['ram'];
    // $details=$conn->query("SELECT * FROM `sites` WHERE id=$d");
    $details=$conn->query("SELECT sites.id,sectors.sector_name,sites.site_name,sites.address,sites.contact_no,sites.status FROM `sites` JOIN sectors ON sectors.id=sites.sectorID WHERE sites.id=$d ");
    $result=$details->fetch_assoc();

      $sec=$conn->query("SELECT * FROM sectors");

      if(isset($_POST['submit'])) {
       $sectorID=$_POST['sectorID'];
       $site_name=$_POST['site_name'];
       $address=$_POST['address'];
       $contact_no=$_POST['contact_no'];
       $status=$_POST['status'];
       


       $ss=$conn->query("UPDATE `sites` SET `sectorID`='$sectorID',`site_name`='$site_name',`address`='$address',`contact_no`='$contact_no',`status`='$status' WHERE id=$d");

      ?>

      <script> 
        window.location.assign("view_sites.php");
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
          <li class="breadcrumb-item"><a href="add_sites.php">Home</a></li>
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
           <!--  <h2 class="card-title text-center">code goes here</h2> -->
         </div>
         <!-- /.card-header -->
         <div class="card-body">
           <h3>Update <?php echo $result['site_name'] ?>'s information</h3>
               <br> 

          <form action="" method="post"enctype="multipart/form-data">
            <table class="table table-bordered  table-striped table-hover">

              <tr>
                <th>Sectors Name</th>
                <td>
                  

                 <select name="sectorID"  class="form-control">
                  <option value="">Select Sectors</option>

                  <?php while($s=$sec->fetch_assoc()) { ?>

                    <option value="<?php echo $s['id'] ?>"<?php if($s['id']==$result['id']){echo "selected";} ?>><?php echo $s['sector_name']; ?>
                    
                  </option>
                <?php } ?>
              </select>
            </td>

            <th>Site Name</th>
            <td>
              <input type="text" name="site_name" class="form-control" value="<?php echo $result['site_name']?>">
            </td>
          </tr>
          <tr>
            <th>Address</th>
            <td>
              <input type="text" name="address" class="form-control"value="<?php echo $result['address']?>">
            </td>
            <th>Contact No</th>
            <td>
              <input type="text" name="contact_no" class="form-control"value="<?php echo $result['contact_no']?>">
            </td>
          </tr>
          <tr>      
            <th>Status</th>
            <td>
              <select name="status"class="form-control" value="<?php echo $result['status']?>">
                <option>Active</option>
                <option>Inactive</option>
              </select> 

            </td>
            
            
            
          </tr>
          
          
          <tr> 
            <td colspan="8">
              <input type="submit" name="submit" value="Save" class="btn btn-block btn-success">
            </td>
          </tr>     
        </table>
      </form>
      <br>
      <br>
      
      
    <hr>

   
   

 </div>
</div>
<!-- /.card -->
</div>
</div>
</div><!-- /.container-fluid -->
</section>

<?php require("../footer.php"); ?>