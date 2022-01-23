<?php
$page = "sites";
require_once("../header.php");
require_once("../sidebar.php");
require_once("../db_config.php");
?>

<?php

$sec=$conn->query("SELECT * FROM sectors");

if (isset($_POST['submit'])) {
    $sectorID=$_POST['sectorID'];
    $site_name=$_POST['site_name'];
    $address=$_POST['address'];
    $contact_no=$_POST['contact_no'];
    $status=$_POST['status'];



    $ss=$conn->query("INSERT INTO `sites` ( `sectorID`, `site_name`, `address`, `contact_no`, `status`) VALUES ( '$sectorID', '$site_name', '$address', '$contact_no', '$status')"); ?>

<script>
  window.location.href("sites.php");
</script>

<?php
} ?>



<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h2>Sites</h2>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="">Home</a></li>
          <li class="breadcrumb-item"><a href="">Sites</a></li>
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
            <div class="row">
              <div class="col-md-9">
                <h2 class="text-center mb-md-0 " style="margin-left: 16rem;">Add Sites</h2>
              </div>
              <div class="col-md-3 text-right">
                <a href="./view_sites.php" class="btn btn-md btn-info"><i class="fas fa-eye"></i>
                  View Sites</a>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">


            <form action="" method="post" enctype="multipart/form-data">
              <table class="table table-bordered  table-striped table-hover">

                <tr>
                  <th>Sectors Name</th>
                  <td>


                    <select name="sectorID" class="form-control">
                      <option value="">Select Sectors</option>

                      <?php while ($s=$sec->fetch_assoc()) { ?>
                      <option
                        value="<?php echo $s['id'] ?>">
                        <?php echo $s['sector_name']; ?>

                      </option>
                      <?php } ?>
                    </select>
                  </td>

                  <th>Site Name</th>
                  <td>
                    <input type="text" name="site_name" class="form-control">
                  </td>
                </tr>
                <tr>
                  <th>Address</th>
                  <td>
                    <input type="text" name="address" class="form-control">
                  </td>
                  <th>Contact No</th>
                  <td>
                    <input type="text" name="contact_no" class="form-control">
                  </td>
                </tr>
                <tr>
                  <th>Status</th>
                  <td>
                    <select name="status" class="form-control">
                      <option>Active</option>
                      <option>Inactive</option>
                    </select>

                  </td>

                  <td colspan="8">
                    <input type="submit" name="submit" value="Save" class="btn btn-block btn-primary">
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

<?php require("../footer.php");
