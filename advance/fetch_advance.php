<?php
$serverName = 'http://' . $_SERVER['SERVER_NAME'] . '/man_power_agent';
@session_start();
if (!isset($_SESSION['name'])) {
    header("location: $serverName/index.php");
}
require("../db_config.php");

if (isset($_GET['sendworkerId'])) {
    $sendworkerId = $_GET['sendworkerId'];
    $sendMonth = $_GET['sendMonth'];

    $search_info = $conn->query("SELECT advance.id, worker.id AS worker_id, worker.name AS worker_name, month.month_name, advance.amount, advance.monthID, advance.date FROM `advance` JOIN worker ON worker.id= advance.workerID JOIN month ON month.id= advance.monthID WHERE advance.`workerID` = $sendworkerId && month.month_name LIKE '$sendMonth%'");

    $output = '';
    $styles = "";
    if (empty($sendworkerId) || empty($sendMonth)) {
        $styles= "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>Ow snap!!</strong> No Field can be empty.
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                 </div>";
        echo $styles;
    }

    //if not empty
    else {
        if (mysqli_num_rows($search_info) > 0) {
            $output = "<table class='table table-bordered table-hover table-striped text-center'>
                    <tr>
                        <th>Serial</th>
                        <th>Worker Name</th>
                        <th>Amount</th>
                        <th>Month</th>
                        <th>Date</th>
                    </tr>";

            $i=0;
            $amount_sum=0;
            while ($row = mysqli_fetch_assoc($search_info)) {
                $serial = ++$i;
                $output .= "<tr>
                                <td class='align-middle'>{$serial}</td>
                                <td class='align-middle'>{$row['worker_name']}</td>
                                <td class='align-middle text-right'>{$row['amount']}</td>
                                <td class='align-middle'> {$row['month_name']} </td>
                                <td class='align-middle'>{$row['date']}</td> 
                            </tr>";
                
                $amount_sum += $row['amount'];
            }
           

            $output .= "<tr><th colspan='2'>Total </th><td class='align-middle text-right'>{$amount_sum}</td></tr>";

            $output .= "</table>";
            echo $output;
        } else {
            $styles= "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>Ow snap!!</strong> No record found.
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                 </div>";
            echo $styles;
        }
    }
}
