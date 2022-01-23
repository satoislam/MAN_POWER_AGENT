
<?php
$page = "worker_attendence";
require_once("../header.php");
require_once("../sidebar.php");
require_once("../db_config.php");

$dt=$conn->query("SELECT * FROM `month`");

$attend_report=$conn->query("SELECT * FROM `worker`");
?>
<section class="content">
      <div class="container-fluid form-control ">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
           <h3>Search Monthly Attendance Report</h3>
              <form action="Mon_atten_report.php" method="post" class=" text-center">
                <label>Employee empID *</label>  
                <select name='emp_id'>
                  <?php
                while($d_employee=$attend_report->fetch_assoc()){
                  //var_dump($d_employee); ?>
                <option value="<?php echo $d_employee['id'] ?>"><?php echo $d_employee['name'] ?></option><br>
              <?php } ?>
              </select>
               <label class="col-sm-3 col-form-label">Month id</label>
              <select name="monthID"  class="form-control">
                        <option value="">Select month Name</option>

                        <?php while($m=$dt->fetch_assoc()) { ?>
                        <option value="<?php echo $m['id'] ?>"><?php echo $m['month_name']; ?></option>
                      <?php } ?>
                      </select>
            <tr/>
               
              <label>Years *</label>  
                <select name='years'>
                  <?php
                    for ($i=date('Y'); $i >1970 ; $i--) { 
                      // code...
                    
                  ?>
                <option value="<?php echo $i?>"> <?php echo $i?></option><br>
                <?php } ?>
              </select><br>
             <!--  <a href=""> -->
              <input type="submit" value="Details" class="btn btn-success btn-block form-control">
           <!--  </a> -->
                       
              </form>
               
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>



<?php require("../footer.php"); ?>