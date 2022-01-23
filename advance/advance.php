<?php
$page = "Advance";
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
                        <div class="row">
                            <div class="col-md-9">
                                <h2 class="text-center mb-md-0 " style="margin-left: 16rem;">Advance</h2>
                            </div>
                            <div class="col-md-3 text-right">
                                <a href="addvance_insert.php" class="btn btn-md btn-info"><i class="fas fa-plus"></i>
                                    Add Advance</a>
                                <a href="advance_search.php" class="btn btn-md btn-info"><i class="fas fa-search"></i>
                                    Search Advance</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">


                        <table id="myTable" class="table table-responsive-sm  table-striped table-hover"
                            style="text-align: center;">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Worker Name</th>
                                    <th>Month</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <?php
                                $advanceTable = $conn->query("SELECT advance.id, advance.workerID, worker.name, advance.monthID, month.month_name, advance.amount, advance.date FROM `advance` JOIN worker ON worker.id= advance.workerID JOIN month ON month.id= advance.monthID");
                                $i=1;
                                while ($advance_row = $advanceTable->fetch_assoc()) {
                                    $edit_id = $advance_row['id']; ?>
                            <tr>
                                <td class="align-middle">
                                    <?= $i++; ?>
                                </td>
                                <td class="align-middle"><?= $advance_row['name'] ?>
                                </td>
                                <td class="align-middle"><?= $advance_row['month_name'] ?>
                                </td>
                                <td class="align-middle"><?= $advance_row['amount'] ?>
                                </td>
                                <td class="align-middle"><?= $advance_row['date'] ?>
                                </td>
                                <td class="align-middle">
                                    <a href="./advance_edit.php?advance_editId=<?= $advance_row['id']; ?>"
                                        class="btn btn-sm btn-info advance-edit">Edit</a>
                                    <a href="./advance.php?advance_delId=<?= $advance_row['id']; ?>"
                                        class="btn btn-sm btn-danger "
                                        onclick="return confirm('Are you sure to delete this row (<?= $advance_row['id']; ?>)?')">Delete</a>
                                </td>
                            </tr>

                            <?php
                                }

                            // delete row (query)
                            if (isset($_GET['advance_delId'])) {
                                $advance_delId = $_GET['advance_delId'];
                                $conn->query("DELETE FROM advance WHERE id = $advance_delId"); ?>

                            <script>
                                window.location.href = "advance.php";
                            </script>
                            <?php
                            }
                            ?>

                        </table>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


<?php require_once("../footer.php"); ?>




<script>
    jQuery(document).ready(function($) {

        $('#myTable').DataTable({});



    });
</script>