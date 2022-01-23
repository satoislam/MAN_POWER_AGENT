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
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-9">
                                <h3 class="mb-md-0 ">Search Invoice</h3>
                            </div>
                            <div class="col-md-3 text-right">
                                <a href="./invoice.php" class="btn btn-md btn-info"><i class="fas fa-file-invoice"></i>
                                    Invoice</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php
                        if (isset($_GET['mo_id']) && isset($_GET['si_id'])) {?>
                        <a href="invoice_list.php" class="btn btn-warning">Back to Invoice List</a>
                        <?php
                            $month = $_GET['mo_id'];
                            $site = $_GET['si_id'];
                            $worker = $conn->query("SELECT * FROM `worker_assign` JOIN worker ON worker.id=worker_assign.workerID WHERE`siteID`={$site} AND `monthID`={$month} AND worker_assign.status='active'");

                            $dat = $conn->query("SELECT * FROM `month` WHERE id={$month}");
                            $da = $dat->fetch_assoc();
                            $date = $da["month_name"];

                            $orderdate = explode(',', $date);
                            $mo = $orderdate[0];
                            $yr = (int)$orderdate[1];
                            $month_number = date("n", strtotime($mo));
                            $day_in_mon = cal_days_in_month(CAL_GREGORIAN, $month_number, $yr);


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
                        <?php
                            } else {?>
                        <a href="invoice_list.php" class="btn btn-warning">Back to Invoice List</a>
                        <h2 class='text-center mt-5 text-danger'>No Record Found!</h2>
                        <?php
                            }
                        } else { ?>
                        <form action="" method="POST">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="month">Month</label>
                                    <select class="form-control" id="month" name="month">
                                        <option disabled selected value>Select Month</option>
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
                                        <option disabled selected value>Select Site</option>
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
                                    <input type="submit" class="btn btn-info btn-block" value="Get Invoice">
                                </div>
                            </div>
                        </form>

                        <?php

                            if (isset($_POST['month']) && isset($_POST['site'])) {
                                echo $month = $_POST['month'];
                                echo $site = $_POST['site'];
                                $invoice_list = $conn->query("SELECT * FROM `invoice` JOIN sites ON sites.id=invoice.siteID JOIN month ON month.id=invoice.monthID WHERE siteID={$site} AND monthID={$month}");
                            } elseif (isset($_POST['month'])) {
                                $month = $_POST['month'];
                                $invoice_list = $conn->query("SELECT * FROM `invoice` JOIN sites ON sites.id=invoice.siteID JOIN month ON month.id=invoice.monthID WHERE monthID={$month}");
                                var_dump($invoice_list);
                            } elseif (isset($_POST['site'])) {
                                $site = $_POST['site'];
                                $invoice_list = $conn->query("SELECT * FROM `invoice` JOIN sites ON sites.id=invoice.siteID JOIN month ON month.id=invoice.monthID WHERE siteID={$site}");
                            } else {
                                $invoice_list = $conn->query("SELECT * FROM `invoice` JOIN sites ON sites.id=invoice.siteID JOIN month ON month.id=invoice.monthID");
                            }
                            ?>
                        <table class="content-table">
                            <thead>
                                <tr>
                                    <th>Site Name</th>
                                    <th>Month</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while ($il = $invoice_list->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $il['site_name']; ?>
                                    </td>
                                    <td><?php echo $il['month_name']; ?>
                                    </td>
                                    <td><?php echo $il['amount']; ?>
                                    </td>
                                    <td><?php echo $il['invoice_date']; ?>
                                    </td>
                                    <td><a href="invoice_list.php?mo_id=<?php echo $il['monthID']; ?>&si_id=<?php echo $il['siteID']; ?>"
                                            class="btn btn-warning">Details</a></td>
                                </tr>
                                <?php
                                    }
                                    ?>
                            </tbody>
                        </table>
                        <?php
                        }
                        ?>



                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container-fluid -->
    <script type="text/javascript">
        document.getElementById('site').value =
            "<?php echo $_POST['site']; ?>";
        document.getElementById('month').value =
            "<?php echo $_POST['month']; ?>";
    </script>

    <?php require("../footer.php");
