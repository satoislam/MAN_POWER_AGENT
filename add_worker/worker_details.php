<?php
$page = "Dashboard";
require_once("../header.php");
require_once("../sidebar.php");
require_once("../db_config.php");
$id = $_GET['id'];
$informations = $conn->query("SELECT * FROM worker WHERE id = $id");
$worker_data = $informations->fetch_assoc();
?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-12 text-right">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="view_worker.php" class="btn btn-sm btn-info">All Workers</a></li>
        </ol>
      </div>

      <div class="col-md-12">
        <div class="text-center">
          <h1><?php echo $worker_data['name'] ?>'s All Informations</h1>
        </div>
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
            <!-- <h2 class="card-title text-center">code goes here</h2> -->
            <div class="row">
              <div class="col-md-6">
                <center>
                  <h1><?php echo $worker_data['name'] ?>'s Photo</h1>
                  <hr style=color:green width="100px; height=25px;">
                  <img height="350" width="350" alt="Image not found" src="../assets/uploads/worker_photos/<?php echo $worker_data['photo']; ?>" />
                </center>
              </div>
              <div class="col-md-6">
                <center>
                  <h1><?php echo $worker_data['name'] ?>'s Iqama Photo</h1>
                  <hr style=color:green width="100px; height=25px;">
                  <img height="350" width="350" alt="Image not found" src="../assets/uploads/iqama_photos/<?php echo $worker_data['iqama_photo']; ?>" />
                </center>
              </div>
            </div>
            <hr>
            <br>
            <div class="table-responsive">
              <table class="table text-center table-striped table-hover" id="xls">
                <tr>
                  <th>Name:</th>
                  <td><?Php echo $worker_data['name']; ?></td>
                  <th>ID:</th>
                  <td><?php echo $worker_data['id']; ?></td>

                </tr>
                <tr>
                  <th>Phone:</th>
                  <td><?php echo $worker_data['local_number']; ?></td>
                  <th>WhatsApp Number:</th>
                  <td><?php echo $worker_data['whatsapp_number']; ?></td>

                </tr>
                <tr>
                  <th>Iqama Number:</th>
                  <td><?php echo $worker_data['iqama_number']; ?></td>
                  <th>Passport Number:</th>
                  <td><?php echo $worker_data['passport_number']; ?></td>
                </tr>

                <tr>
                  <th>Current Address:</th>
                  <td><?php echo $worker_data['current_address']; ?></td>
                  <th>Working Place:</th>
                  <td><?php echo $worker_data['working_place']; ?></td>
                </tr>

                <tr>
                <th>Daily Basic Salary:</th>
                  <td><?php echo $worker_data['daily_basic_salary']; ?></td>
                  <th>Over Time Rate:</th>
                  <td><?php echo $worker_data['ot_rate']; ?></td>
                </tr>

                <tr>
                  <th>Status:</th>
                  <td><?php echo $worker_data['status']; ?></td>
                  <td>
                  <a href="javascript:void(0)" onclick="exportTableToExcel('xls','Worker Informations ')" class="btn btn-success btn-block">Export Informations</a>
                  </td>
                </tr>
              </table>
              
            </div>

          </div>
          <!-- /.card-header -->
          <div class="card-body">

          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<?php require("../footer.php"); ?>

<script>
  function exportTableToExcel(tableID, filename = '') {
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

    // Specify file name
    filename = filename ? filename + '.xls' : 'excel_data.xls';

    // Create download link element
    downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);

    if (navigator.msSaveOrOpenBlob) {
      var blob = new Blob(['\ufeff', tableHTML], {
        type: dataType
      });
      navigator.msSaveOrOpenBlob(blob, filename);
    } else {
      // Create a link to the file
      downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

      // Setting the file name
      downloadLink.download = filename;

      //triggering the function
      downloadLink.click();
    }
  }
</script>