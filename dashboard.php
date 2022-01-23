<?php
$page = "Dashboard";
require_once("header.php");
require_once("sidebar.php");
require_once("db_config.php");

$sectors = $conn->query("SELECT * FROM `sectors`");
?>

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
          <div class="card-body">

            <div class="row">

              <!-- Chart for total employee    -->

              <div class="col-md-6">
                <!-- Styles -->
                <style>
                  #chartdiv2 {
                    width: 100%;
                    height: 250px;
                  }

                  #chartdivv {
                    width: 100%;
                    height: 250px;
                  }
                  #invoiceChart{
                    width: 100%;
                    height: 250px;
                  }
                </style>

                <!-- Resources -->
                <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
                <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
                <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

                <!-- Chart code -->
                <script>
                  am4core.ready(function() {

                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    // Create chart instance
                    var chart = am4core.create("chartdiv2", am4charts.PieChart);

                    // Add data
                    chart.data = [
                      <?php $s = $conn->query("SELECT * FROM `sectors`");
                      while ($sector = $s->fetch_assoc()) {
                          $d=$conn->query("SELECT COUNT(*) as total FROM `worker_assign` JOIN sites ON sites.id=worker_assign.siteID JOIN sectors ON sectors.id=sites.sectorID WHERE sectors.id=".$sector['id']);
                          $tt=$d->fetch_assoc();
                          $total=0;
                          if ($tt['total']!='') {
                              $total=$tt['total'];
                          } ?>
                      {
                        "country": "<?php  echo $sector['sector_name']; ?>",
                        "litres": <?php echo $total; ?>
                      },
                      <?php
                      } ?>
                    ];
                    // Add and configure Series
                    var pieSeries = chart.series.push(new am4charts.PieSeries());
                    pieSeries.dataFields.value = "litres";
                    pieSeries.dataFields.category = "country";
                    pieSeries.slices.template.stroke = am4core.color("#fff");
                    pieSeries.slices.template.strokeWidth = 2;
                    pieSeries.slices.template.strokeOpacity = 1;

                    // This creates initial animation
                    pieSeries.hiddenState.properties.opacity = 1;
                    pieSeries.hiddenState.properties.endAngle = -90;
                    pieSeries.hiddenState.properties.startAngle = -90;

                  }); // end am4core.ready()
                </script>

                <!-- HTML -->
                <div id="chartdiv2"></div>

                <?php
 $number_of_worker = $conn->query("SELECT COUNT(*) FROM `worker`");
  $worker_total = $number_of_worker->fetch_assoc();
  // print_r($invoice_total);
  // echo $invoice_total['COUNT(*)'];?>
                <div class="text-center">
                  <?php echo 'Total Workers : '. $worker_total['COUNT(*)']; ?>

                </div>

              </div>

              <!-- Chart for total Invoices -->
              <div class="col-md-6">
                <style>
                  #chartdiv {
                    width: 100%;
                    height: 250px;
                  }
                </style>
                <?php
 if (isset($_POST['sites']) && isset($_POST['month'])) {
     $site = $_POST['sites'];
     $month = $_POST['month'];
     $payment_total = $conn->query("SELECT sum(amount) AS collected FROM `invoice_payment` WHERE 	siteID = {$site} AND monthID = {$month}");
     $invoice = $conn->query("SELECT SUM(amount) AS pending FROM `invoice` WHERE 	siteID = {$site} AND monthID = {$month}");
 } elseif (isset($_POST['sites'])) {
     $site = $_POST['sites'];
     $payment_total = $conn->query("SELECT sum(amount) AS collected FROM `invoice_payment` WHERE 	siteID = ".$site);
     $invoice = $conn->query("SELECT SUM(amount) AS pending FROM `invoice` WHERE 	siteID = ".$site);
 } elseif (isset($_POST['month'])) {
     $month = $_POST['month'];
     $payment_total = $conn->query("SELECT sum(amount) AS collected FROM `invoice_payment` WHERE 	monthID = ".$month);
     $invoice = $conn->query("SELECT SUM(amount) AS pending FROM `invoice` WHERE 	monthID = ".$month);
 } else {
     $payment_total = $conn->query("SELECT sum(amount) AS collected FROM `invoice_payment`");
     $invoice = $conn->query("SELECT SUM(amount) AS pending FROM `invoice`");
 }
// var_dump($payment_total);
   $total = $payment_total->fetch_assoc();
   
  $pending_invoice = $invoice->fetch_assoc();
  $pending = $pending_invoice['pending']-$total['collected'];
  
  // print_r($pending);

