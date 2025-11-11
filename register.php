<?php
include 'connect.php';

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO customers (name, email, password) VALUES ('$name', '$email', '$password')";
    if (mysqli_query($conn, $sql)) {
        echo "Registration successful!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<form method="POST">
    <h2>Register</h2>
    <input type="text" name="name" placeholder="Enter name" required><br>
    <input type="email" name="email" placeholder="Enter email" required><br>
    <input type="password" name="password" placeholder="Enter password" required><br>
    <button type="submit" name="register">Register</button>
</form>