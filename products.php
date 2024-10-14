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

echo "<h1>Products</h1>";
while ($product = $result->fetch_assoc()) {
    echo "<p>" . $product['name'] . " - $" . $product['price'] . "</p>";
}
?>

<a href="logout.php">Logout</a>
