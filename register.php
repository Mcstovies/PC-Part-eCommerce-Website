<?php
// Include database connection
include 'connect_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security
    $reg_date = date('Y-m-d H:i:s'); // Get the current data and time for registration

    // Insert user into the database
    $sql = "INSERT INTO users (first_name, last_name, email, pass, reg_date) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn ->prepare($sql);
    $stmt->bind_param('sssss', $first_name, $last_name, $email, $password, $reg_date);

    if ($stmt->execute()) {
        echo "Registration successful!";
        header('Location: login.php'); // Redirect to login page after successful registration
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

