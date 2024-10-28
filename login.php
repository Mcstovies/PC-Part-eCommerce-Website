<?php
// Start session and include necessary files
session_start();
include 'includes/nav_general.php'; // Navbar
include 'connect_db.php'; // Database connection

// Check if cookies exist for automatic login
if (isset($_COOKIE['user_email']) && isset($_COOKIE['user_token'])) {
    $email = $_COOKIE['user_email'];
    $token = $_COOKIE['user_token'];
    
    // Verify session token matches current session for security
    if ($token === session_id()) {
        $sql = "SELECT user_id FROM users WHERE email = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['user_id'];
            header('Location: products.php'); // Redirect to products page
            exit;
        }
    } else {
        // Invalidate cookies if session token doesn't match
        setcookie('user_email', '', time() - 3600, "/");
        setcookie('user_token', '', time() - 3600, "/");
    }
}

// Handle manual login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']); // "Remember Me" checkbox

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['pass'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email'] = $user['email'];

            if ($remember) {
                setcookie('user_email', $email, time() + (86400 * 30), "/"); // 30 days
                setcookie('user_token', session_id(), time() + (86400 * 30), "/");
            }

            header('Location: products.php'); // Redirect to products
            exit;
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "User not found!";
    }

    $stmt->close();
}
?>

<style>
    /* Full page black background */
    body {
        background-color: #121212;
        color: white; /* White text for contrast */
    }
    
    /* Centering container with dark card */
    .container {
        padding-top: 50px;
    }

    .card {
        background-color: #333;
        color: white;
    }

    .form-control {
        background-color: #222;
        color: white;
        border: 1px solid #555;
    }

    .form-control::placeholder {
        color: #aaa;
    }

    .btn-primary {
        background-color: #ff4d4d;
        border-color: #ff4d4d;
    }

    .btn-primary:hover {
        background-color: #ff6666;
        border-color: #ff6666;
    }

    .social-btn {
        background-color: #333;
        color: white;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Sign In</h2>

                    <!-- Display error message if login failed -->
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>

                    <form method="POST" action="login.php">
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control" name="email" placeholder="Email" required />
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" id="password" class="form-control" name="password" placeholder="Password" required />
                        </div>

                        <!-- Remember Me Checkbox -->
                        <div class="form-check d-flex justify-content-start mb-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" />
                            <label class="form-check-label ms-2" for="remember"> Remember password </label>
                        </div>

                        <!-- Login Button -->
                        <button class="btn btn-primary w-100 mb-3" type="submit">Login</button>
                    </form>

                    <hr class="my-4">

                    <!-- Social Sign-In Buttons -->
                    <button class="btn social-btn w-100 mb-2" style="background-color: #dd4b39;" type="button">
                        <i class="fab fa-google me-2"></i> Sign in with Google
                    </button>
                    <button class="btn social-btn w-100" style="background-color: #3b5998;" type="button">
                        <i class="fab fa-facebook-f me-2"></i> Sign in with Facebook
                    </button>
                </div>
            </div>
            <p class="text-center mt-3">
                Don’t have an account? <a href="register.php" class="text-info">Register here</a>.
            </p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; // Footer ?>
