
<?php
$page = "Dashboard";
require_once("../db_config.php");
require_once("../header.php");
require_once("../sidebar.php");
$id=$_GET['id'];
$edit=$conn->query("SELECT * FROM month WHERE id=$id");
$update=$edit->fetch_assoc();


if(isset($_POST['status'])){
$month_name=$_POST['month_name'];
$status=$_POST['status'];
$conn->query("UPDATE month SET `month_name`='$month_name',`status`='$status' WHERE id=$id");


    
 ?>

    <script>
         window.location.assign("month.php");
   </script>

<?php } ?>


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
                                <input type="text" name="month_name" class="form-control" value="<?php echo $update['month_name'] ?>">
                            </td>
                        
                            <th>Status</th>
                     <td>
                    <input type="radio" name="status" value="active"<?php if($update['status']=='active'){ echo "checked"; } ?>><span>Active</span> |
                    <input type="radio" name="status" value="inactive"<?php if($update['status']=='Inactive'){ echo "checked"; } ?>><span>Inactive</span>
                    </td>
                    </tr>
                    <tr>
                    <td colspan="8">
                            <input type="submit" name="submit" value="update" class="btn btn-block btn-success">
                    </td>
                    </tr>

                </table>
            </form>

  </table>
           


        </div>
    </div>
</div>
</div>
</div> 
</section>

<?php require("../footer.php"); ?>