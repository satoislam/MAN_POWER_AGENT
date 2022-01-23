<?php
$con=new mysqli('localhost','root','','man_power');
$id=$_POST['id'];
$d=$con->query("SELECT * FROM `sites` WHERE `sectorID`=$id");
?>
<select class="form-control" id="dist" name="siteID">
	<option>Select Site Name </option>
	<?php while ($ds=$d->fetch_assoc()) {?>
	<option value="<?php echo $ds['id'] ?>"><?php echo $ds['site_name'] ?></option>
	<?php } ?>
</select>

