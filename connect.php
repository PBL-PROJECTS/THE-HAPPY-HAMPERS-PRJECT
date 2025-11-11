<?php
$conn = mysqli_connect("localhost", "root", "", "happyhampers_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>