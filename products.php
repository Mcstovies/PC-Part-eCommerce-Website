<?php include 'includes/nav_general.php'; ?>

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit;
}

// If user is logged in, display products
include 'connect_db.php';

// Handle adding to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];

    // Check if cart exists in session, if not, create it
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add product to the cart (or increase the quantity if already in cart)
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity']++;
    } else {
        $_SESSION['cart'][$product_id] = [
            'name' => $product_name,
            'price' => $product_price,
            'quantity' => 1
        ];
    }
    
    echo "<div class='alert alert-success'>Product added to cart!</div>";
}

// Display products
$sql = "SELECT * FROM products";
$result = $link->query($sql);

echo "<div class='container mt-5'>";
echo "<h1 class='text-center'>Products</h1>";
echo "<div class='row'>"; // Bootstrap row to hold the product cards

while ($product = $result->fetch_assoc()) {
    echo "<div class='col-md-4 mb-4'>";
    echo "<div class='card' style='width: 18rem;'>";
    echo "<img src='" . $product['item_img'] . "' class='card-img-top' alt='" . $product['item_name'] . "'>";
    echo "<div class='card-body'>";
    echo "<h5 class='card-title'>" . $product['item_name'] . "</h5>";
    echo "<p class='card-text'>" . $product['item_desc'] . "</p>";
    echo "<p class='card-text'><strong>£" . $product['item_price'] . "</strong></p>";
    // Add "Add to Cart" button form
    echo "<form method='POST' action=''>";
    echo "<input type='hidden' name='product_id' value='" . $product['item_id'] . "'>";
    echo "<input type='hidden' name='product_name' value='" . $product['item_name'] . "'>";
    echo "<input type='hidden' name='product_price' value='" . $product['item_price'] . "'>";
    echo "<button type='submit' class='btn btn-primary'>Add to Cart</button>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}

echo "</div>"; // End of row
echo "</div>"; // End of container
?>

<a href="cart.php" class="btn btn-info mt-3">View Cart</a>
<a href="logout.php" class="btn btn-danger mt-3">Logout</a>
