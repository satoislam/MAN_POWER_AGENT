<?php
require("../header.php");
@session_start();
if (!isset($_SESSION['name'])) {
    header("location: $serverName/index.php");
}
require("../sidebar.php");
require("../db_config.php");

//edit query
if (isset($_GET['advance_editId'])) {
    $advance_editId = $_GET['advance_editId'];
    $editFetch = $conn->query("SELECT advance.id AS advance_id, advance.workerID, worker.name, advance.amount, advance.date, advance.monthID , month.month_name FROM `advance` JOIN worker ON advance.workerID= worker.id JOIN month ON month.id= advance.monthID WHERE advance.`id`= $advance_editId");
    $fetch = $editFetch->fetch_assoc();

}



?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="far fa-money-bill-alt text-cyan"></i> Advance</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right text-bold">
                    <li class="breadcrumb-item"><a class="text-secondary" href="./">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-navy" href="#">Advance</a></li>
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
                        <h2 class="text-center mb-md-0 ">Update Advance</h2>
                    </div>


                    <!-- /.card-body -->
                    <div class="card-body">

                        <!-- /.form (update) -->
                        <form method="post">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="edit_name">Name</label>
                                    <select name="update_name" class="form-control" id="" readonly>
                                        <option
                                            value="<?= $fetch['workerID']; ?>">
                                            <?= $fetch['name']; ?>
                                        </option>
                                    </select>
                                    <input type="hidden" id="update_id"
                                        value="<?= $fetch['advance_id']; ?>"
                                        name="update_id">
                                </div>
                                <div class="col">
                                    <label for="select_month">Select Month</label>
                                    <select class="form-control " name="update_month">
                                        <option
                                            value="<?= $fetch['monthID']; ?>">
                                            <?= $fetch['month_name']; ?>
                                        </option>

                                        <?php
                                           $monthTable = $conn->query("SELECT * FROM month");
                                            while ($all_month = $monthTable->fetch_assoc()) {
                                                if ($fetch['monthID'] != $all_month['id']) { ?>
                                        <option
                                            value="<?= $all_month['id']; ?>">
                                            <?$all_month['month_name'] ?>
                                        </option>
                                        <?php
                                                  }
                                            }
                                        ?>
                                    </select>

                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <label for="edit_amount">Amount</label>
                                    <input type="number" class="form-control" name="update_amount"
                                        value="<?= $fetch['amount']; ?>">
                                </div>
                                <div class="col">
                                    <label for="edit_date">Date</label>
                                    <input type="date" class="form-control" name="update_date"
                                        value="<?= $fetch['date']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="submit" class="form-control btn btn-info" value="Update">
                                </div>
                            </div>
                        </form>

                        <?php
                           if (isset($_POST['update_id'])) {
                               $update_id = $_POST['update_id'];
                               $update_name = $_POST['update_name'];
                               $update_amount = $_POST['update_amount'];
                               $update_date = $_POST['update_date'];
                               $update_month = $_POST['update_month'];

                               $up_table = $conn->query("UPDATE `advance` SET `workerID`='$update_name',`monthID`=' $update_month',`amount`='$update_amount',`date`='$update_date' WHERE `id`=$update_id");
                               if ($up_table) {
                                   echo "updated successfully";
                               } else {
                                   echo "Could not update";
                               } ?>

                        <script>
                            window.location.href = "advance.php";
                        </script>

                        <?php
                           }
                        
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require("../footer.php");
