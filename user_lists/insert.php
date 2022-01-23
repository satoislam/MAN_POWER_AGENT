<?php
$serverName = 'http://' . $_SERVER['SERVER_NAME'] . '/man_power_agent';
@session_start();
if (!isset($_SESSION['name'])) {
    header("location: $serverName/index.php");
}
require_once("../db_config.php");
extract($_POST);
if (isset($_POST['nameSend'])  &&  isset($_POST['emailSend'])  &&  isset($_POST['passSend'])  && isset($_POST['statusSend'])) {
    $sql = "INSERT INTO `admin` ( `name`, `email`, `password`, `status`) VALUES ( '$nameSend', '$emailSend', '$passSend', '$statusSend')";
    $conn->query($sql);
    
}



//for load data
if (isset($_POST['displaySend'])) {
    $adminTable = $conn->query("SELECT * FROM `admin`");
    $output = '';


    if (mysqli_num_rows($adminTable) > 0) {
        $output .= "<table class='table table-striped table-bordered table-responsive-sm' id='dataTable' width='100%' cellspacing='0'>
                  <thead>
                    
                    <tr>
                        <th>Serial</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                  </thead>";

        $i = 1;
        while ($row = mysqli_fetch_assoc($adminTable)) {
            $rowId = $row['id'];
            if ($row['status']== 'active') {
                $success_color = "success";
            } else {
                $success_color = "danger";
            }
            $output .= "<tr>
                                <td class='align-middle'>".$i++."</td>
                                <td class='align-middle'>{$row['name']}</td>
                                <td class='align-middle'>{$row['email']}</td>
                                <td class='align-middle'>{$row['password']}</td>
                                <td class='align-middle'><span class='text-bold text-{$success_color}'>{$row['status']}</span></td>
                                <td class='align-middle'>
                                   <a href='editUser.php?editId={$rowId}' data-id='{$row['id']}'  class='btn btn-sm btn-info' >Edit</a>
                                   <a href='javascript:void(0)' data-id='{$row['id']}' class='btn btn-sm btn-danger' onclick='deleteUser(this)'>Delete</a>
                                </td>
                            </tr>";
        }
        $output .= "</table>";
        echo $output;
    } else {
        echo "No record found";
    }
}


?>


<script>
    
    // delete ajax
    function deleteUser(){
        var id = $("a:focus").attr("data-id");
        delConfirm = confirm(`Are you sure to delete this user ${id} `);
        
        if(delConfirm){

            $.ajax({
                url: "deleteUser.php",
                type: 'post',
                data: {
                    deleteIdSend: id,
                },
                success: function(data, response) {
                    displayData();
                    console.log(data)
                }
            })
        }
        else{
            alert("can't delete")
        }
        

    }

  
  
</script>


