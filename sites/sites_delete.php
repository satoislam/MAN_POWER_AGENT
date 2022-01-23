<?php
$page = "sites";
session_start();
require_once("../header.php");
require_once("../sidebar.php");
require_once("../db_config.php");
 $d=$_GET['ram'];

 $data=$conn->query("DELETE FROM `sites` WHERE id=$d");
 $_SESSION['msg']='Deleted successfully!';
$_SESSION['class']='danger';

         ?>

    <script>
    window.location.href=("view_sites.php");
    </script>
       
