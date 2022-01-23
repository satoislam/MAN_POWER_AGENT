<?php
$page = "Dashboard";
require_once("../db_config.php");
require_once("../header.php");
require_once("../sidebar.php");


if (isset($_POST['siteID'])) {
    $siteID=$_POST['siteID'];
    $workerID=$_POST['workerID'];
    $per_day_salary=$_POST['per_day_salary'];
    $ot_rate=$_POST['ot_rate'];
    $type=$_POST['type'];
    $monthID=$_POST['monthID'];
    $status=$_POST['status'];

    $yy=$conn->query("INSERT INTO `worker_assign` (`id`, `siteID`, `workerID`, `per_day_salary`, `ot_rate`, `type`, `monthID`, `status`) VALUES (NULL, '$siteID', '$workerID', '$per_day_salary', '$ot_rate', '$type', '$monthID', '$status')"); ?>


<script>
  window.location.href = "worker_assign.php";
</script>

<?php
} ?>


<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Assign Worker</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Assign Worker</a></li>
        </ol>
      </div>
    </div>
  </div>
</section>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-center">
            <h3>
              Assign Work to Worker
            </h3>


          </div>

          <div class="card-body">
            <form action="" method="post">
              <table class="table table-bordered table-striped table-hover ">
                <tr>
                  <th>Sectors Name</th>
                  <td colspan="6">

                    <select id="div" class="form-control">
                      <option>Select Sectors Name </option>
                      <?php
                 $sectors= $conn->query("SELECT * FROM `sectors`");
                 while ($ectors=$sectors->fetch_assoc()) { ?>
                      <option
                        value="<?php echo $ectors['id']; ?>">
                        <?php echo $ectors['sector_name']; ?>
                      </option>
                      <?php
                }
                ?>
                  </td>
                  </select>

                  <th id="dis">
                    <select class="form-control" name="siteID" disabled>

                    </select>
                </tr>
                <tr>
                  <th>Worker Name</th>
                  <td colspan="4">
                    <select class="form-control" name="workerID">
                      <option value="">Select Worker Name </option>
                      <?php
                 $emp_table = $conn->query("SELECT * FROM `worker` ");

                 while ($emp_data = $emp_table->fetch_assoc()) { ?>
                      <option
                        value="<?php echo $emp_data['id']; ?>">
                        <?php echo $emp_data['name']; ?>
                      </option>
                      <?php
                }
                ?>
                  </td>
                  </select>

                  <th>Per Day Salary</th>
                  <td colspan="4">
                    <input type="text" name="per_day_salary" class="form-control">
                  </td>
                </tr>
                <tr>
                  <th>Over Time Rate</th>
                  <td colspan="4">
                    <input type="text" name="ot_rate" class="form-control">
                  </td>



                  <th>Type</th>
                  <td colspan="4">
                    <select class="form-control" name="type">
                      <option value="0">Select type Name </option>


                      <option value="1"> resident </option>
                      <option value="2">non_resident </option>


                  </td>
                  </select>
                </tr>
                <tr>

                  <th>Month Name</th>
                  <td colspan="4">
                    <select class="form-control" name="monthID">
                      <option value="">Select month Name </option>
                      <?php
                 $month_table = $conn->query("SELECT * FROM `month` ");

                 while ($month_show = $month_table->fetch_assoc()) { ?>
                      <option
                        value="<?php echo $month_show['id']; ?>">
                        <?php echo $month_show['month_name']; ?>
                      </option>
                      <?php
                }
                ?>
                  </td>
                  </select>




                  <th>Status</th>
                  <td colspan="4">
                    <select class="form-control" name="status">
                      <option value="0">Select type Name </option>
                      <option value="1">active</option>
                      <option value="2">inactive</option>

                  </td>
                  </select>
                </tr class="text-center">
                </td>
                <td colspan="10">
                  <input type="submit" name="submit" value="Save" class="btn btn-block btn-success">
                </td>
                </tr>
              </table>
            </form>


          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th colspan="7" class="text-center">Work Assent Table
                  <th>
                </tr>
                <?php
            if (isset($_GET['Siten']) && isset($_GET['Workern']) && isset($_GET['Monthn'])) {
                echo"";
            } else {?>

                <form method="post">
                  <tr>
                    <td colspan="2">
                      <label>Enter Search Site Name </label>
                      <select class="form-control" name="Siten">
                        <option disabled selected value>Select Site Name </option>
                        <?php
                 $sit= $conn->query("SELECT * FROM `sites`");
                 while ($si=$sit->fetch_assoc()) { ?>
                        <option
                          value="<?php echo $si['id']; ?>">
                          <?php echo $si['site_name']; ?>
                        </option>
                        <?php
                }
                ?>
                    </td>
                    </select>
                    <td colspan="2">

                      <label>Enter Search Worker Name </label>
                      <select class="form-control" name="Workern">
                        <option disabled selected value>Select Worker Name </option>
                        <?php
                 $W_table = $conn->query("SELECT * FROM `worker` ");

                 while ($em_data = $W_table->fetch_assoc()) { ?>
                        <option
                          value="<?php echo $em_data['id']; ?>">
                          <?php echo $em_data['name']; ?>
                        </option>
                        <?php
                }
                ?>
                      </select>
                    <td colspan="2">
                      <label>Enter Search Month Name </label>
                      <select class="form-control" name="Monthn">
                        <option disabled selected value>Select month Name </option>
                        <?php
                $mont_table = $conn->query("SELECT * FROM `month` ");

                while ($month_s = $mont_table->fetch_assoc()) { ?>
                        <option
                          value="<?php echo $month_s['id']; ?>">
                          <?php echo $month_s['month_name']; ?>
                        </option>
                        <?php
                }
                ?>
                    </td>
                    </select>


                    <td colspan="3">
                      <label>&nbsp;&nbsp;&nbsp;&nbsp;</label>
                      <input type="submit" name="submit" class=" btn-info form-control" value="Search" />
                    </td>
                  </tr>
                </form>
                <?php } ?>


                <tr>
                  <th>Serial</th>
                  <th>Site Name</th>
                  <th>Worker Name </th>
                  <th>Per Day Salary</th>
                  <th>Over Time Rate</th>
                  <th>Type</th>
                  <th>Month Name</th>
                  <th>Status</th>
                  <th>Action</th>

                </tr>
              </thead>
              <?php
                    if (isset($_POST["Siten"]) && isset($_POST["Workern"]) && isset($_POST["Monthn"])) {
                        $sites=$_POST['Siten'];
                        $workers=$_POST['Workern'];
                        $months=$_POST['Monthn'];
                        $workerassign=$conn->query("SELECT worker_assign.id,worker_assign.per_day_salary,worker_assign.ot_rate,worker_assign.type,worker_assign.status,sites.site_name,worker.name,month.month_name FROM worker_assign JOIN sites ON sites.id=worker_assign.siteID JOIN worker ON worker.id=worker_assign.workerID JOIN month ON month.id=worker_assign.monthID WHERE siteID={$sites} AND workerID={$workers} AND monthID={$months}");
                    } elseif (isset($_POST["Siten"]) && isset($_POST["Workern"])) {
                        $sites=$_POST['Siten'];
                        $workers=$_POST['Workern'];
                        $workerassign=$conn->query("SELECT worker_assign.id,worker_assign.per_day_salary,worker_assign.ot_rate,worker_assign.type,worker_assign.status,sites.site_name,worker.name,month.month_name FROM worker_assign JOIN sites ON sites.id=worker_assign.siteID JOIN worker ON worker.id=worker_assign.workerID JOIN month ON month.id=worker_assign.monthID WHERE siteID={$sites} AND workerID={$workers}");
                    } elseif (isset($_POST["Siten"]) && isset($_POST["Monthn"])) {
                        $sites=$_POST['Siten'];
                        $months=$_POST['Monthn'];
                        $workerassign=$conn->query("SELECT worker_assign.id,worker_assign.per_day_salary,worker_assign.ot_rate,worker_assign.type,worker_assign.status,sites.site_name,worker.name,month.month_name FROM worker_assign JOIN sites ON sites.id=worker_assign.siteID JOIN worker ON worker.id=worker_assign.workerID JOIN month ON month.id=worker_assign.monthID WHERE siteID={$sites} AND monthID={$months}");
                    } elseif (isset($_POST["Monthn"]) && isset($_POST["Workern"])) {
                        $months=$_POST['Monthn'];
                        $workers=$_POST['Workern'];
                        $workerassign=$conn->query("SELECT worker_assign.id,worker_assign.per_day_salary,worker_assign.ot_rate,worker_assign.type,worker_assign.status,sites.site_name,worker.name,month.month_name FROM worker_assign JOIN sites ON sites.id=worker_assign.siteID JOIN worker ON worker.id=worker_assign.workerID JOIN month ON month.id=worker_assign.monthID WHERE monthID={$months}  AND workerID={$workers}");
                    } elseif (isset($_POST["Siten"])) {
                        $sites=$_POST['Siten'];
                        $workerassign=$conn->query("SELECT worker_assign.id,worker_assign.per_day_salary,worker_assign.ot_rate,worker_assign.type,worker_assign.status,sites.site_name,worker.name,month.month_name FROM worker_assign JOIN sites ON sites.id=worker_assign.siteID JOIN worker ON worker.id=worker_assign.workerID JOIN month ON month.id=worker_assign.monthID WHERE siteID={$sites}");
                    } elseif (isset($_POST["Workern"])) {
                        $workers=$_POST['Workern'];
                        $workerassign=$conn->query("SELECT worker_assign.id,worker_assign.per_day_salary,worker_assign.ot_rate,worker_assign.type,worker_assign.status,sites.site_name,worker.name,month.month_name FROM worker_assign JOIN sites ON sites.id=worker_assign.siteID JOIN worker ON worker.id=worker_assign.workerID JOIN month ON month.id=worker_assign.monthID WHERE workerID={$workers}");
                    } elseif (isset($_POST["Monthn"])) {
                        $months=$_POST['Monthn'];
                        $workerassign=$conn->query("SELECT worker_assign.id,worker_assign.per_day_salary,worker_assign.ot_rate,worker_assign.type,worker_assign.status,sites.site_name,worker.name,month.month_name FROM worker_assign JOIN sites ON sites.id=worker_assign.siteID JOIN worker ON worker.id=worker_assign.workerID JOIN month ON month.id=worker_assign.monthID WHERE monthID={$months}");
                    } else {
                        $workerassign=$conn->query("SELECT worker_assign.id,worker_assign.per_day_salary,worker_assign.ot_rate,worker_assign.type,worker_assign.status,sites.site_name,worker.name,month.month_name FROM worker_assign JOIN sites ON sites.id=worker_assign.siteID JOIN worker ON worker.id=worker_assign.workerID JOIN month ON month.id=worker_assign.monthID");
                    }
                    
                    // var_dump($workerassign);
                    $i=0;
                    while ($workerassignrow=$workerassign->fetch_assoc()) {?>
              <tr>
                <td><?= ++$i;?>
                </td>
                <td><?= $workerassignrow['site_name'];?>
                </td>
                <td><?= $workerassignrow['name'];?>
                </td>
                <td><?= $workerassignrow['per_day_salary'];?>
                </td>
                <td><?= $workerassignrow['ot_rate'];?>
                </td>
                <td><?= $workerassignrow['type'];?>
                </td>
                <td><?= $workerassignrow['month_name'];?>
                </td>
                <td><?= $workerassignrow['status'];?>
                </td>
                <td>

                  <a href="update.php?id=<?php echo $workerassignrow['id'] ?>"
                    class=" btn btn-sm  btn-success "><i class="fas fa-edit"></i></a> |
                  <a href="delete.php?id=<?php echo $workerassignrow['id'] ?>"
                    class=" btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i
                      class="fas fa-trash"></i></a>
                </td>

              </tr>

              <?php } ?>



            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require("../footer.php"); ?>

<script>
  $(document).ready(function() {
    $('#div').change(function() {
      var divID = $(this).val()
      $.ajax({
        url: "district.php",
        type: "post",
        data: {
          "id": divID
        },
        success: function(data) {
          $('#dis').html(data)
        }
      })
    })
  })
</script>