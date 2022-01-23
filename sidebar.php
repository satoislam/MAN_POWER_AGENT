 <?php
    @session_start();
    $serverName = 'http://'.$_SERVER['SERVER_NAME'].'/man_power_agent';
    
    if (!isset($_SESSION['name'])) {
        header("location: $serverName/index.php");
    }
    require_once("db_config.php");
    
?>
 <!-- Main Sidebar Container -->
 <aside class="main-sidebar bg-success pt-14  elevation-4">
   <!-- Brand Logo -->
   <a href="" class="brand-link">
     <img src="<?= $serverName; ?>/assets/images/AdminLTELogo.png"
       alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
     <span class="brand-text font-weight-light">Man Power Agent</span>
   </a>

   <div class="bb-2"></div>
   <!-- Sidebar -->
   <div class="sidebar">
     <div class="user-panel mt-3  d-flex">

       <div class="info text-white">
         Welcome, <?= $_SESSION['name']; ?>
       </div>
     </div>

     <div class="bb-2"></div>

     <!-- Sidebar Menu -->
     <nav class="mt-2">
       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

       <li class="nav-item">
           <a href="http://localhost/man_power_agent/dashboard.php" class="nav-link">
             <i class="far fa-circle nav-icon"></i>
             <p>Dashboard</p>
           </a>
         </li>


         <?php
         $result = $conn->query("SELECT * FROM `admin`");
           
           while ($row = $result->fetch_assoc()) {
               if ($_SESSION['name'] == $row['name']) {
                   $id = $_SESSION['id'];
                   //  echo $id;
                   if ($row['status'] =='active') {
                       $userRoleTable= $conn->query("SELECT * FROM `user_role` JOIN admin ON admin.id= user_role.adminID WHERE `adminID`= $id");
                       
                       while ($roleRow = $userRoleTable->fetch_assoc()) {
                           ?>


        <?php
           if ($roleRow['sectors_edit'] == '1'  || $roleRow['sectors_delete'] == '1') {
               ?>
         <!--  sectors -->
         <li class="nav-item">
           <a href="http://localhost/man_power_agent/sectors/sectors.php" class="nav-link">
             <i class="far fa-circle nav-icon"></i>
             <p>Sectors</p>
           </a>
         </li>
         <?php
           } 


           if ($roleRow['sites_edit'] == '1'  || $roleRow['sites_delete'] == '1') {
               ?>
         <!--  sites -->
         <li class="nav-item">
           <a href="http://localhost/man_power_agent/sites/sites.php" class="nav-link">
             <i class="far fa-circle nav-icon"></i>
             <p>Sites</p>
           </a>
         </li>
         <?php
           } 

           if ($roleRow['month_edit'] == '1'  || $roleRow['month_delete'] == '1') { ?>

         <!--  Months -->
         <li class="nav-item">
           <a href="http://localhost/man_power_agent/month/month.php" class="nav-link">
             <i class="far fa-circle nav-icon"></i>
             <p>Months</p>
           </a>
         </li>

         <?php } ?>


        <?php  if ($roleRow['add_worker_edit'] == '1'  || $roleRow['add_worker_delete'] == '1') { ?>
         <!--  Worker Add -->
         <li class="nav-item">
           <a href="http://localhost/man_power_agent/add_worker/add_worker.php" class="nav-link">
             <i class="far fa-circle nav-icon"></i>
             <p>Worker Add</p>
           </a>
         </li>
         <?php } ?>

         <?php  if ($roleRow['worker_assign_edit'] == '1'  || $roleRow['worker_assign_delete'] == '1') { ?>
         <!--  Worker Assign -->
         <li class="nav-item">
           <a href="http://localhost/man_power_agent/worker_assign/worker_assign.php" class="nav-link">
             <i class="far fa-circle nav-icon"></i>
             <p>Worker Assign</p>
           </a>
         </li>
         <?php  } ?>

         <?php  if ($roleRow['advance_edit'] == '1'  || $roleRow['advance_delete'] == '1') { ?>         
         <!--  Advance -->
         <li class="nav-item">
           <a href="http://localhost/man_power_agent/advance/advance.php" class="nav-link">
             <i class="far fa-circle nav-icon"></i>
             <p>Advance</p>
           </a>
         </li>
         <?php } ?>
        
         <?php  if ($roleRow['worker_attendance_edit'] == '1'  || $roleRow['worker_attendance_delete'] == '1') { ?>
         <!--  Worker Attendance -->
         <li class="nav-item">
           <a href="http://localhost/man_power_agent/worker_attendance/worker_attendance.php" class="nav-link">
             <i class="far fa-circle nav-icon"></i>
             <p>Worker Attendance</p>
           </a>
         </li>
         <?php } ?>

         <?php  if ($roleRow['invoice_edit'] == '1'  || $roleRow['invoice_delete'] == '1') { ?>
         <!--  Invoice -->
         <li class="nav-item">
           <a href="http://localhost/man_power_agent/invoice/invoice.php" class="nav-link">
             <i class="far fa-circle nav-icon"></i>
             <p>Invoice</p>
           </a>
         </li>
         <?php } ?>

         <?php  if ($roleRow['payments_edit'] == '1'  || $roleRow['payments_delete'] == '1') { ?>
          <!--  Payments -->
          <li class="nav-item">
           <a href="http://localhost/man_power_agent/payments/payments.php" class="nav-link">
             <i class="far fa-circle nav-icon"></i>
             <p>Payments</p>
           </a>
         </li>
         <?php } ?>
         
         <?php  if ($roleRow['modules_edit'] == '1'  || $roleRow['modules_delete'] == '1') { ?>
         <!--  Modules -->
         <li class="nav-item">
           <a href="http://localhost/man_power_agent/modules/modules.php" class="nav-link">
             <i class="far fa-circle nav-icon"></i>
             <p>Modules</p>
           </a>
         </li>
         <?php } ?>

         <?php  if ($roleRow['user_lists_edit'] == '1'  || $roleRow['user_lists_delete'] == '1') { ?>
          <!--  User Lists -->
          <li class="nav-item">
           <a href="http://localhost/man_power_agent/user_lists/user_lists.php" class="nav-link">
             <i class="far fa-circle nav-icon"></i>
             <p>User Lists</p>
           </a>
         </li>
         <?php  } ?>

         <?php
                       }
                   }
                   else {
                       header("location: inactive_user.php");
                   }
               }
           }

          

            
         ?>




       </ul>
     </nav>
     <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
 </aside>