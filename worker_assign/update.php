<?php
$page = "Dashboard";
require_once("../db_config.php");

$id=$_GET['id'];
           $edit=$conn->query("SELECT worker_assign.id,worker_assign.per_day_salary,worker_assign.ot_rate,worker_assign.type,worker_assign.status,sites.id as siteID,sites.site_name,sites.sectorID,worker.name,month.month_name,worker_assign.workerID,worker_assign.monthID FROM worker_assign JOIN sites ON sites.id=worker_assign.siteID JOIN worker ON worker.id=worker_assign.workerID JOIN month ON month.id=worker_assign.monthID  WHERE worker_assign.id=$id");
           $update=$edit->fetch_assoc();
          
if (isset($_POST['siteID'])) {
    $siteID=$_POST['siteID'];
    $workerID=$_POST['workerID'];
    $per_day_salary=$_POST['per_day_salary'];
    $ot_rate=$_POST['ot_rate'];
    $type=$_POST['type'];
    $monthID=$_POST['monthID'];
    $status=$_POST['status'];

    $conn->query("UPDATE `worker_assign` SET `siteID` = '$siteID', `workerID` = '$workerID', `per_day_salary` = '$per_day_salary', `ot_rate` = '$ot_rate', `type` = '$type', `monthID` = '$monthID', `status` = '$status' WHERE `worker_assign`.`id` = $id;"); 
     
    ?>

    <script>
       window.location.assign('index.php')
    </script> 


<?php


} ?>

<?php
require_once("../header.php");
require_once("../sidebar.php");

?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><i class="fas fa-tasks fa-sm text-navy"></i> Work Assign</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home/ </a></li>
          <li class="breadcrumb-item"><a href="#">Update Work Assign</a></li>
        </ol>
      </div>
    </div>
  </div> 
</section>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header  text-center">
            <h2 >
                Update Work Assign
            </h2>


          </div>

          <div class="card-body">
              <form action="" method="post">
                  <table class="table table-bordered table-striped table-hover ">
                    <tr>
                    <th>Sectors Name</th>
                      <td colspan="6">
                        
                          <select id="div" class="form-control" >
                 <option>Select Sectors Name </option>
                 <?php
                 $sectors= $conn->query("SELECT * FROM `sectors`");
                 while ($ectors=$sectors->fetch_assoc()) { ?> 

   <option value="<?php echo $ectors['id']; ?>" <?php if ($ectors['id']==$update['sectorID']) {
                     echo "selected";
                    }  ?> > <?php echo $ectors["sector_name"]; ?> </option>
                 <?php
               }
               ?>                     
              </select>

               <th id="dis"> 
               <select class="form-control" name="siteID" readonly>
                <option value="<?php echo $update["siteID"] ?>"><?php echo $update['site_name']?> </option>
               </select>
              </tr> 
              <tr>
                      <th>Worker Name</th>
                      <td colspan="4">
                      <select class="form-control" name="workerID">
                 <option value="" >Select Worker Name </option>
                 <?php
                 $emp_table = $conn->query("SELECT * FROM `worker` ");

                 while ($emp_data = $emp_table->fetch_assoc()) {?>
                 <option value="<?php echo $emp_data['id']; ?>" <?php if ($emp_data['id']==$update['workerID']) {
                     echo "selected";
                    }  ?>><?php echo $emp_data['name']; ?></option>
                  <?php
                }
                ?> </td>                    
              </select>
              <th>Per Day Salary</th>
                          <td colspan="4">
                              <input type="text" name="per_day_salary" class="form-control" value="<?php echo $update['per_day_salary'] ?> ">
                          </td>
                          </tr>
                          <tr>
                          <th>Over Time Rate</th>
                          <td colspan="4">
                              <input type="text" name="ot_rate" class="form-control" value="<?php echo $update['ot_rate'] ?>">
                          </td>
                          
                          <th>Type</th>
                          <td colspan="4">
                      <select class="form-control" name="type">
                     
                      <option value="resident"<?php if ($update['status']==='resident') {
                    echo "checked";
                }?>><span>resident</span></option>
                       <option value="non_resident"<?php if ($update['status']==='non_resident') {
                    echo "checked";
                }?>><span>non_resident</span></option>
                      </td>                    
              </select>
            </tr>
            <tr>
               <th>Month Name</th>
                 <td colspan="4">
                  <select class="form-control" name="monthID">
                 <option value="" >Select month Name </option>
                 <?php
                 $month_table = $conn->query("SELECT * FROM `month` ");

                 while ($month_show = $month_table->fetch_assoc()) { ?>


                  <option value="<?php echo $month_show['id']; ?>" <?php if ($month_show['id']==$update['monthID']) {
                     echo "selected";
                     }  ?> > <?php echo $month_show['month_name']; ?> </option>
                  <?php
                }
                ?> </td>                    
              </select>

               


              <th>Status</th>
                            <td colspan="4">
                      <select class="form-control" name="status">
                       <!-- <option value="0">Select type Name </option> -->
                       <option value="active"<?php if ($update['status']==='active') {
                    echo "checked";
                }?>><span>Active</span></option>
                       <option value="inactive"<?php if ($update['status']==='inactive') {
                    echo "checked";
                }?>><span>inactive</span></option>
               
                 </td>                    
              </select>
              </tr class="text-center">
                          </td>
                          <td colspan="10">
                              <input type="submit" name="submit" value="Update" class="btn btn-block btn-success">
                          </td>
                      </tr>
                  </table>
              </form>


          </div>
        </div>
       
      </div>
    </div>
  </div>
</section>

<?php require("../footer.php"); ?> 

<script>
$(document).ready(function(){
	$('#div').change(function(){
		var divID=$(this).val()
		$.ajax({
			url:"district.php",
			type:"post",
			data:{"id":divID},
			success:function(data){
				$('#dis').html(data)
			}
		})
	})
})

  </script>