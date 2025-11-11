<?php
// ✅ Connect to database
include 'connect.php'; // keep using your existing connection file

// ✅ Fetch cart items from database
$cartQuery = "SELECT * FROM cart ORDER BY cart_id ASC";
$result = mysqli_query($conn, $cartQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>The Happy Hampers | My Cart</title>
  <link rel="stylesheet" href="cartstyle.css" />
</head>
<body>

  <!-- Navigation -->
  <nav>
    <ul>
      <li><a href="homepg2.html">Home</a></li>
      <li><a href="candle.html">Candles</a></li>
      <li><a href="bouquet.html">Bouquets</a></li>
      <li><a href="hamper.html">Hampers</a></li>
      <li><a href="wishlist.html">Wishlist</a></li>
      <li><a class="active" href="cart.php">Cart</a></li>
      <li><a href="contactus2.html">Contact</a></li>
    </ul>
  </nav>

  <!-- Header -->
  <header>
    <h1>The Happy Hampers</h1>
    <p class="tagline">Your Shopping Cart 🛍️</p>
  </header>

  <!-- Main Content -->
  <main>
    <section class="cart-container">
      <?php
      $subtotal = 0;

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          // ✅ Adjust column names exactly as per your table
          $cartId = $row['cart_id'];  // matches your DB column
          $productName = $row['product_name'];
          $price = $row['price'];
          $quantity = $row['quantity'];
          $image = $row['image'];

          $subtotal += $price * $quantity;

          echo "
          <div class='cart-item' data-price='{$price}'>
            <img src='{$image}' alt='{$productName}'>
            <div class='details'>
              <h3>{$productName}</h3>
              <p class='price'>₹{$price}</p>
              <div class='quantity'>
                <button class='minus'>-</button>
                <input type='text' value='{$quantity}' readonly>
                <button class='plus'>+</button>
              </div>
              <form action='remove_from_cart.php' method='POST'>
                <input type='hidden' name='cart_id' value='{$cartId}'>
                <button type='submit' class='remove-btn'>Remove</button>
              </form>
            </div>
          </div>
          ";
        }
      } else {
        echo "<p style='text-align:center;'>Your cart is empty 🛒</p>";
      }
      ?>
    </section>

    <!-- Checkout Section -->
    <section class="cart-summary">
      <?php
      $shipping = 99;
      $total = $subtotal + $shipping;
      ?>
      <h2>Order Summary</h2>
      <p>Subtotal: ₹<span id="subtotal"><?= $subtotal ?></span></p>
      <p>Shipping: ₹<?= $shipping ?></p>
      <hr>
      <h3>Total: ₹<span id="total"><?= $total ?></span></h3>

      <!-- ✅ This redirects to your existing checkout.html and sends total -->
      <form action="checkout.html" method="GET" id="checkoutForm">
        <input type="hidden" name="total_amount" id="hiddenTotal" value="<?= $total ?>">
        <button type="submit" class="checkout-btn">Proceed to Checkout</button>
      </form>
    </section>
  </main>

  <!-- Footer -->
  <footer>
    <p>© 2025 The Happy Hampers | Crafted with Love 💕</p>
  </footer>

  <!-- JS for quantity and totals -->
  <script>
    const cartItems = document.querySelectorAll('.cart-item');
    const subtotalEl = document.getElementById('subtotal');
    const totalEl = document.getElementById('total');
    const hiddenTotal = document.getElementById('hiddenTotal');
    const shipping = 99;

    function updateTotals() {
      let subtotal = 0;
      cartItems.forEach(item => {
        const price = parseInt(item.dataset.price);
        const qty = parseInt(item.querySelector('input').value);
        subtotal += price * qty;
      });
      subtotalEl.textContent = subtotal;
      totalEl.textContent = subtotal + shipping;
      hiddenTotal.value = subtotal + shipping; // ✅ Pass updated total
    }

    cartItems.forEach(item => {
      const minus = item.querySelector('.minus');
      const plus = item.querySelector('.plus');
      const input = item.querySelector('input');

      plus.addEventListener('click', () => {
        input.value = parseInt(input.value) + 1;
        updateTotals();
      });

      minus.addEventListener('click', () => {
        if (parseInt(input.value) > 1) {
          input.value = parseInt(input.value) - 1;
          updateTotals();
        }
      });
    });

    updateTotals();
  </script>

</body>
</html>