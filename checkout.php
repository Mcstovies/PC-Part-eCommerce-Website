<?php include 'includes/nav_general.php'; ?> <!-- Include navigation -->

<?php
session_start();
include 'connect_db.php'; // Include your database connection

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit;
}

// Check if cart is not empty
if (empty($_SESSION['cart'])) {
    echo "<p>Your cart is empty. Please <a href='products.php'>add products</a> to the cart.</p>";
    exit;
}

// Retrieve user ID from session
$user_id = $_SESSION['user_id'];

// Calculate total price for the order
$total_price = array_sum(array_map(function($product) {
    return $product['price'] * $product['quantity'];
}, $_SESSION['cart']));

// Insert order into the 'orders' table
$order_date = date('Y-m-d H:i:s');
$sql_order = "INSERT INTO orders (user_id, total, order_date) VALUES (?, ?, ?)";
$stmt_order = $link->prepare($sql_order);
$stmt_order->bind_param('ids', $user_id, $total_price, $order_date);

if ($stmt_order->execute()) {
    // Get the inserted order ID
    $order_id = $stmt_order->insert_id;

    // Insert each product in the cart into the 'order_contents' table
    foreach ($_SESSION['cart'] as $product_id => $product) {
        $sql_order_contents = "INSERT INTO order_contents (order_id, item_id, quantity, price) VALUES (?, ?, ?, ?)";
        $stmt_order_contents = $link->prepare($sql_order_contents);
        $stmt_order_contents->bind_param('iiid', $order_id, $product_id, $product['quantity'], $product['price']);
        $stmt_order_contents->execute();
    }

    // Clear the cart after the order is successfully placed
    unset($_SESSION['cart']);

    echo "<p>Order placed successfully! <a href='products.php'>Continue shopping</a></p>";
} else {
    echo "<p>Error placing order: " . $stmt_order->error . "</p>";
}

// Close the statement and connection
$stmt_order->close();
$link->close();
?>
