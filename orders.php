<?php
include 'connect.php';

// When checkout form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // (1) These will come from the cart page
    $customer_id = $_POST['customer_id'];   // hidden field or session later
    $total_amount = $_POST['total'];        // total amount from cart

    // (2) Insert into your orders table
    $sql = "INSERT INTO orders (customer_id, order_date, total_amount)
            VALUES ('$customer_id', NOW(), '$total_amount')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Order placed successfully! 💖');
                window.location.href = 'homepg2.html';
              </script>";
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}
?>