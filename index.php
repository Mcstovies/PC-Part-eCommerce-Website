<?php
session_start();
include 'includes/nav_general.php';
?>

<!--Jumbotron Section -->
<div class="jumbotron jumbotron-fluid bg-dark text-white">
    <div class="contained text-center">
        <h1 class="display-4">Build Your Dream PC</h1>
        <p class="lead">Explore the best PC components and accessories for your next build.</p>
        <a href="products.php" class="btn btn-danger btn-lg">Shop Now</a>
    </div>
  </div>


<?php
// Welcome message and options based on user login status
echo "<div class='container text-center mt-5'>";
echo "<h1>Welcome to MKPC!</h1>";
echo "<p>Discover the best products!</p>";

if (isset($_SESSION['user_id'])) {
    echo "<a href='products.php' class='btn btn-primary'>View Products</a>";
} else {
    echo "<a href='register.php' class='btn btn-success'>Register</a> or <a href='login.php' class='btn btn-info'>Login</a>";
}
echo "</div>";

include 'includes/footer.php'; // Include footer
?>
