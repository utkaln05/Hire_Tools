<?php
// Central DB connection file
$con = new mysqli("localhost", "root", "", "finalproject");
if ($con->connect_error) {
    die("connection failed: " . $con->connect_error);
}
?>