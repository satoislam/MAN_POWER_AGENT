<?php

@session_start();
require_once("db_config.php");
if (isset($_SESSION['name'])) {
    header("location: dashboard.php");
}
$serverName = 'http://'.$_SERVER['SERVER_NAME'].'/man_power_agent';
$selectTable = $conn->query("select * from admin");


if (isset($_POST['user'])) {
    $email = $_POST['user'];
    $password = $_POST['passwd'];
    $status = "error";

    if (empty($email) || empty($password)) {
        $_SESSION['msg'] = "Field Should not be Empty!!!";
    } else {
        while ($data = $selectTable->fetch_assoc()) {

            if ($data['email']  === $email && $data['password']  === $password) {
                $status = "ok";
                $_SESSION['name'] = $data['name'];
                $_SESSION['id'] = $data['id'];
                unset($_SESSION['msg']);
                header("location: dashboard.php");
            }
        }

        if ($status == "error") {
            $_SESSION['msg'] = "Username or password not matched!!";
            header("location: index.php");
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" type="text/css" href="<?= $serverName; ?>/assets/css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="<?= $serverName; ?>/assets/css/iofrm-theme9.css">
</head>

<body>
    <div class="form-body">
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder " style="text-align:center; margin:0 auto">
                    <h3>Train people well enough so they can leave.</h3>
                    <p>In order to build a rewarding employee experience, you need to understand what matters most to your people.</p>
                    <img src="<?= $serverName; ?>/assets/images/graphic5.svg" alt="">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <div class="website-logo-inside" style="display: block; text-align: center;">
                            <a href="<?= $serverName; ?>/index.php">
                                <div class="logo text-center">
                                    <img class="logo-size" src="<?= $serverName; ?>/assets/images/icon.png" alt="">
                                </div>
                            </a>
                        </div>
                        <div class="page-links">
                            <h4 style="color:#fff;text-align: center;">Login Form</h4>
                        </div>
                        <form method="post" action="">
                            <input class="form-control" type="email" name="user" placeholder="E-mail Address" required>
                            <input class="form-control" type="password" name="passwd" placeholder="Password" required>
                            <div class="form-button text-center">
                                <button id="submit" type="submit" class="ibtn">Login</button>
                            </div>
                            <p style="color:red;text-align:center">
                                <?php if (isset($_SESSION['msg'])) {
                                    echo $_SESSION['msg'];
                                } ?>

                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</body>

</html>