?>
                <div class="row">
                  <div class="">
                    <form action="" method="post">
                      <table>
                        <tr>
                          <td><label for="site">Choose Site: </label></td>
                          <td>
                            <select name="sites" id="sites" class="form-control">
                              <option disabled selected value>Select</option>
                              <?php  $site_search = $conn->query("SELECT * FROM `sites`");
              
              while ($site = $site_search->fetch_assoc()) { ?>
                              <option
                                value="<?php echo $site['id']; ?>">
                                <?php echo $site['site_name']; ?>
                              </option>
                              <?php } ?>

                            </select>
                          <td><label for="month">Choose Month: </label></td>
                          <td>
                            <select name="month" id="month" class="form-control">
                              <option disabled selected value>Select</option>
                              <?php  $month_search = $conn->query("SELECT * FROM `month`");
              
              while ($month = $month_search->fetch_assoc()) { ?>
                              <option
                                value="<?php echo $month['id']; ?>">
                                <?php echo $month['month_name']; ?>
                              </option>
                              <?php } ?>
                            </select>
                          </td>
                          </td>
                          <td>
                            <input type="submit" name="submit" id="submit" value="Search"
                              class="form-control btn btn-sm btn-success">
                          </td>
                        </tr>
                      </table>
                    </form>
                  </div>
                </div>
                <?php
               

         ?>

                <!-- Resources -->
                <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
                <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
                <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

                <!-- Chart code -->
                <script>
                  am4core.ready(function() {

                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    // Create chart instance
                    var chart = am4core.create("chartdiv", am4charts.PieChart);

                    // Add data
                    chart.data = [{
                        "country": "Collected Bill",
                        "litres": <?php echo $total['collected']; ?>
                      }, {
                        "country": "Pending Bill",
                        "litres": <?php echo $pending; ?>
                      }

                    ];

                    // Add and configure Series
                    var pieSeries = chart.series.push(new am4charts.PieSeries());
                    pieSeries.dataFields.value = "litres";
                    pieSeries.dataFields.category = "country";
                    pieSeries.slices.template.stroke = am4core.color("#fff");
                    pieSeries.slices.template.strokeWidth = 2;
                    pieSeries.slices.template.strokeOpacity = 1;

                    // This creates initial animation
                    pieSeries.hiddenState.properties.opacity = 1;
                    pieSeries.hiddenState.properties.endAngle = -90;
                    pieSeries.hiddenState.properties.startAngle = -90;

                  }); // end am4core.ready()
                </script>

                <!-- HTML -->
                <div id="chartdiv"></div>
                <?php
 $number_of_invoice = $conn->query("SELECT COUNT(*) FROM `invoice`");
  $invoice_total = $number_of_invoice->fetch_assoc();
  // print_r($invoice_total);
  // echo $invoice_total['COUNT(*)'];?>
                <div class="text-center">
                  <?php echo 'Total Bill: '. $invoice_total['COUNT(*)']; ?>

                </div>


              </div>

            </div>


            <div class="row">
              <div class="col-md-6">
                <!-- advance salary -->
                <!-- Chart code -->
                <script>
                  am4core.ready(function() {

                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    // Create chart instance
                    var chart = am4core.create("chartdivv", am4charts.PieChart);
                    <?php
                    $t=$conn->query("SELECT sum(amount) as total FROM `advance`");
                    $advance=$t->fetch_assoc();

                    ?>
                    // Add data
                    chart.data = [



                      {
                        "country": "Total Advance",
                        "litres": <?php  echo $advance['total']?>
                      }, {
                        "country": "Total salary",
                        "litres": 301.9
                      }
                    ];
                    // Add and configure Series
                    var pieSeries = chart.series.push(new am4charts.PieSeries());
                    pieSeries.dataFields.value = "litres";
                    pieSeries.dataFields.category = "country";
                    pieSeries.slices.template.stroke = am4core.color("#fff");
                    pieSeries.slices.template.strokeWidth = 2;
                    pieSeries.slices.template.strokeOpacity = 1;

                    // This creates initial animation
                    pieSeries.hiddenState.properties.opacity = 1;
                    pieSeries.hiddenState.properties.endAngle = -90;
                    pieSeries.hiddenState.properties.startAngle = -90;

                  }); // end am4core.ready()
                </script>

                <!-- HTML -->
                <div id="chartdivv"></div>
                <div class="text-center">Advance: ,salary : ,</div>

              </div>
              <div class="col-md-6">
                <!-- invoice chart -->
                <script>
                  am4core.ready(function() {

                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    // Create chart instance
                    var chart = am4core.create("invoiceChart", am4charts.PieChart);
                    <?php
                    $r=$conn->query("SELECT sum(amount) as total FROM `invoice`");
                    $pending=$r->fetch_assoc();
                    $s=$conn->query("SELECT sum(amount) AS total FROM `payments`");
                    $collected=$s->fetch_assoc();

                    ?>
                    // Add data
                    chart.data = [{
                      "country": "pending",
                      "litres": <?php echo $pending['total']?>
                    }, {
                      "country": "collected",
                      "litres": <?php echo $collected['total']?>

                    }];

                    // Add and configure Series
                    var pieSeries = chart.series.push(new am4charts.PieSeries());
                    pieSeries.dataFields.value = "litres";
                    pieSeries.dataFields.category = "country";
                    pieSeries.slices.template.stroke = am4core.color("#fff");
                    pieSeries.slices.template.strokeWidth = 2;
                    pieSeries.slices.template.strokeOpacity = 1;

                    // This creates initial animation
                    pieSeries.hiddenState.properties.opacity = 1;
                    pieSeries.hiddenState.properties.endAngle = -90;
                    pieSeries.hiddenState.properties.startAngle = -90;

                  }); // end am4core.ready()
                </script>

                <!-- HTML -->
                <div id="invoiceChart"></div>
                <div class="text-center">Total invoice:(3)</div>
              </div>
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

<?php require("footer.php");
