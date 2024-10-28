<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit;
}

include 'includes/nav_general.php';

// Handle removing items from the cart
if (isset($_POST['remove'])) {
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
}

// Handle updating quantities
if (isset($_POST['update'])) {
    $product_id = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    if ($quantity > 0) {
        $_SESSION['cart'][$product_id]['quantity'] = $quantity;
    }
}

// Display cart
echo "<div class='container mt-5'>";
echo "<h1 class='text-center'>Shopping Cart</h1>";

if (!empty($_SESSION['cart'])) {
    echo "<table class='table table-striped'>";
    echo "<thead><tr><th>Product</th><th>Price</th><th>Quantity</th><th>Total</th><th>Action</th></tr></thead>";
    echo "<tbody>";

    $total_price = 0;
    foreach ($_SESSION['cart'] as $product_id => $product) {
        $product_total = $product['price'] * $product['quantity'];
        $total_price += $product_total;

        echo "<tr>";
        echo "<td>" . $product['name'] . "</td>";
        echo "<td>$" . $product['price'] . "</td>";
        echo "<td>";
        // Update quantity form
        echo "<form method='POST' action=''>";
        echo "<input type='hidden' name='product_id' value='" . $product_id . "'>";
        echo "<input type='number' name='quantity' value='" . $product['quantity'] . "' min='1'>";
        echo "<button type='submit' name='update' class='btn btn-sm btn-primary'>Update</button>";
        echo "</form>";
        echo "</td>";
        echo "<td>$" . $product_total . "</td>";
        echo "<td>";
        // Remove from cart form
        echo "<form method='POST' action=''>";
        echo "<input type='hidden' name='product_id' value='" . $product_id . "'>";
        echo "<button type='submit' name='remove' class='btn btn-sm btn-danger'>Remove</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "<h3>Total Price: £" . $total_price . "</h3>";
    echo "<a href='checkout.php' class='btn btn-success'>Proceed to Checkout</a>";
} else {
    echo "<p>Your cart is empty.</p>";
}

echo "</div>";


?>

<a href="products.php" class="btn btn-primary mt-3">Continue Shopping</a>

<?php include 'includes/footer.php'; // Include footer

