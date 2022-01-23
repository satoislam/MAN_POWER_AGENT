<?php
$page = "Users role";
require_once("../header.php");
@session_start();
if (!isset($_SESSION['name'])) {
    header("location: $serverName/index.php");
}
require_once("../sidebar.php");
require_once("../db_config.php");
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-users text-navy"></i> User Role</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="./">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">User Role</a></li>
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

                    <!-- /.card-header -->
                    <div class="card-header ">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="mb-0 text-center">Set User Role</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <form autocomplete="off" method="POST">

                            <div class="form-group">
                                <h5 class="mb-3 text-bold">Select User: </h5>
                                <select class="form-control" id="user_list" name="userSelect">
                                    <option value="">Select User</option>
                                    <?php
           $adminTable = $conn->query("SELECT * FROM `admin`");
           while ($admin_row = $adminTable->fetch_assoc()) { ?>
                                    <option
                                        value="<?= $admin_row['id']; ?>">
                                        <?= $admin_row['name']; ?>
                                    </option>
                                    <?php
           }
        ?>
                                </select>

                            </div>
                            <div class="form-group">
                                <h5 class="mb-3 text-bold"> Add Permission for user:</h5>
                                <input type="checkbox" class="mb-3" id="allRole"> Select All* <br>
                                <ul class="user-role-list">
                                    <li class="user_role_flex d-flex ">
                                        <div class="list_module">
                                            <label> Sites</label>
                                        </div>
                                        <div class="permission_module ">
                                            <label class="switch mr-5">
                                                <span class="text">Edit</span>
                                                <input type="checkbox" name="sites_edit" class="all_module">
                                                <span class=" slider round"></span>
                                            </label>

                                            <label class="switch ml-5">
                                                <span class="text mr-2">Delete</span>
                                                <input type="checkbox" name="sites_delete" class="all_module">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="user_role_flex d-flex ">
                                        <div class="list_module">
                                            <label> Sectors</label>
                                        </div>
                                        <div class="permission_module ">
                                            <label class="switch mr-5">
                                                <span class="text">Edit</span>
                                                <input type="checkbox" name="sectors_edit" class="all_module">
                                                <span class=" slider round"></span>
                                            </label>

                                            <label class="switch ml-5">
                                                <span class="text mr-2">Delete</span>
                                                <input type="checkbox" name="sectors_delete" class="all_module">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="user_role_flex d-flex ">
                                        <div class="list_module">
                                            <label> Add Worker</label>
                                        </div>
                                        <div class="permission_module ">
                                            <label class="switch mr-5">
                                                <span class="text">Edit</span>
                                                <input type="checkbox" name="add_worker_edit" class="all_module">
                                                <span class=" slider round"></span>
                                            </label>

                                            <label class="switch ml-5">
                                                <span class="text mr-2">Delete</span>
                                                <input type="checkbox" name="add_worker_delete" class="all_module">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="user_role_flex d-flex ">
                                        <div class="list_module">
                                            <label> Worker Assign</label>
                                        </div>
                                        <div class="permission_module ">
                                            <label class="switch mr-5">
                                                <span class="text">Edit</span>
                                                <input type="checkbox" name="worker_assign_edit" class="all_module">
                                                <span class=" slider round"></span>
                                            </label>

                                            <label class="switch ml-5">
                                                <span class="text mr-2">Delete</span>
                                                <input type="checkbox" name="worker_assign_delete" class="all_module">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="user_role_flex d-flex ">
                                        <div class="list_module">
                                            <label> Advance</label>
                                        </div>
                                        <div class="permission_module ">
                                            <label class="switch mr-5">
                                                <span class="text">Edit</span>
                                                <input type="checkbox" name="advance_edit" class="all_module">
                                                <span class=" slider round"></span>
                                            </label>

                                            <label class="switch ml-5">
                                                <span class="text mr-2">Delete</span>
                                                <input type="checkbox" name="advance_delete" class="all_module">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="user_role_flex d-flex ">
                                        <div class="list_module">
                                            <label> Payments</label>
                                        </div>
                                        <div class="permission_module ">
                                            <label class="switch mr-5">
                                                <span class="text">Edit</span>
                                                <input type="checkbox" name="payments_edit" class="all_module">
                                                <span class=" slider round"></span>
                                            </label>

                                            <label class="switch ml-5">
                                                <span class="text mr-2">Delete</span>
                                                <input type="checkbox" name="payments_delete" class="all_module">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="user_role_flex d-flex ">
                                        <div class="list_module">
                                            <label> Month</label>
                                        </div>
                                        <div class="permission_module ">
                                            <label class="switch mr-5">
                                                <span class="text">Edit</span>
                                                <input type="checkbox" name="month_edit" class="all_module">
                                                <span class=" slider round"></span>
                                            </label>

                                            <label class="switch ml-5">
                                                <span class="text mr-2">Delete</span>
                                                <input type="checkbox" name="month_delete" class="all_module">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="user_role_flex d-flex ">
                                        <div class="list_module">
                                            <label> Modules</label>
                                        </div>
                                        <div class="permission_module ">
                                            <label class="switch mr-5">
                                                <span class="text">Edit</span>
                                                <input type="checkbox" name="modules_edit" class="all_module">
                                                <span class=" slider round"></span>
                                            </label>

                                            <label class="switch ml-5">
                                                <span class="text mr-2">Delete</span>
                                                <input type="checkbox" name="modules_delete" class="all_module">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="user_role_flex d-flex ">
                                        <div class="list_module">
                                            <label> User Lists</label>
                                        </div>
                                        <div class="permission_module ">
                                            <label class="switch mr-5">
                                                <span class="text">Edit</span>
                                                <input type="checkbox" name="user_lists_edit" class="all_module">
                                                <span class=" slider round"></span>
                                            </label>

                                            <label class="switch ml-5">
                                                <span class="text mr-2">Delete</span>
                                                <input type="checkbox" name="user_lists_delete" class="all_module">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="user_role_flex d-flex ">
                                        <div class="list_module">
                                            <label> Worker Attendance</label>
                                        </div>
                                        <div class="permission_module ">
                                            <label class="switch mr-5">
                                                <span class="text">Edit</span>
                                                <input type="checkbox" name="worker_attendance_edit" class="all_module">
                                                <span class=" slider round"></span>
                                            </label>

                                            <label class="switch ml-5">
                                                <span class="text mr-2">Delete</span>
                                                <input type="checkbox" name="worker_attendance_delete"
                                                    class="all_module">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="user_role_flex d-flex ">
                                        <div class="list_module">
                                            <label>Invoice</label>
                                        </div>
                                        <div class="permission_module ">
                                            <label class="switch mr-5">
                                                <span class="text">Edit</span>
                                                <input type="checkbox" name="invoice_edit" class="all_module">
                                                <span class=" slider round"></span>
                                            </label>

                                            <label class="switch ml-5">
                                                <span class="text mr-2">Delete</span>
                                                <input type="checkbox" name="invoice_delete" class="all_module">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                            <button type="submit" name="submit" class="btn btn-info btn-block">Save</button>

                        </form>

                        <!-- insert -->
                        <?php
                              if (isset($_POST['submit'])) {
                                  $userSelect = $_POST['userSelect'];
                                  $sites_edit = (isset($_POST["sites_edit"])) ? 1 : 0 ;
                                  $sites_delete = (isset($_POST['sites_delete'])) ? 1 : 0 ;
                                  $sectors_edit = (isset($_POST["sectors_edit"])) ? 1 : 0 ;
                                  $sectors_delete = (isset($_POST["sectors_delete"])) ?1 : 0 ;
                                  $add_worker_edit = (isset($_POST["add_worker_edit"])) ? 1 : 0 ;
                                  $add_worker_delete = (isset($_POST["add_worker_delete"])) ?1 : 0 ;
                                  $worker_assign_edit = (isset($_POST["worker_assign_edit"])) ? 1 : 0 ;
                                  $worker_assign_delete = (isset($_POST["worker_assign_delete"])) ?1 : 0 ;
                                  $advance_edit = (isset($_POST["advance_edit"])) ? 1 : 0 ;
                                  $advance_delete = (isset($_POST["advance_delete"])) ?1 : 0 ;
                                  $payments_edit = (isset($_POST["payments_edit"])) ? 1 : 0 ;
                                  $payments_delete = (isset($_POST["payments_delete"])) ?1 : 0 ;
                                  $month_edit = (isset($_POST["month_edit"])) ? 1 : 0 ;
                                  $month_delete = (isset($_POST["month_delete"])) ?1 : 0 ;
                                  $modules_edit = (isset($_POST["modules_edit"])) ? 1 : 0 ;
                                  $modules_delete = (isset($_POST["modules_delete"])) ?1 : 0 ;
                                  $user_lists_edit = (isset($_POST["user_lists_edit"])) ? 1 : 0 ;
                                  $user_lists_delete = (isset($_POST["user_lists_delete"])) ?1 : 0 ;
                                  $worker_attendance_edit = (isset($_POST["worker_attendance_edit"])) ?1 : 0 ;
                                  $worker_attendance_delete = (isset($_POST["worker_attendance_delete"])) ?1 : 0 ;
                                  $invoice_edit = (isset($_POST["invoice_edit"])) ?1 : 0 ;
                                  $invoice_delete = (isset($_POST["invoice_delete"])) ?1 : 0 ;
                                  //for edit
            
                                  $moduleInsert = $conn->query("INSERT INTO `user_role` (adminID, sites_edit,	 sites_delete,sectors_edit,sectors_delete,add_worker_edit,add_worker_delete,worker_assign_edit,worker_assign_delete,advance_edit,advance_delete,payments_edit,payments_delete,month_edit,month_delete,modules_edit,modules_delete,user_lists_edit,user_lists_delete,worker_attendance_edit,worker_attendance_delete, invoice_edit,invoice_delete) VALUES ('$userSelect', '$sites_edit','$sites_delete','$sectors_edit','$sectors_delete','$add_worker_edit','$add_worker_delete','$worker_assign_edit','$worker_assign_delete','$advance_edit','$advance_delete','$payments_edit','$payments_delete','$month_edit','$month_delete','$modules_edit','$modules_delete','$user_lists_edit','$user_lists_delete', '$worker_attendance_edit', '$$worker_attendance_delete', '$$invoice_edit', '$invoice_delete')");
                              }
                        ?>


                        <hr>
                        <div class="roleTableShow">
                            <h3 class="text-center mt-4 mb-4">User Role Module</h3>
                            <table id="myTable" class="table table-responsive  table-striped table-hover"
                                style="text-align: center;">
                                <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>User Name</th>
                                        <th>Edit Site</th>
                                        <th>Delete Site</th>
                                        <th>Edit Sectors</th>
                                        <th>Delete Sectors</th>
                                        <th>Edit Worker</th>
                                        <th>Delete Worker</th>
                                        <th>Edit Worker Assign</th>
                                        <th>Delete Worker Assign</th>
                                        <th>Edit Advance</th>
                                        <th>Delete Advance</th>
                                        <th>Edit Payments</th>
                                        <th>Delete Payments</th>
                                        <th>Edit Month</th>
                                        <th>Delete Month</th>
                                        <th>Edit Modules</th>
                                        <th>Delete Modules</th>
                                        <th>Edit Users</th>
                                        <th>Delete Users</th>
                                        <th>Edit Worker Attendance</th>
                                        <th>Delete Worker Attendance</th>
                                        <th>Edit Invoice</th>
                                        <th>Delete Invoice</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                       $userRoleTable= $conn->query("SELECT * FROM `user_role` JOIN admin ON admin.id= user_role.adminID ");
                                       $i=0;
                                       while ($roleRow = $userRoleTable->fetch_assoc()) {
                                            ?>

                                    <tr>
                                        <td><?= ++$i; ?>
                                        </td>
                                        <td><?= $roleRow['name']; ?>
                                        </td>
                                        <td>
                                            <?php 
                                               if($roleRow['sites_edit'] == 1){ ?>
                                                  <i class="fas fa-check-circle" style="color:green;font-size:19px"></i>
                                            <?php
                                               }
                                               else{ ?>
                                                  <i class="fas fa-times-circle" style="color:green;font-size:19px"></i>
                                            <?php
                                               }
                                            ?>
                                        </td>
                                        <td>
                                        <?php 
                                               if($roleRow['sites_delete'] == 1){ ?>
                                                  <i class="fas fa-check-circle" style="color:green;font-size:19px"></i>
                                            <?php
                                               }
                                               else{ ?>
                                                  <i class="fas fa-times-circle" style="color:red;font-size:19px"></i>
                                            <?php
                                               }
                                            ?>
                                        </td>
                                        <td>
                                          <?php 
                                               if($roleRow['sectors_edit'] == 1){ ?>
                                                  <i class="fas fa-check-circle" style="color:green;font-size:19px"></i>
                                            <?php
                                               }
                                               else{ ?>
                                                  <i class="fas fa-times-circle" style="color:red;font-size:19px"></i>
                                            <?php
                                               }
                                            ?>
                                        </td>
                                        <td>
                                        <?php 
                                               if($roleRow['sectors_delete'] == 1){ ?>
                                                  <i class="fas fa-check-circle" style="color:green;font-size:19px"></i>
                                            <?php
                                               }
                                               else{ ?>
                                                  <i class="fas fa-times-circle" style="color:red;font-size:19px"></i>
                                            <?php
                                               }
                                            ?>
                                        </td>
                                        <td>
                                          <?php 
                                               if($roleRow['add_worker_edit'] == 1){ ?>
                                                  <i class="fas fa-check-circle" style="color:green;font-size:19px"></i>
                                            <?php
                                               }
                                               else{ ?>
                                                  <i class="fas fa-times-circle" style="color:red;font-size:19px"></i>
                                            <?php
                                               }
                                            ?>
                                        </td>
                                        <td>
                                        <?php 
                                               if($roleRow['add_worker_delete'] == 1){ ?>
                                                  <i class="fas fa-check-circle" style="color:green;font-size:19px"></i>
                                            <?php
                                               }
                                               else{ ?>
                                                  <i class="fas fa-times-circle" style="color:red;font-size:19px"></i>
                                            <?php
                                               }
                                            ?>
                                        </td>
                                        <td>
                                        <?php 
                                               if($roleRow['worker_assign_edit'] == 1){ ?>
                                                  <i class="fas fa-check-circle" style="color:green;font-size:19px"></i>
                                            <?php
                                               }
                                               else{ ?>
                                                  <i class="fas fa-times-circle" style="color:red;font-size:19px"></i>
                                            <?php
                                               }
                                            ?>
                                        </td>
                                        <td>
                                        <?php 
                                               if($roleRow['worker_assign_delete'] == 1){ ?>
                                                  <i class="fas fa-check-circle" style="color:green;font-size:19px"></i>
                                            <?php
                                               }
                                               else{ ?>
                                                  <i class="fas fa-times-circle" style="color:red;font-size:19px"></i>
                                            <?php
                                               }
                                            ?>
                                        </td>
                                        <td>
                                        <?php 
                                               if($roleRow['advance_edit'] == 1){ ?>
                                                  <i class="fas fa-check-circle" style="color:green;font-size:19px"></i>
                                            <?php
                                               }
                                               else{ ?>
                                                  <i class="fas fa-times-circle" style="color:red;font-size:19px"></i>
                                            <?php
                                               }
                                            ?>
                                        </td>
                                        <td>
                                        <?php 
                                               if($roleRow['advance_delete'] == 1){ ?>
                                                  <i class="fas fa-check-circle" style="color:green;font-size:19px"></i>
                                            <?php
                                               }
                                               else{ ?>
                                                  <i class="fas fa-times-circle" style="color:red;font-size:19px"></i>
                                            <?php
                                               }
                                            ?>
                                        </td>
                                        <td>
                                        <?php 
                                               if($roleRow['payments_edit'] == 1){ ?>
                                                  <i class="fas fa-check-circle" style="color:green;font-size:19px"></i>
                                            <?php
                                               }
                                               else{ ?>
                                                  <i class="fas fa-times-circle" style="color:red;font-size:19px"></i>
                                            <?php
                                               }
                                            ?>
                                        </td>
                                        <td>
                                        <?php 
                                               if($roleRow['payments_delete'] == 1){ ?>
                                                  <i class="fas fa-check-circle" style="color:green;font-size:19px"></i>
                                            <?php
                                               }
                                               else{ ?>
                                                  <i class="fas fa-times-circle" style="color:red;font-size:19px"></i>
                                            <?php
                                               }
                                            ?>
                                        </td>
                                        <td>
                                        <?php 
                                               if($roleRow['month_edit'] == 1){ ?>
                                                  <i class="fas fa-check-circle" style="color:green;font-size:19px"></i>
                                            <?php
                                               }
                                               else{ ?>
                                                  <i class="fas fa-times-circle" style="color:red;font-size:19px"></i>
                                            <?php
                                               }
                                            ?>
                                        </td>
                                        <td>
                                        <?php 
                                               if($roleRow['month_delete'] == 1){ ?>
                                                  <i class="fas fa-check-circle" style="color:green;font-size:19px"></i>
                                            <?php
                                               }
                                               else{ ?>
                                                  <i class="fas fa-times-circle" style="color:red;font-size:19px"></i>
                                            <?php
                                               }
                                            ?>
                                        </td>
                                        <td>
                                        <?php 
                                               if($roleRow['modules_edit'] == 1){ ?>
                                                  <i class="fas fa-check-circle" style="color:green;font-size:19px"></i>
                                            <?php
                                               }
                                               else{ ?>
                                                  <i class="fas fa-times-circle" style="color:red;font-size:19px"></i>
                                            <?php
                                               }
                                            ?>
                                        </td>
                                        <td>
                                        <?php 
                                               if($roleRow['modules_delete'] == 1){ ?>
                                                  <i class="fas fa-check-circle" style="color:green;font-size:19px"></i>
                                            <?php
                                               }
                                               else{ ?>
                                                  <i class="fas fa-times-circle" style="color:red;font-size:19px"></i>
                                            <?php
                                               }
                                            ?>
                                        </td>
                                        <td>
                                        <?php 
                                               if($roleRow['user_lists_edit'] == 1){ ?>
                                                  <i class="fas fa-check-circle" style="color:green;font-size:19px"></i>
                                            <?php
                                               }
                                               else{ ?>
                                                  <i class="fas fa-times-circle" style="color:red;font-size:19px"></i>
                                            <?php
                                               }
                                            ?>
                                        </td>
                                        <td>
                                        <?php 
                                               if($roleRow['user_lists_delete'] == 1){ ?>
                                                  <i class="fas fa-check-circle" style="color:green;font-size:19px"></i>
                                            <?php
                                               }
                                               else{ ?>
                                                  <i class="fas fa-times-circle" style="color:red;font-size:19px"></i>
                                            <?php
                                               }
                                            ?>
                                        </td>
                                        <td>
                                        <?php 
                                               if($roleRow['worker_attendance_edit'] == 1){ ?>
                                                  <i class="fas fa-check-circle" style="color:green;font-size:19px"></i>
                                            <?php
                                               }
                                               else{ ?>
                                                  <i class="fas fa-times-circle" style="color:red;font-size:19px"></i>
                                            <?php
                                               }
                                            ?>
                                        </td>
                                        <td>
                                        <?php 
                                               if($roleRow['worker_attendance_delete'] == 1){ ?>
                                                  <i class="fas fa-check-circle" style="color:green;font-size:19px"></i>
                                            <?php
                                               }
                                               else{ ?>
                                                  <i class="fas fa-times-circle" style="color:red;font-size:19px"></i>
                                            <?php
                                               }
                                            ?>
                                        </td>
                                        <td>
                                        <?php 
                                               if($roleRow['invoice_edit'] == 1){ ?>
                                                  <i class="fas fa-check-circle" style="color:green;font-size:19px"></i>
                                            <?php
                                               }
                                               else{ ?>
                                                  <i class="fas fa-times-circle" style="color:red;font-size:19px"></i>
                                            <?php
                                               }
                                            ?>
                                        </td>
                                        <td>
                                        <?php 
                                               if($roleRow['invoice_delete'] == 1){ ?>
                                                  <i class="fas fa-check-circle" style="color:green;font-size:19px"></i>
                                            <?php
                                               }
                                               else{ ?>
                                                  <i class="fas fa-times-circle" style="color:red;font-size:19px"></i>
                                            <?php
                                               }
                                            ?>
                                        </td>
                                    </tr>

                                    <?php
                                       }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>




<?php require_once("../footer.php");  ?>

<script>
    $('#myTable').dataTable({
        pageLength: 5,
        lengthMenu: [
            [5, 10, 20, -1],
            [5, 10, 20, 'Todos']
        ]
    })

    $('#allRole').on('click', function() {
        $('.all_module').not(this).prop('checked', this.checked);
    })
</script>