<?php
include 'connect.php'; // make sure this connects to happyhampers_db

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check email and password together
    $sql = "SELECT * FROM customers__new WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>
                alert('Login successful! Redirecting to homepage...');
                window.location.href = './homepg2.html';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Invalid email or password.');
                window.location.href = './login.html';
              </script>";
        exit();
    }
}
?>