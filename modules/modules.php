<?php
$page = "User module";
$serverName = 'http://' . $_SERVER['SERVER_NAME'] . '/man_power_agent';
require_once("../header.php");
require_once("../sidebar.php");
require_once("../db_config.php");


$md = $conn->query("SELECT * FROM `module`");
if (isset($_POST['name'])) {
  $name = $_POST['name'];
  $word_count = str_word_count($name);
  if ($word_count == 2) {
    $capital = ucwords($name);
    $name_replace = str_replace(' ', '_', $name);
    $fileUrl = $serverName . "/" . $name_replace . "/" . $name_replace . ".php";
    $conn->query("INSERT INTO `module` ( `name`, `generated_link`) VALUES ('$capital', '$fileUrl')"); ?>

    <script>
      window.location.href = "modules.php";
    </script>
  <?php
  } elseif ($word_count == 1) {
    $capital = ucwords($name);
    $fileUrl = $serverName . "/" . $name . "/" . $name . ".php";
    $conn->query("INSERT INTO `module` ( `name`, `generated_link`) VALUES ('$capital', '$fileUrl')"); ?>
    <script>
      window.location.href = "modules.php";
    </script>

<?php
  }
}

?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Module</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home/ </a></li>
          <li class="breadcrumb-item"><a href="#">Modules</a></li>
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
            <h3>Modules</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form action="" method="post">
              <div class="row">
                <div class="col">
                  <input type="text" name="name" class="form-control" placeholder="Module name">
                </div>
              </div>


              <br>


              <input type="Submit" value="Submit" class="btn btn-success"> <br>
            </form>
            <hr>
            <!--table -->
            <table class="table table-striped" id="moduleID">
              <thead>
                <tr>
                  <th scope="col">Serial</th>
                  <th scope="col">Name</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 0;
                while ($md_data = $md->fetch_assoc()) { ?>

                  <tr>
                    <td scope="row"><?php echo ++$i; ?>
                    </td>
                    <td scope="row"><?php echo $md_data['name']; ?>
                    </td>
                    <td scope="row">
                      <a href="./module_edit.php?id=<?php echo $md_data['id']; ?>" class="btn btn-sm btn-success">Edit</a>
                      <a href="./modules.php?delid=<?php echo $md_data['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('are you sure?')">Delete</a>
                    </td>
                  </tr>

                <?php
                }


                //delete query
                if (isset($_GET['delid'])) {
                  $delid = $_GET['delid'];
                  $conn->query("DELETE FROM `module` WHERE id=$delid"); ?>

                  <script>
                    window.location.href = "modules.php";
                  </script>

                <?php
                }
                ?>

              </tbody>
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
  $('#moduleID').dataTable({
    pageLength: 5,
    lengthMenu: [
      [5, 10, 20, -1],
      [5, 10, 20, 'Todos']
    ]
  });

  
</script>