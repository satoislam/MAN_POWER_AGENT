<?php
$serverName = 'http://' . $_SERVER['SERVER_NAME'] . '/man_power_agent';
@session_start();
    if (!isset($_SESSION['name'])) {
        header("location: $serverName/index.php");
    }
 ?>

</div>
<!-- /.content-wrapper -->



<footer class="main-footer">
  <strong>Copyright &copy; 2021 <a href="#" class="text-navy">IDB-BISEW, BITL WDPF ROUND-46</a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block text-navy">
    <b>Version</b> 1.0.0
  </div>
</footer>



<!-- jQuery -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
  integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
  integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript"
  src="https://cdn.datatables.net/v/bs4/jq-3.6.0/jszip-2.5.0/dt-1.11.2/af-2.3.7/b-2.0.0/b-html5-2.0.0/b-print-2.0.0/date-1.1.1/fc-3.3.3/r-2.2.9/sc-2.0.5/sb-1.2.1/sl-1.3.3/datatables.min.js">
</script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?= $serverName; ?>/assets/js/fontawesome-browser.js"></script>

<!-- AdminLTE App -->
<script src="<?= $serverName; ?>/assets/js/adminlte.js"></script>
<script src="<?= $serverName; ?>/assets/js/main.js"></script>
</body>

</html>