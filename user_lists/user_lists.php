<?php

$page = "Users";
require_once("../header.php");
@session_start();
if (!isset($_SESSION['name'])) {
    header("location: $serverName/index.php");
}
require_once("../sidebar.php");
require_once("../db_config.php");
?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><i class="fas fa-users fa-sm text-cyan"></i> User Lists</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="./">Home</a></li>
          <li class="breadcrumb-item"><a href="#">User Lists</a></li>
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
              <div class="col-md-9">
                <h2 class="mb-0 text-center" style="margin-left: 16rem;">User Lists</h2>
              </div>
              <div class="col-md-3 text-right">
                <button class="btn btn-md btn-info" data-toggle="modal" data-target="#addUserModal"><i class="fas fa-plus"></i> Add User</button>
                <a href="./user_role.php" class="btn btn-md btn-info" ><i class="fas fa-plus"></i> Add User Role</a>
              </div>
            </div>
          </div>
          <div class="card-body">

            <div id="load_user">

            </div>

          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>



<!-- add user Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New User</h5>
        <button type="button" class="close" onclick="resetForm()" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="post" id="insert_form">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" placeholder="Enter username">
            <span id="username_empty" style="color:red"></span>
          </div>
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email">
            <span id="email_empty" style="color:red"></span>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password">
            <span id="pass_empty" style="color:red"></span>
          </div>
          <div class="form-group">
            <label for="status">Status</label>
            <div class="radio" >
              <input type="radio"  name="message_stat" value="Active">Active
              <input type="radio"  name="message_stat" value="Inactive">Inactive
            </div>


          </div>
          <input type="submit" class="btn btn-info" value="Add User">
        </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="resetForm()" >Reset Form</button>
        <button type="button" class="btn btn-danger" onclick="resetForm()" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- add user modal end-->

<?php require_once("../footer.php"); ?>


<script>
  //for loading data when document is ready
  $(document).ready(function() {
    displayData();
  })

  // make the modal draggable
  $(".modal-header").on("mousedown", function(mousedownEvt) {
    var $draggable = $(this);
    var x = mousedownEvt.pageX - $draggable.offset().left,
      y = mousedownEvt.pageY - $draggable.offset().top;
    $("body").on("mousemove.draggable", function(mousemoveEvt) {
      $draggable.closest(".modal-dialog").offset({
        "left": mousemoveEvt.pageX - x,
        "top": mousemoveEvt.pageY - y
      });
    });
    $("body").one("mouseup", function() {
      $("body").off("mousemove.draggable");
    });
    $draggable.closest(".modal").one("bs.modal.hide", function() {
      $("body").off("mousemove.draggable");
    });
  });

  //for displaying data
  function displayData() {
    let displayDtata = true;
    $.ajax({
      url: "insert.php",
      type: 'POST',
      data: {
        displaySend: displayDtata

      },
      "dataSrc": "tableData",
      success: function(data, status) {
        $('#load_user').html(data);
        $('#dataTable').DataTable({
          "destroy": true, //use for reinitialize datatable

          dom: 'Bfrtip',
          // Configure the drop down options.
          lengthMenu: [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
          ],
          // Add to buttons the pageLength option.
          buttons: [
            'pageLength', 'excel', 'print', 'pdf'
          ]
        });
        console.log(data)
      }
    })


  }

  //for user add
  $('#insert_form').on('submit', function(event) {

    event.preventDefault();


    let username = $('#username').val().trim();
    let email = $('#email').val().trim();
    let password = $('#password').val().trim();
    var message_stat = $("input[name='message_stat']:checked").val();
    

    if (username == '' || email == '' || password == '') {
      if (username == '') {
        $('#username_empty').text("Username can't be empty");
      } else {
        $('#username_empty').text("");
      }
      if (email == '') {
        $('#email_empty').text("email can't be empty");
      } else {
        $('#email_empty').text("");
      }
      if (password == '') {
        $('#pass_empty').text("pass can't be empty");
      } else {
        $('#pass_empty').text("");
      }
    } else {

      $.ajax({
        url: "insert.php",
        type: 'post',
        data: {
          nameSend: username,
          emailSend: email,
          passSend: password,
          statusSend: message_stat
        },
        success: function(data, response) {
          $('#addUserModal').hide();
          $('.modal-backdrop').remove();
          displayData();
          empty();
        }
      })

    }


  })





  //blank field
  function empty() {
    $('#username').val("");
    $('#email').val("");
    $('#password').val("");
    $('.message_stat').val("");
  }

  //reset  field
  function resetForm() {
    $('#username').val("");
    $('#email').val("");
    $('#password').val("");
    $('.message_stat').val("");
    $('#username_empty').contents().filter((_, el) => el.nodeType === 3).remove();
    $('#email_empty').contents().filter((_, el) => el.nodeType === 3).remove();
    $('#pass_empty').contents().filter((_, el) => el.nodeType === 3).remove();
    
  }
</script>