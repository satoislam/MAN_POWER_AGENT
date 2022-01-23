<?php
$page = "Invoice";
require_once("../header.php");
require_once("../sidebar.php");
require_once("../db_config.php");
$month = $conn->query("SELECT * FROM month");
$sites = $conn->query("SELECT * FROM sites");
?>




<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Invoice</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home/</a></li>
          <li class="breadcrumb-item"><a href="#">Invoice</a></li>
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
          <div class="card-header ">
            <div class="row">
              <div class="col-md-9">
                <h3 class="mb-md-0 " >Generate Invoice</h3>
              </div>
              <div class="col-md-3 text-right">
                <a href="./invoice_list.php" class="btn btn-md btn-info"><i class="fas fa-list "></i>
                  Invoice Lists</a>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <form action="" method="POST">
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="month">Month</label>
                  <select class="form-control" id="month" name="month">
                    <option value="0">Select Month</option>
                    <?php while ($m = $month->fetch_assoc()) { ?>
                    <option
                      value="<?php echo $m['id'] ?>">
                      <?php echo $m['month_name'] ?>
                    </option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="site">Site</label>
                  <select class="form-control" id="site" name="site">
                    <option value="0">Select Site</option>
                    <?php while ($s = $sites->fetch_assoc()) { ?>
                    <option
                      value="<?php echo $s['id'] ?>">
                      <?php echo $s['site_name'] ?>
                    </option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
                <div class="col-md-12">
                  <input type="submit" class="btn btn-info btn-block" value="Generate Invoice">
                </div>
              </div>
            </form>
            <?php 
               if (isset($_POST['month']) && isset($_POST['site'])) {
                        $month = $_POST['month'];
                        $site = $_POST['site'];

                        $worker = $conn->query("SELECT * FROM `worker_assign` JOIN worker ON worker.id=worker_assign.workerID WHERE`siteID`={$site} AND `monthID`={$month} AND worker_assign.status='active'");

                        $dat = $conn->query("SELECT * FROM `month` WHERE id={$month}");
                        $da = $dat->fetch_assoc();
                        $date = $da["month_name"];


                        $orderdate = explode(',', $date);
                        $mo = $orderdate[0];
                        $yr = (int)$orderdate[1];
                        $month_number = date("n", strtotime($mo));
                        var_dump($month_number);
                        $day_in_mon = cal_days_in_month(CAL_GREGORIAN, $month_number, $yr);

                        echo $day_in_mon;
                        $wr = $worker->num_rows;
                        if ($wr > 0) { ?>

            <table class="content-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Iqama Number</th>
                  <th>Working Days</th>
                  <th>Daily Salary</th>
                  <th>Salary</th>
                  <th>OT Hour</th>
                  <th>OT Rate</th>
                  <th>OverTime</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php
                    $subtotal = 0;
                    while ($w = $worker->fetch_assoc()) {
                        $total_pr = $conn->query("SELECT COUNT(*) as total_present, SUM(over_time) as ot FROM `worker_attendance` WHERE `monthID`={$month} AND `status`='present' AND `wrokerID`={$w['workerID']}");
                        $total_pre = $total_pr->fetch_assoc();
                        $ot_r = $total_pre['ot'];
                        $total_present = $total_pre['total_present'];
                        $weekand = 0;
                        for ($i = 1; $i <= $day_in_mon; $i++) {
                            $timestamp = strtotime("{$yr}-{$month_number}-{$i}");
                            $day = date('D', $timestamp);
                            if ($day == "Fri") {
                                $weekand++;
                            }
                        }
                        $work_weekand = $total_present + $weekand;
                        $salary = $work_weekand * $w['per_day_salary'];
                        $ot = $ot_r * $w['ot_rate'];
                        $total = $salary + $ot;


                        $subtotal += $total; ?>
                <tr>
                  <td><?php echo $w['workerID'] ?>
                  </td>
                  <td><?php echo $w['name'] ?>
                  </td>
                  <td><?php echo $w['iqama_number'] ?>
                  </td>
                  <td><?php echo $work_weekand ?>
                  </td>
                  <td><?php echo $w['per_day_salary'] ?>
                  </td>
                  <td><?php echo number_format("$salary", 2); ?>
                  </td>
                  <td><?php echo $ot_r ?>
                  </td>
                  <td><?php echo $w['ot_rate'] ?>
                  </td>
                  <td><?php echo number_format("$ot", 2); ?>
                  </td>
                  <td><?php echo number_format("$total", 2); ?>
                  </td>
                </tr>
                <?php
                    }
                    ?>
                <tr>
                  <td colspan="9" class="text-right">
                    <h5>Sub Total=</h5>
                  </td>
                  <td>
                    <h5><?php echo number_format("$subtotal", 2); ?>
                    </h5>
                  </td>
                </tr>
              </tbody>
            </table>
            <!-- The Modal -->
            <div class="modal" id="myModal">
              <div class="modal-dialog">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                    Modal body..
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>

                </div>
              </div>
            </div>

            <?php
                $t_date = date("Y-m-d");
                $check = $conn->query("SELECT * FROM `invoice` WHERE siteID=1 AND monthID=1");
                $chk = $check->num_rows;
                if ($chk > 0) {
                    $showModal = "true";
                    echo '<script>alert("Already Generated!")</script>';
                } else {
                    $ins = $conn->query("INSERT INTO `invoice` (`id`, `siteID`, `monthID`, `amount`, `invoice_date`) VALUES (NULL, '{$site}', '{$month}', '$total', '{$t_date}');");
                }
              } else {
                  echo "<h2 class='text-center mt-5 text-danger'>No Record Found!</h2>";
              }
                    } else {
                        echo "<h2 class='text-center mt-5 text-danger'>Select Month & Site for Invoice</h2>";
                    }
            ?>
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<script type="text/javascript">
  document.getElementById('site').value =
    "<?php echo $_POST['site']; ?>";
  document.getElementById('month').value =
    "<?php echo $_POST['month']; ?>";
</script>


<?php require("../footer.php"); ?>
<?php
    if (isset($showModal)) {
        // CALL MODAL HERE
        echo '<script type="text/javascript">
			$(document).ready(function(){
				$("#myModal").modal("show");
			});
		</script>';
        echo 'ssa';
    }
