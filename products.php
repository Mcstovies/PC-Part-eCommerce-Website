<?php include 'includes/nav_general.php'; ?>

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit;
}

// If user is logged in, display products
include 'connect_db.php';

$sql = "SELECT * FROM products";
$result = $link->query($sql);

echo "<div class='container mt-5'>";
echo "<h1 class='text-center'>Products</h1>";
echo "<div class='row'>"; // Bootstrap row to hold the product cards

while ($product = $result->fetch_assoc()) {
    // Each product will be in its own Bootstrap column with a card layout
    echo "<div class='col-md-4 mb-4'>"; // Bootstrap column
    echo "<div class='card' style='width: 18rem;'>"; // Card start
    echo "<img src='" . $product['item_img'] . "' class='card-img-top' alt='" . $product['item_name'] . "'>"; // Display the image
    echo "<div class='card-body'>"; // Card body
    echo "<h5 class='card-title'>" . $product['item_name'] . "</h5>"; // Display the product name
    echo "<p class='card-text'>" . $product['item_desc'] . "</p>"; // Display the product description
    echo "<p class='card-text'><strong>$" . $product['item_price'] . "</strong></p>"; // Display the price
    echo "</div>"; // End of card body
    echo "</div>"; // End of card
    echo "</div>"; // End of Bootstrap column
}

echo "</div>"; // End of row
echo "</div>"; // End of container
?>

<a href="logout.php" class="btn btn-danger mt-3">Logout</a>
