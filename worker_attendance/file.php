<?php
$conn = new mysqli("localhost","root","","man_power");

if(isset($_POST["submit"])){
	// $filename=$_FILES['file']['name'];
	// echo $filename;

	if($_FILES['file']['name']){
		$filename = explode('.',$_FILES['file']['name']);
		 // print_r($filename);
		if($filename[1] == 'csv'){
			$handle = fopen($_FILES['file']['name'], "r");
			while($data = fgetcsv($handle)){
				$wrokerID = $data[0];
				$status = $data[1];
				$date = $data[2];
				$month =$data[3];
				$time = $data[4];
				$sql = $conn->query("INSERT INTO `worker_attendance` ( `wrokerID`, `status`, `date`, `monthID`, `over_time`) VALUES ('$wrokerID', '$status', '$date','$month', '$time')");
				// echo "<pre>";
				//  print_r($data);
			}
			// fclose($handle);
		}
	}
}

?>
<script>
window.location.href="worker_attendence.php";
</script> -->

