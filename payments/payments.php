<?php
$page = "payments";
require_once("../header.php");
require_once("../sidebar.php");
require_once("../db_config.php");

$db=$conn->query("SELECT * FROM `payments`");

if (isset($_POST['amount'])) {
    $amount=$_POST["amount"];
    $date=$_POST["date"];
    $invoiceID=$_POST["invoiceID"];
  
    $conn->query("INSERT INTO `payments` (`invoiceID`, `amount`, `date`) VALUES ('$invoiceID', '$amount', '$date')"); ?>
<script type="text/javascript">
  window.location.href = "payments.php";
</script>

<?php
}
?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h2> Payments</h2>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="">Home</a></li>
          <li class="breadcrumb-item"><a href="">Payments</a></li>
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
          <div class="card-header text-center ">
            <div class="row">
              <div class="col-md-12">
                <h2>Add Payment</h2>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form action="" method="post">
              <div class="row">
                <div class="col-4">
                  <div class="form-group">
                    <label for="invoiceID">Invoice No</label>
                    <input type="text" name="invoiceID" class="form-control" placeholder="Invoice No">
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="text" name="amount" class="form-control" placeholder="Amount">
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" name="date" id="date">
                  </div>
                </div>
              </div>
              <input type="submit" class="btn btn-block btn-success" value="Submit">
            </form>

            <hr>

            <h2 class="text-center mb-4"> Payments List</h2>
            <table class="table table-bordered">
              <tr>
                <th>Invoice No</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
              <tr>
                <?php
            while ($i=$db->fetch_assoc()) {?>

                <td><?php echo $i['invoiceID'] ?>
                </td>
                <td><?php echo $i['amount'] ?>
                </td>
                <td><?php echo $i['date'] ?>
                </td>
                <td>
                  <a href="update_payments.php?id=<?php echo $i['id'] ?>"
                    class="btn btn-xs btn-primary">Edit</a>
                  <a href="delete_payments.php?id=<?php echo $i['id'] ?>"
                    class="btn btn-xs btn-danger">Delete</a>
                </td>
              </tr>

              <?php } ?>
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
