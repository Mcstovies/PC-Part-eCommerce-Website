<?php
session_start();
include 'includes/nav_general.php';

echo "<h1>Welcome to MKTIME!</h1>";
echo "<p>Discover the best products!</p>";

if (isset($_SESSION['user_id'])) {
    echo "<a href='products.php'>View Products</a>";
} else {
    echo "<a href='register.php'>Register</a> or <a href='login.php'>Login</a>";
}

include 'includes/footer.php'; // Include footer
?>
