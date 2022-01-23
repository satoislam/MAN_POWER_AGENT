<?php 
require_once("../header.php");
require_once("../sidebar.php");
require_once("../db_config.php");

$id=$_GET['id'];
$conn->query("DELETE FROM `payments` WHERE `payments`.`id` = '$id'");

?>

<script type="text/javascript">
	window.location.href = "payments.php";
</script>

<?php
?>