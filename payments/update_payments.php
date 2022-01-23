<?php
require_once("../header.php");
require_once("../sidebar.php");
require_once("../db_config.php"); 

$id=$_GET['id'];
$edit=$conn->query("SELECT * FROM `payments` WHERE id=$id");
$e=$edit->fetch_assoc();

if(isset($_POST['amount'])){
  $amount=$_POST["amount"];
  $date=$_POST["date"];
  $invoiceID=$_POST["invoiceID"];
  
  $conn->query("UPDATE `payments` SET `invoiceID` = '$invoiceID', `amount` = '$amount', `date` = '$date' WHERE `payments`.`id` = $id");  

  ?>
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
        <h1>Update Payments</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="add_payments.php">Payments</a></li>
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
            <h2 class="card-title text-center">Update Payments</h2>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
           <h1></h1>
           <form action="" method="post">
            <div class="row">
             <div class="col-6">
              <div class="form-group">
               <label for="invoiceID">InvoiceID</label>
               <input type="text" name="invoiceID" value=" <?php echo $e['invoiceID'] ?>" class="form-control" placeholder="InvoiceID">
             </div>
           </div>
           <div class="col-6">
            <div class="form-group">
             <label for="amount">Amount</label>
             <input type="text" name="amount" class="form-control" value=" <?php echo $e['amount'] ?> " placeholder="Amount">
           </div>
         </div>
        <div class="col-6">
          <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" value="<?php echo $e['date'] ?>" name="date" id="date">
          </div>
        </div>
      </div>
    </div>

    <input type="submit" class="btn btn-block btn-success" value="Submit">
  </form>

</div>
</div>
<!-- /.card -->
</div>
</div>
</div><!-- /.container-fluid -->
</section>



<?php require("../footer.php"); ?>