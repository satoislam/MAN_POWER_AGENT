<?php
session_start();
$page = "Dashboard";
require_once("../header.php");
require_once("../sidebar.php");
require_once("../db_config.php");
 ?>
<?php
$id=$_GET['ram'];
$data=$conn->query("DELETE FROM sectors WHERE id=$id");
$_SESSION['msg']='Deleted successfully!';
$_SESSION['class']='danger';
?>

<script>
	window.location.href=("sectors.php");
</script>
