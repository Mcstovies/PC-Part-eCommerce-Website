<?php include 'includes/nav_general.php'; ?>

<?php
// Include database connection
include 'connect_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security
    $reg_date = date('Y-m-d H:i:s'); // Get the current date and time for registration

    // Insert user into the database
    $sql = "INSERT INTO users (first_name, last_name, email, pass, reg_date) VALUES (?, ?, ?, ?, ?)";
    $stmt = $link->prepare($sql);
    $stmt->bind_param('sssss', $first_name, $last_name, $email, $password, $reg_date);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Registration successful!</div>";
        header('Location: login.php'); // Redirect to login page after successful registration
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }
    $stmt->close();
}
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Register</h2>
                    <form method="POST">
                        <div class="form-group mb-3">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </form>
                </div>
            </div>
            <p class="text-center mt-3">
                Already have an account? <a href="login.php">Login here</a>.
            </p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
