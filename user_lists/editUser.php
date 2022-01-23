<?php

$page = "Edit Users";
require_once("../header.php");
@session_start();
if (!isset($_SESSION['name'])) {
    header("location: $serverName/index.php");
}
require_once("../sidebar.php");
require_once("../db_config.php");

if(isset($_GET['editId'])){
    $editId = $_GET['editId'];
    $editTable = $conn->query("SELECT * FROM `admin` WHERE `id`=$editId");
    $editRow =$editTable->fetch_assoc();
}
?>


<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-edit mr-2 fa-sm text-cyan"></i>Update User </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="./">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Edit User </a></li>
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

                    <!-- /.card-header -->
                    <div class="card-header ">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="mb-0 text-center">Update User </h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <?php 
                           if(isset($_POST['userId'])){
                               $userId = $_POST['userId'];
                               $username = $_POST['username'];
                               $email = $_POST['email'];
                               $password = $_POST['password'];
                               $message_stat = $_POST['message_stat'];

                               $conn->query("UPDATE `admin` SET `name`='$username',`email`='$email',`password`='$password',`status`='$message_stat' WHERE `id`= $userId"); ?>
                               
                               <script>
                                   window.location.href="user_lists.php";
                               </script>
                        <?php
                           }
                        ?>
                        <form method="post" id="insert_form">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="hidden" name="userId" class="form-control" value="<?= $editRow['id']; ?>" >
                                <input type="text" name="username" class="form-control" value="<?= $editRow['name']; ?>" >
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" name="email" class="form-control" value="<?= $editRow['email']; ?>" >
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" value="<?= $editRow['password']; ?>" >
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <div class="radio">                                       
                                          <input type="radio" name="message_stat" value="Active" <?php if($editRow['status']=="active") echo "checked" ?>> Active            
                                          <input type="radio" name="message_stat" value="Inactive" <?php if($editRow['status']=="inactive") echo "checked" ?>> Inactive
                                </div>


                            </div>
                            <input type="submit" class="btn btn-info" value="Save Changes">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php  require_once("../footer.php");
