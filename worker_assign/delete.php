<?php
require_once("../db_config.php");
require_once("../header.php");
require_once("../sidebar.php");

$id=$_GET['id'];
$data=$conn->query("DELETE FROM `worker_assign` WHERE `id`=$id");


// header('Location: view_emp.php');
?>

        <script> 
      window.location.assign("index.php");
     </script>