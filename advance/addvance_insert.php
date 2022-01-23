<?php

$page = "Add Advance";
require_once("../header.php");
@session_start();
if (!isset($_SESSION['name'])) {
    header("location: $serverName/index.php");
}
require_once("../sidebar.php");
require_once("../db_config.php");

?>



<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a class="text-secondary" href="./">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-navy" href="#">Add Advance</a></li>
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
                    <!-- /.card-header -->
                    <div class="card-header ">
                        <div class="row">
                            <div class="col-md-9">
                                <h2 style="margin-left: 16rem;" class="text-center mb-0 ">New Advance</h2>
                            </div>
                            <div class="col-md-3 text-right">
                                <a href="./advance.php" class="btn btn-md btn-info">
                                    Advance List</a>
                            </div>
                        </div>
                    </div>

                    <!--card body-->
                    <div class="card-body">
                        <!--insert form -->

                        <form autocomplete="off" method="post" id="advance_modal">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="worker">Select Worker </label>
                                        <select class="form-control" name="worker">
                                            <option value="">Select Worker</option>
                                            <?php
                               $worker_add = $conn->query("SELECT * FROM `worker`");
                               while ($fetch_worker = $worker_add->fetch_assoc()) { ?>
                                            <option
                                                value="<?= $fetch_worker['id']; ?>">
                                                <?= $fetch_worker['name']; ?>
                                            </option>

                                            <?php
                               }
                            ?>
                                        </select>
                                        <span id="worker_empty" style="color:red"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="month">Select Month</label>
                                        <select class="form-control" name="month">
                                            <option value="">Select Month</option>
                                            <?php
                               $month_add = $conn->query("SELECT * FROM `month`");
                               while ($fetch_month = $month_add->fetch_assoc()) { ?>
                                            <option
                                                value="<?= $fetch_month['id']; ?>">
                                                <?= $fetch_month['month_name']; ?>
                                            </option>

                                            <?php
                               }
                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="number" autocomplete="nope" class="form-control" name="amount">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" autocomplete="nope" class="form-control" name="date">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" name="advance_ins" class="btn btn-info mb-5">Add</button>

                        </form>

                        <!-- insert query-->
                        <?php
                            if (isset($_POST['worker'])) {
                                $worker = $_POST['worker'];
                                $month = $_POST['month'];
                                $amount = $_POST['amount'];
                                $date = $_POST['date'];
                                

                                if (empty($worker)  || empty($month)  || empty($amount)  || empty($date)) {
                                    ?>
                        <!-- Display alert at the bottom-center position of the window -->
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Ow snap!!</strong> No Field can be empty.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <?php
                                } else {
                                    $result = $conn->query("INSERT INTO `advance` ( `workerID`, `monthID`, `amount`, `date`) VALUES ( '$worker', '$month', '$amount', '$date')");
                                    if ($result == true) {  ?>

                        <!-- Display alert at the bottom-center position of the window -->
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Congrats!!</strong> Data Inserted Successfully.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <?php
                                    }
                                }
                            }

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<?php require("../footer.php"); ?>


<?php
   if (isset($_POST['editIdSend'])) {
       $editId = $_POST['editIdSend'];
       $fetch_advance = $conn->query("SELECT advance.`id`, advance.`workerID`, worker.name, advance.`monthID`, month.month_name, advance.amount, advance.date FROM `advance` JOIN worker ON worker.id= advance.workerID JOIN month ON month.id= advance.monthID WHERE advance.`id`=$editId");
       $fetch = $fetch_advance->fetch_assoc();

       
       echo $fetch;
   }
