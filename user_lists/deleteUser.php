<?php

$serverName = 'http://' . $_SERVER['SERVER_NAME'] . '/man_power_agent';
@session_start();
if (!isset($_SESSION['name'])) {
    header("location: $serverName/index.php");
}
require_once("../db_config.php");



if (isset($_POST['deleteIdSend'])) {
    $deleteId = $_POST['deleteIdSend'];
    $deleteResult = $conn->query("DELETE FROM `admin` WHERE `id` = $deleteId");
}
