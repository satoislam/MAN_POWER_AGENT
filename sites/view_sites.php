<?php

@session_start();
$id = $_SESSION['id'];
$page = "sites";
require_once("../header.php");
require_once("../sidebar.php");
require_once("../db_config.php");

$site=$conn->query("SELECT sites.id,sectors.sector_name,sites.site_name,sites.address,sites.contact_no,sites.status FROM `sites` JOIN sectors ON sectors.id=sites.sectorID ");

?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h2>Sites</h2>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="">Home</a></li>
          <li class="breadcrumb-item"><a href="">Sites</a></li>
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
            <div class="row">
              <div class="col-md-9">
                <h2 class="text-center mb-md-0 " style="margin-left: 16rem;">Sites List</h2>
              </div>
              <div class="col-md-3 text-right">
                <a href="./sites.php" class="btn btn-md btn-info"><i class="fas fa-plus"></i>
                  Add Sites</a>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <!--table -->
            <div style="overflow-x:auto;">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <tr style="vertical-align: middle;">
                  <th scope="col">SL</th>
                  <th scope="col">Sectors Name</th>
                  <th scope="col">Site Name</th>
                  <th scope="col">Address</th>
                  <th scope="col">Contact No</th>
                  <th scope="col">Status</th>

                  <?php 
                     $userRoleTable= $conn->query("SELECT * FROM `user_role` JOIN admin ON admin.id= user_role.adminID WHERE `adminID`= $id");
                       
                     while ($roleRow = $userRoleTable->fetch_assoc()) {
                       if( ($roleRow['sites_edit'] || $roleRow['sites_delete']) != '0'){ ?>
                        <th scope="col">Action</th>

                    <?php
                       }
                      }
                  ?>
                  
                </tr>
              </thead>

              <tbody>

                <?php
        
        $i=0;
        
        


        
        while ($site_data = $site->fetch_assoc()) { ?>
                <tr>
                  <td style="vertical-align: middle;" scope="row"><?php echo ++$i ?>
                  </td>
                  <td style="vertical-align: middle;" scope="row"><?php echo $site_data['sector_name']; ?>
                  </td>
                  <td style="vertical-align: middle;" scope="row"><?php echo $site_data['site_name']; ?>
                  </td>
                  <td style="vertical-align: middle;" scope="row"><?php echo $site_data['address']; ?>
                  </td>
                  <td style="vertical-align: middle;" scope="row"><?php echo $site_data['contact_no']; ?>
                  </td>
                  <td style="vertical-align: middle;" scope="row"><?php echo $site_data['status']; ?>
                  </td>
                  <td style="vertical-align: middle;" scope="row">
                    <?php 
                        $userRoleTable= $conn->query("SELECT * FROM `user_role` JOIN admin ON admin.id= user_role.adminID WHERE `adminID`= $id");
                       
                        while ($roleRow = $userRoleTable->fetch_assoc()) {
                          
                            
if ($roleRow['sites_edit']== '1') {  ?>
  <a href="./sites_edit.php?ram=<?php echo $site_data['id']; ?>"
class="btn btn-sm btn-success">Edit</a> 
<?php 
}

if($roleRow['sites_delete']== '1'){ ?>
  <a href="./sites_delete.php?ram=<?php echo $site_data['id']; ?>"
                      class="btn btn-sm btn-danger" onclick="return confirm('are you sure?')">Delete</a>

<?php 
}
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

<?php require("../footer.php");
