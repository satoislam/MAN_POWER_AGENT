<?php

$conn = new mysqli("localhost", "root", "", "man_power");

if (!$conn) {
    die(mysqli_error($conn));
}
