<?php 
// Include the navbar
include 'includes/nav_general.php';

// Include database connection
include 'connect_db.php'; 
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user exists by email
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Debugging: Print values for verification
        echo "Entered Password: " . $password . "<br>";
        echo "Hashed Password from DB: " . $user['pass'] . "<br>";
        
        // Verify the entered password with the hashed password stored in the database
        if (password_verify($password, $user['pass'])) {
            // Set session variable to identify logged-in user
            $_SESSION['user_id'] = $user['user_id']; 
            header('Location: products.php'); // Redirect to the protected products page
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }

    $stmt->close();
}
?>

<form method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
