<?php

$serverName = 'http://' . $_SERVER['SERVER_NAME'] . '/man_power_agent';
require("functions.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php if (isset($page)) {
    echo $page . " | agency ";
} else {
    echo "agency";
} ?>
  </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <!--favicon -->
  <link rel="shortcut icon"
    href="<?= $serverName; ?>/assets/images/favicon.ico"
    type="image/x-icon">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" media="screen"
    href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css">

    <!-- icon picker css-->
    <link href="<?= $serverName; ?>/assets/css/fontawesome-browser.css" rel="stylesheet">

    <!-- Theme style -->
  <link rel="stylesheet"
    href="<?= $serverName; ?>/assets/css/adminlte.min.css">



  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs4/jq-3.6.0/jszip-2.5.0/dt-1.11.2/af-2.3.7/b-2.0.0/b-html5-2.0.0/b-print-2.0.0/date-1.1.1/fc-3.3.3/r-2.2.9/sc-2.0.5/sb-1.2.1/sl-1.3.3/datatables.min.css" />

  <link rel="stylesheet"
    href="<?= $serverName; ?>/assets/css/style.css">

</head>


<body class="hold-transition sidebar-mini layout-fixed slimScroll">
  <div class="wrapper">

    <!-- Preloader -->
    <!-- <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="<?= $serverName; ?>/assets/images/AdminLTELogo.png"
    alt="AdminLTELogo" height="60" width="60">
  </div> -->


  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a href="<?= $serverName; ?>/logout.php "
          class="btn btn-sm text-white btn-danger">Logout</a>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">