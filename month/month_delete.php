<?php
require_once("../db_config.php");
require_once("../header.php");
require_once("../sidebar.php");

$id=$_GET['id'];
$data=$conn->query("DELETE FROM  month WHERE id=$id");

?>

        <script> 
      window.location.assign("month.php");
     </script>