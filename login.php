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

<!-- Bootstrap Login Form Section -->
<section class="vh-100" style="background-color: #000000;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <h3 class="mb-5">Sign in</h3>

                        <!-- Display error message if login failed -->
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>

                        <form method="POST" action="login.php">
                            <div class="form-outline mb-4">
                                <input type="email" id="typeEmailX-2" class="form-control form-control-lg" name="email" placeholder="Email" required />
                                <label class="form-label" for="typeEmailX-2">Email</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" id="typePasswordX-2" class="form-control form-control-lg" name="password" placeholder="Password" required />
                                <label class="form-label" for="typePasswordX-2">Password</label>
                            </div>

                            <!-- Remember Me Checkbox -->
                            <div class="form-check d-flex justify-content-start mb-4">
                                <input class="form-check-input" type="checkbox" name="remember" id="form1Example3" />
                                <label class="form-check-label" for="form1Example3"> Remember password </label>
                            </div>

                            <!-- Login Button -->
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                        </form>

                        <hr class="my-4">

                        <!-- Social Sign-In Buttons -->
                        <button class="btn btn-lg btn-block mb-2" style="background-color: #dd4b39; color: white;" type="button">
                            <i class="fab fa-google me-2"></i> Sign in with Google
                        </button>
                        <button class="btn btn-lg btn-block mb-2" style="background-color: #3b5998; color: white;" type="button">
                            <i class="fab fa-facebook-f me-2"></i> Sign in with Facebook
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; // Footer ?>
