<?php
require_once("../header.php");
require_once("../sidebar.php");
require_once("../db_config.php");
$id=$_GET['id'];
$ss=$conn->query("SELECT * FROM `module` WHERE id=$id");
$st=$ss->fetch_assoc();


if(isset($_POST['name'])){
  $rs=$_POST['name'];
  

$conn->query("UPDATE `module` SET `name` = '$rs' WHERE `module`.`id` = $id;");?>

<script>
window.location.href="modules.php";
</script>
<?php
}

?> 
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update month</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Month</li>
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
                <h3 class="card-title">Salary month</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <form action="" method="post">
                    <input type="text" name="name" class="form-control"value="<?php echo $st['name']?>" placeholder="enter module name">
                                
                      <br>
                                  
                    <input type="Submit" value="Submit" class="btn btn-success"><br>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
</section>

    <?php require("../footer.php"); ?>