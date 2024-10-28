<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit;
}

include 'includes/nav_general.php';

include 'connect_db.php';

// Handle adding to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

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

// Display only Memory products
$sql = "SELECT * FROM products WHERE category = 'Memory'";
$result = $link->query($sql);

echo "<div class='container mt-5'>";
echo "<h1 class='text-center mb-4'>Memory Cards</h1>";
echo "<div class='row'>";
while ($product = $result->fetch_assoc()) {
    echo "<div class='col-md-4 mb-4'>";
    echo "<div class='card product-card'>";
    echo "<img src='" . $product['item_img'] . "' class='card-img-top product-img' alt='" . $product['item_name'] . "'>";
    echo "<div class='card-body text-center'>";
    echo "<h5 class='card-title product-title'>" . $product['item_name'] . "</h5>";
    echo "<p class='card-text product-desc'>" . $product['item_desc'] . "</p>";
    echo "<p class='card-text product-price'><strong>£" . $product['item_price'] . "</strong></p>";
    echo "<form method='POST' action=''>";
    echo "<input type='hidden' name='product_id' value='" . $product['item_id'] . "'>";
    echo "<input type='hidden' name='product_name' value='" . $product['item_name'] . "'>";
    echo "<input type='hidden' name='product_price' value='" . $product['item_price'] . "'>";
    echo "<button type='submit' class='btn btn-primary add-to-cart-btn'>Add to Cart</button>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}
echo "</div>";
echo "<div class='text-center'>";
echo "<a href='cart.php' class='btn btn-info mt-3'>View Cart</a>";
echo "</div>";
echo "</div>";
?>

<!-- Additional CSS -->
<style>
/* Product card styling */
.product-card {
    border: none;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
}
.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}
.product-img {
    height: 200px;
    object-fit: cover;
}
.product-title {
    font-size: 1.25rem;
    color: #333;
}
.product-desc {
    font-size: 0.9rem;
    color: #777;
}
.product-price {
    font-size: 1.2rem;
    color: #333;
    font-weight: bold;
}
.add-to-cart-btn {
    background-color: #007bff;
    border: none;
    color: #fff;
    padding: 0.5rem 1rem;
    font-size: 1rem;
    transition: background-color 0.3s;
}
.add-to-cart-btn:hover {
    background-color: #0056b3;
}
</style>


<?php include 'includes/footer.php'; // Include footer
