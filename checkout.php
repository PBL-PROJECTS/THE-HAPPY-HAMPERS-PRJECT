<?php
include 'connect.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);
    $total_amount = mysqli_real_escape_string($conn, $_POST['total_amount']);

    // Temporarily use a static customer_id (you can replace with $_SESSION['customer_id'] later)
    $customer_id = 1;

    // Insert order into the database
    $sql = "INSERT INTO orders (customer_id, order_date, total_amount, name, address, phone, payment_method)
            VALUES ('$customer_id', NOW(), '$total_amount', '$name', '$address', '$phone', '$payment_method')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Order placed successfully! 💖 Redirecting to your orders...');
window.location.href = 'myorders.php';

              </script>";
        exit();
    } else {
        echo '❌ Error: ' . mysqli_error($conn);
    }
}
?>