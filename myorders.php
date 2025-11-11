<?php
include 'connect.php';

// Fetch all orders from the database
$sql = "SELECT * FROM orders ORDER BY order_date DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Orders | The Happy Hampers</title>
  <style>
    body {
      font-family: "Poppins", sans-serif;
      background-color: #fff9f5;
      margin: 0;
      padding: 0;
    }
    nav {
      background-color: #b47b84;
      padding: 10px 0;
      text-align: center;
    }
    nav ul {
      list-style: none;
      margin: 0;
      padding: 0;
    }
    nav ul li {
      display: inline;
      margin: 0 15px;
    }
    nav ul li a {
      color: white;
      text-decoration: none;
      font-weight: 500;
    }
    nav ul li a:hover {
      text-decoration: underline;
    }
    header {
      text-align: center;
      padding: 30px 0 10px;
    }
    header h1 {
      color: #b47b84;
      font-size: 2em;
    }
    main {
      width: 90%;
      max-width: 900px;
      margin: 30px auto;
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }
    table th, table td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: center;
    }
    table th {
      background-color: #f7dcdc;
      color: #333;
    }
    table tr:nth-child(even) {
      background-color: #fdf2f2;
    }
    footer {
      text-align: center;
      padding: 15px;
      background: #b47b84;
      color: white;
      margin-top: 30px;
    }
  </style>
</head>
<body>

  <nav>
    <ul>
      <li><a href="homepg2.html">Home</a></li>
      <li><a href="candle.html">Candles</a></li>
      <li><a href="bouquet.html">Bouquets</a></li>
      <li><a href="hamper.html">Hampers</a></li>
      <li><a href="wishlist.html">Wishlist</a></li>
      <li><a href="cart.html">Cart</a></li>
      <li><a href="myorders.php" class="active">My Orders</a></li>
      <li><a href="contactus2.html">Contact</a></li>
    </ul>
  </nav>

  <header>
    <h1>My Orders</h1>
    <p>Track your recent purchases 🧺</p>
  </header>

  <main>
    <?php
    if ($result && mysqli_num_rows($result) > 0) {
        echo "<table>
                <tr>
                  <th>Order ID</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Phone</th>
                  <th>Payment Method</th>
                  <th>Total Amount</th>
                  <th>Order Date</th>
                </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['order_id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['address']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['payment_method']}</td>
                    <td>₹{$row['total_amount']}</td>
                    <td>{$row['order_date']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='text-align:center;'>No orders found yet.</p>";
    }
    ?>
  </main>

  <footer>
    <p>© 2025 The Happy Hampers | Crafted with Love 💕</p>
  </footer>

</body>
</html>