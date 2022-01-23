<?php
$page = "worker_attendence";
require_once("../header.php");
require_once("../sidebar.php");
require_once("../db_config.php");



$dpt=$conn->query("SELECT * FROM `worker`");
$dt=$conn->query("SELECT * FROM `month`");



if (isset($_POST['status'])) {
    $wrokerID=$_POST['wrokerID'];
    $status=$_POST['status'];
    $date=$_POST['date'];
    $month=$_POST['monthID'];
    $time=$_POST['over_time'];
   

    $bb=$conn->query("INSERT INTO `worker_attendance` ( `wrokerID`, `status`, `date`, `monthID`, `over_time`) VALUES ('$wrokerID', '$status', '$date','$month', '$time')"); ?>
<script>
  // window.location.href="worker_attendance.php";
</script>

<?php
}


?>



<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Worker Attendance</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home/</a></li>
          <li class="breadcrumb-item"><a href="#">Worker Attendance</a></li>
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
            <a href="./Mon_atten_menu.php" class="btn btn-md btn-info ">Monthly Attendance Report</a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <h1 class="mt-3" style="text-align: center; color: green">Add  Worker Attendance</h1>


            <form action="file.php" method="post" enctype="multipart/form-data">

              <p>Upload a CSV File:</p>
              <input type="file" name="file" id="">
              <br><br>
              <td colspan="6">
                <input type="submit" name="submit" value="Upload">

            </form>
            </td>
            <tr />


            <form action="" method="post">
              <table class="table table-bordered" style="hover:background-color:red;">


                <tr :hover {background-color:red;}></tr>
                <tr>
                  <label class="col-sm-3 col-form-label">Worker id</label>
                  <select name="wrokerID" class="form-control">
                    <option value="">Select Worker Name</option>

                    <?php while ($d=$dpt->fetch_assoc()) { ?>
                    <option
                      value="<?php echo $d['id'] ?>">
                      <?php echo $d['name']; ?>
                    </option>
                    <?php } ?>
                  </select>
                  <tr />
                  <th>Status
                    <th />
                  <td>
                    <input type="radio" name="status" value="present"><span>present </span>
                    <input type="radio" name="status" value="absent"><span> absent</span>
                  </td>
                  <div class="col-sm-6">
                    <th>Date</th>
                    <td><input type="date" name="date" class="form-control"></td>
                    <th>Over_time</th>
                    <td><input type="text" name="over_time" class="form-control"></td>
                <tr>
                  <label class="col-sm-3 col-form-label">Month id</label>
                  <select name="monthID" class="form-control">
                    <option value="">Select month Name</option>

                    <?php while ($m=$dt->fetch_assoc()) { ?>
                    <option
                      value="<?php echo $m['id'] ?>">
                      <?php echo $m['month_name']; ?>
                    </option>
                    <?php } ?>
                  </select>
                  <tr />
                <tr>
                  <td colspan="6">
                    <input type="submit" class="btn btn-block btn-primary" value="Save">
                  </td>
                </tr>


              </table>

            </form>







            <?php
                $m=$conn->query("SELECT worker_attendance.*,worker.name,worker.iqama_number,month.month_name FROM `worker_attendance` JOIN worker ON worker_attendance.wrokerID=worker.id JOIN month ON worker_attendance.monthID=month.id ORDER BY worker_attendance.id DESC");
                ?>
          </div>

          <div class="container">
            <div class="rowclearfix">
              <div class="col-md-2">
                <br>

              </div>
              <hr>
              <div class="col-md-12">
                <h1> Information</h1>
                <table class="table table-striped hover">
                  <thead>
                    <tr>
                      <th>Sl</th>
                      <th>Name</th>
                      <th>Month Name</th>
                      <th>Status</th>
                      <th>Date</th>
                      <th>Over time</th>
                      <th>Iqama number</th>
                      <th>Action</th>

                    </tr>

                  </thead>
                  <tr>

                    <?php
                           $i=0;
                   while ($ii=$m->fetch_assoc()) {
                       ?>

                    <td><?php echo++$i?>
                    </td>
                    <td><?php echo$ii['name']; ?>
                    </td>
                    <td><?php echo$ii['month_name']; ?>
                    </td>
                    <td><?php echo$ii['status']; ?>
                    </td>
                    <td><?php echo$ii['date']; ?>
                    </td>
                    <td><?php echo$ii['over_time']; ?>
                    </td>
                    <td><?php echo$ii['iqama_number']; ?>
                    </td>

                    <td>
                      <a class=" btn btn-info btn-sm"
                        href="worker_updated.php?ff=<?php echo $ii['id'] ?>">EDIT</a>

                      |
                      <a href="worker_deleted.php?ff=<?php echo $ii['id'] ?>"
                        class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>

                    </td>
                  </tr>
                  <?php
                   } ?>
                </table>
              </div>
            </div>
          </div>
          </th>
          </tr>
          </table>
          </form>










          <!-- /.card-header -->



        </div>
      </div>
      <!-- /.card -->
    </div>
  </div>
  </div><!-- /.container-fluid -->
</section>



<?php require("../footer.php");
