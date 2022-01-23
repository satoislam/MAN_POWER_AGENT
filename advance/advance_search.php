<?php
$page = "Search Advance";
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
                <h1><i class="fas fa-file text-cyan"></i> Advance Report </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right text-bold">
                    <li class="breadcrumb-item"><a class="text-secondary" href="./">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-navy" href="#"><?= $page; ?></a></li>
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
                                <h2 class="text-center mb-md-0 " style="margin-left: 16rem;">Advance Report (Monthly)</h2>
                            </div>
                            <div class="col-md-3 text-right">
                                <a href="advance.php" class="btn btn-md btn-info"><i class="fas fa-eye"></i>
                                    View All</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered">
                            <tr>
                                <th>
                                    <label for="days">Select Worker</label>
                                    <select class="form-control" id="workerId">
                                        <option value="">Select Worker</option>
                                        <?php

                                          $workerTable = $conn->query("SELECT * FROM worker");
                                          while ($worker = $workerTable->fetch_assoc()) { ?>
                                        <option
                                            value="<?php echo $worker['id']; ?>">
                                            <?php echo $worker['name']; ?>
                                        </option>
                                        <?php
                                            }
                                            ?>
                                    </select>
                                </th>
                                <th>
                                    <div class="row">
                                        <div class="col">
                                            <label for="month">Month</label>
                                            <input type="month" name="month" id="month" class="date-picker form-control " />
                                        </div>

                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="submit" class="btn btn-block btn-info" value="search" id="search">
                                </td>
                            </tr>
                        </table>

                        <hr>


                        <!--   show advance info -->
                        <div class="advanceSearch"></div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require("../footer.php"); ?>

<script>
    $(document).ready(function() {
        $('.date-picker').datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'yy-mm',

            onClose: function() {
                var iMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var iYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                $(this).datepicker('setDate', new Date(iYear, iMonth, 1));
            },

            beforeShow: function() {
                if ((selDate = $(this).val()).length > 0) {
                    iYear = selDate.substring(selDate.length - 4, selDate.length);
                    iMonth = jQuery.inArray(selDate.substring(0, selDate.length - 5),
                        $(this).datepicker('option', 'monthNames'));
                    $(this).datepicker('option', 'defaultDate', new Date(iYear, iMonth, 1));
                    $(this).datepicker('setDate', new Date(iYear, iMonth, 1));
                }
            }
        });


        //search
        $('#search').on('click', function(e) {
            var workerId = $('#workerId').val();
            var month = $('#month').val();

            //ajax call
            $.ajax({
                url: "fetch_advance.php",
                method: "get",
                data: {
                    "sendworkerId": workerId,
                    "sendMonth": month
                },
                success: function(response) {
                    $('.advanceSearch').html(response);
                    console.log(response);
                }
            })

        });

    });
</script>