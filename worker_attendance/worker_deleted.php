<?php

require_once("../header.php");
require_once("../sidebar.php");
require_once("../db_config.php");



$id=$_GET['ff'];
$data=$conn->query("DELETE FROM `worker_attendance` WHERE worker_attendance.`id`=$id");
$_SESSION['msg']='Deleted successfully!';
$_SESSION['class']='danger';
?>

 <script>
window.location.href="worker_attendance.php";
</script> 


                 

 
             