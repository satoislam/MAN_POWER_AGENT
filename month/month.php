<?php
@session_start();
$id = $_SESSION['id'];
$page = "Dashboard";
require_once("../db_config.php");
require_once("../header.php");
require_once("../sidebar.php");

$hh=$conn->query("SELECT * FROM month");


if (isset($_POST['status'])) {
    $month_name=$_POST['month_name'];
    $status=$_POST['status'];
    $yy=$conn->query("INSERT INTO `month`(`month_name`, `status`) VALUES ('$month_name','$status')"); ?>

<script>
    window.location.assign("month.php");
</script>

<?php
} ?>


<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>MONTH</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">MONTH</a></li>
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
                    <div class="card-header">
                        <h2 class="card-title text-center">
                            MONTH
                        </h2>
                    </div>

                    <div class="card-body">
                        <form action="" method="post">
                            <table class="table table-bordered  table-striped table-hover">
                                <tr>
                                    <th>Month Name</th>
                                    <td>
                                       <input type="text" name="month_name" class="form-control">
                                    </td>

                                    <th>Status</th>
                                    <td>
                                        <input type="radio" name="status" value="active" checked><span>Active</span> |
                                        <input type="radio" name="status" value="inactive"><span>Inactive</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="8">
                                        <input type="submit" name="submit" value="Save"
                                            class="btn btn-block btn-success">
                                    </td>
                                </tr>
                            </table>
                        </form>


                        <table class=" table table-borderless table-hover">
                            <tr>
                                <th>Serial No</th>
                                <th>Month Name</th>
                                <th>Status</th>
                               
                                <?php 
                     $userRoleTable= $conn->query("SELECT * FROM `user_role` JOIN admin ON admin.id= user_role.adminID WHERE `adminID`= $id");
                       
                     while ($roleRow = $userRoleTable->fetch_assoc()) {
                       if( ($roleRow['month_edit'] || $roleRow['month_delete']) != '0'){ ?>
                        <th scope="col">Action</th>

                    <?php
                       }
                      }
                  ?>
                            </tr>
                            <?php $i=0; while ($cc=$hh->fetch_assoc()) {
        ?>
                            <tr>
                                <td> <?php echo ++$i; ?>
                                </td>
                                <td> <?php echo $cc['month_name']?>
                                </td>
                                <td> <?php echo $cc['status']?>
                                </td>

                                <td>
                                    
                                   


                                        <?php 
                        $userRoleTable= $conn->query("SELECT * FROM `user_role` JOIN admin ON admin.id= user_role.adminID WHERE `adminID`= $id");
                       
                        while ($roleRow = $userRoleTable->fetch_assoc()) {
                          
                            
if ($roleRow['month_edit']== '1') {  ?>
  <a href="month_edit.php?id=<?php echo $cc['id'] ?>"
                                        class="btn btn-sm btn-success">Edit</a>
<?php 
}

if($roleRow['month_delete']== '1'){ ?>
   <a href="month_delete.php?id=<?php echo $cc['id'] ?>"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</a>

<?php 
}
                         }
                      

                    
                    ?>
                                </td>
                            </tr>

                            <?php
    } ?>

                        </table>



                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<?php require("../footer.php"); ?>

<script>
    $(document).ready(function() {


    });
</script>