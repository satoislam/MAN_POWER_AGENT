<?php 
@session_start();
// @session_destroy();
// header("location:index.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In Error</title>

    
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="wrap-content">
                        <div class="alert alert-danger" role="alert">
                            <h3>Account Disabled!!</h3>
                            <p>Your account has been disabled. Please contact with site administrator.</p>
                            <a href="index.php" class="btn btn-primary" onclick="destroy_session()">Login Page</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    function destroy_session(){
        <?php 
            @session_destroy();
        ?>
       window.location.href = "index.php";
    }
</script>