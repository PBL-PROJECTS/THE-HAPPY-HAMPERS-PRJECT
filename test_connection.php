<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "happyhampers_db"; // change if your database has a different name

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
} else {
    echo "✅ Successfully connected to MySQL database!";
}
?>