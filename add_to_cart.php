<?php
// add_to_cart.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "happyhampers_db";

// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Collect form data safely (matching your HTML fields)
    $product_name = $_POST['product_name'] ?? '';
    $price = $_POST['price'] ?? '';
    $image = $_POST['image'] ?? '';

    // Validation
    if (!empty($product_name) && !empty($price)) {
        // Escape values for safety
        $product_name = $conn->real_escape_string($product_name);
        $price = $conn->real_escape_string($price);
        $image = $conn->real_escape_string($image);

        // Insert into 'cart' table
        $sql = "INSERT INTO cart (product_name,price,image)
                VALUES ('$product_name', '$price', '$image')";

        if ($conn->query($sql) === TRUE) {
            echo "
            <script>
                alert('✅ Product added to cart successfully!');
                window.history.back();
            </script>
            ";
        } else {
            echo "
            <script>
                alert('❌ Error adding product: " . addslashes($conn->error) . "');
                window.history.back();
            </script>
            ";
        }
    } else {
        echo "
        <script>
            alert('⚠️ Missing product details!');
            window.history.back();
        </script>
        ";
    }
}

$conn->close();
?>