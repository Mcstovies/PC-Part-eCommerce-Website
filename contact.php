<?php
session_start();
include 'connect_db.php';
include 'includes/nav_general.php'; // Navbar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data and sanitize it
    $name = $link->real_escape_string(trim($_POST['name']));
    $email = $link->real_escape_string(trim($_POST['email']));
    $message = $link->real_escape_string(trim($_POST['message']));
    
    // Insert contact form data into the database
    $sql = "INSERT INTO contacts (name, email, message, submit_date) VALUES ('$name', '$email', '$message', NOW())";
    
    if ($link->query($sql)) {
        $success = "Thank you for reaching out! We'll get back to you shortly.";
    } else {
        $error = "An error occurred. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .contact-container {
            margin-top: 50px;
            max-width: 600px;
        }
        .contact-header {
            text-align: center;
            color: #dc3545; /* Red */
            margin-bottom: 20px;
        }
        .form-control:focus {
            border-color: #dc3545;
            box-shadow: 0 0 5px rgba(220, 53, 69, 0.5);
        }
        .btn-submit {
            background-color: #dc3545;
            color: white;
            border: none;
        }
        .btn-submit:hover {
            background-color: #b02a37;
        }
    </style>
</head>
<body>

<div class="container contact-container">
    <h2 class="contact-header">Contact Us</h2>

    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php elseif (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" action="contact.php">
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="message">Your Message</label>
            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-submit btn-block">Submit</button>
    </form>
</div>

<?php include 'includes/footer.php'; // Footer ?>

</body>
</html>
