

<?php
$page = "worker_attendence";
require_once("../header.php");
require_once("../sidebar.php");
require_once("../db_config.php");

$id=$_GET['ff'];
$work=$conn->query("SELECT * FROM `worker_attendance` where wrokerID=$id");
$haw=$work->fetch_assoc();




$dpt=$conn->query("SELECT * FROM `worker`");
$dt=$conn->query("SELECT * FROM `month`");



if(isset($_POST['status'])){
  $wrokerID=$_POST['wrokerID'];
  $status=$_POST['status'];
  $date=$_POST['date'];
  $month=$_POST['monthID'];
  $time=$_POST['over_time'];
   

 $bb=$conn->query("UPDATE `worker_attendance` SET `wrokerID`=$wrokerID,`status`=$status,`date`=$date,`monthID`=$month,`over_time`=$time WHERE  'wrokerID =$id)");
 //  if ($bb) {
 //   echo "inserted";
 // }
 // else{
 //  echo "not inserted";
 // }

 ?>
  <script>
window.location.href="worker_attendence.php";
</script> -->

<?php 
}


?>

                       

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Dashboard</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
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
              <div class="card-header">
                <!-- <h3 class="card-title">Bordered Table</h3> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <h1 class="mt-3" style="text-align: center; color: green"> Updated an Worker Attendance</h1>
            

</td>
<tr/>

    
               <form action="" method="post">
                <table class="table table-bordered"style="hover:background-color:red;">
                  

             <tr :hover {background-color:red;}></tr>
             <tr>
                    <label class="col-sm-3 col-form-label">Worker id</label>
              <select name="wrokerID"  class="form-control">
                        <option value="">Select Worker Name</option>

                        <?php while($d=$dpt->fetch_assoc()) { ?>
                        <option value="<?php echo $d['id'] ?>"
                         ><?php echo $d['name']; ?>
                         
                        </option>
                      <?php } ?>
                      </select>
            <tr/>
                      <th>Status<th/>
                <td>
          <input type="radio"  name="status" value= "present"><span>present </span>
                 <input type="radio"  name="status" value= "absent"><span> absent</span>
                </td>
              <div class="col-sm-6">
                   <th>Date</th>
              <td><input type="date" name="date" class="from-control" value="<?php echo $haw['date']?>"></td>
                  <th>Over_time</th>
              <td><input type="text" name="over_time" class="from-control" value="<?php echo $haw['over_time']?>"></td>
               <tr>
                    <label class="col-sm-3 col-form-label">Month id</label>
              <select name="monthID"  class="form-control">
                        <option value="">Select month Name</option>

                        <?php while($m=$dt->fetch_assoc()) { ?>
                        <option value="<?php echo $m['id'] ?>"
                          


                          ><?php echo $m['month_name']; ?></option>
                      <?php } ?>
                      </select>
            <tr/>
                  <tr>
                  <td colspan="6">
        <input type="submit"  class="btn btn-block btn-primary" value="Save">
      </td>
      </tr>
  

    </table>
          
               </form> 


            


                        

        
                    


                          
                        
                        
                  

          <!-- /.card-header -->
        
            

          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>



<?php require("../footer.php"); ?>