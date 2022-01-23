<?php
$page = "sector";
require_once("../header.php");
require_once("../sidebar.php");
require_once("../db_config.php");
 ?>


<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Sector</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home/</a></li>
          <li class="breadcrumb-item"><a href="#">Sectors</a></li>
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
          <div class="card-header text-center">
            <h3>Add Sector</h3>

          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form action="" method="post">

              <label for="sector_name">Sector Name:</label>
              <input type="text" name="sector_name" class="form-control" placeholder="Enter sector name"><br>

              <td colspan="6">
                <input type="Submit" value="Submit" class="btn btn-outline-primary  btn-block">
              </td>

              <br>
            </form>

            <?php
          $sector_data = $conn->query("SELECT * FROM `sectors`");
          
          ?>

            <?php
          
          if (isset($_POST['sector_name'])) {
              $sector_name=$_POST['sector_name'];
           

              $conn->query("INSERT INTO `sectors` ( `sector_name`) VALUES ('$sector_name');"); ?>
            <script>
              window.location.href = ("sectors.php");
            </script>

            <?php
          }

         ?>

            <hr>

            <!--table -->
            <div style="overflow-x:auto;">
            <table class="table table-striped table-hover">
              <thead>
                <tr style="vertical-align: middle;">
                  <th scope="col">SL</th>
                  <th scope="col">Sector Name</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>

                <?php
                        
        $i=0;
        
                         

        while ($sec_data = $sector_data->fetch_assoc()) { ?>
                <tr>
                  <td style="vertical-align: middle;" scope="row"><?php echo ++$i ?>
                  </td>
                  <td style="vertical-align: middle;" scope="row"><?php echo $sec_data['sector_name']; ?>
                  </td>
                  <td style="vertical-align: middle;" scope="row">
                    <a href="./sector_edit.php?ram=<?php echo $sec_data['id']; ?>"
                      class="btn btn-sm btn-success">Edit</a>
                    <a href="./sector_delete.php?ram=<?php echo $sec_data['id']; ?>"
                      class="btn btn-sm btn-danger" onclick="return confirm('are you sure?')">Delete</a>
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

<?php require("../footer.php");
