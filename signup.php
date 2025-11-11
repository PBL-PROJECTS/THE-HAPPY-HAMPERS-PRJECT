<?php
include('db_connect.php'); // ensure this file connects properly to happyhampers_db

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Encrypt password before saving
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert into database
    $sql = "INSERT INTO users (username, password, email, created_at) VALUES ('$username', '$hashed_password', '$email', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Signup successful!'); window.location.href='http://localhost/TheHappyHampers/homepg2.html';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>