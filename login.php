<?php
// Include the navbar
include 'includes/nav_general.php';

// Include database connection
include 'connect_db.php'; 
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']); // Check if the "Remember Me" box is checked

    // Check if user exists by email
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verify the entered password with the hashed password stored in the database
        if (password_verify($password, $user['pass'])) {
            // Set session variable to identify logged-in user
            $_SESSION['user_id'] = $user['user_id']; 
            $_SESSION['email'] = $user['email'];

            // If "Remember Me" is checked, set cookies for email and token
            if ($remember) {
                setcookie('user_email', $email, time() + (86400 * 30), "/"); // 30 days
                setcookie('user_token', session_id(), time() + (86400 * 30), "/"); // Store session ID as a token
            }

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
    <label>
        <input type="checkbox" name="remember"> Remember Me
    </label>
    <button type="submit">Login</button>
</form>
