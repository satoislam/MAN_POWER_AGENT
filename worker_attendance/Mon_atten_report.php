 <?php
$page = "worker_attendence";
require_once("../header.php");
require_once("../sidebar.php");
require_once("../db_config.php");

  // require_once("Mon_atten_menu.php");


?>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
            
            
                    <?php
                    $att=$conn->query("SELECT * FROM `worker_attendance` WHERE wrokerID='$name'");
                    $d_employee=$att->fetch_assoc();
                    ?>
  <h3>Monthly attendance report of " <?php echo $d_employee['name'] ?>"</h3> 
            <table class="table table-bordered">
              <tr>
                <th>Sl</th>
                          <th>Name</th>
                          <th>Month Name</th>
                          <th>Status</th>
                          <th>Date</th>
              </tr>
              <?php
              $dcount=cal_days_in_month(CAL_GREGORIAN, 6, 2021);
                  // echo"$dcount";

                  // $dd=$dcount;
              $i=0;
              for ($x = 1; $x <=$dcount; $x++) { 
                  $to_date=$date.'-'.sprintf('%02d', $x);
                  // echo '<pre>';
                  // print_r($to_date);
                  
                  $weekend=false;
                  $h=$conn->query("SELECT * FROM `worker_attendance` WHERE `start_date`<='$to_date' AND `end_date`>='$to_date'");
                  $hl=$h->fetch_assoc();
                  // print_r($hl);
                  // $holiday=$hl->title;
                  $leave=$conn->query("SELECT leave_application.*,leave_type.title FROM `leave_application`JOIN leave_type ON leave_type.typeID=leave_application.typeID WHERE `start_date`<='$to_date' AND `end_date`>='$to_date'");
                  $l=$leave->fetch_assoc();
                  // echo "<pre>";
                  $ll=false;
                  $lll='';
                  if (@$l['title']){
                      $ll=true;
                      $lll=$l['title'];
                  }
                  
                  


                ?>
                <tr>
                  <td><?php  echo ++$i;  ?> </td>  

                  <td><?php echo $date.'-'.$x ;?> </td>

                  
                  <?php
  if(date('l',strtotime($to_date))=='Friday') {
      ?>
  <td class='bg-danger'>

  </td>
  <td class='bg-danger'>

  </td>
  <td class='bg-danger'>
  weekend
  </td>
      <?php
  }else if($h->num_rows>0){
      
      ?>
  <td class='bg-success'>

  </td>
  <td class='bg-success'>

  </td>
  <td class='bg-success'>
  <?php echo $hl['title']; ?>
  </td>
      <?php
  }else if($leave->num_rows>0){

      ?>
  <td class='bg-warning'>

  </td>
  <td class='bg-warning'>

  </td>
  <td class='bg-warning'>
  <?php echo $lll; ?>
  </td>
      
          </td> 
          <td>
            
        
          </td>
              <?php
  }
                  ?>
              </tr>
            <?php } ?> 

            <td colspan="4" class="text-right">Total Present</td>
            <td colspan="4" class="text-right"><?php 
          
            echo number_format($total+$y)?></td>

          </div>
        </table>
      </div>
    </div>
  </div>
  </div>
  </section>

  <?php require("footer.php"); ?>