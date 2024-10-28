<?php
// Include the navbar
include 'includes/nav_general.php';

// Start session
session_start();

// Include database connection
include 'connect_db.php';

// Check if cookies exist and attempt automatic login
if (isset($_COOKIE['user_email']) && isset($_COOKIE['user_token'])) {
    $email = $_COOKIE['user_email'];
    $token = $_COOKIE['user_token'];

    // Verify the session token matches the current session (as an extra security measure)
    if ($token === session_id()) {
        // Retrieve the user_id from the database based on the email in the cookie
        $sql = "SELECT user_id FROM users WHERE email = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            // Automatically log the user in
            $_SESSION['user_id'] = $user['user_id'];
            header('Location: products.php'); // Redirect to the products page
            exit;
        }
    } else {
        // Invalidate the cookies if the session token doesn't match
        setcookie('user_email', '', time() - 3600, "/");
        setcookie('user_token', '', time() - 3600, "/");
    }
}

// Handle manual login
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
            exit;
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

<?php include 'includes/footer.php'; // Include footer