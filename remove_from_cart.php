<?php
include 'connect.php'; // use your working connection file

if (isset($_POST['cart_id'])) {
    $cart_id = $_POST['cart_id'];

    // ✅ Safely delete the item from cart table
    $deleteQuery = "DELETE FROM cart WHERE cart_id = '$cart_id'";
    if (mysqli_query($conn, $deleteQuery)) {
        // Redirect back to cart after removal
        header("Location: cart.php");
        exit();
    } else {
        echo "Error removing item: " . mysqli_error($conn);
    }
} else {
    // If no ID is sent, redirect back safely
    header("Location: cart.php");
    exit();
}
?>