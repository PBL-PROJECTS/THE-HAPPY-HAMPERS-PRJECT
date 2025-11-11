<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Insert into contact_messages table
    $sql = "INSERT INTO contact_messages (name, email, subject, message, created_at)
            VALUES ('$name', '$email', '$subject', '$message', NOW())";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Thank you for contacting us! 💌 We’ll get back to you soon.');
                window.location.href = 'homepg2.html';
              </script>";
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}
?>