<?php
# Database connection details
$conn = mysqli_connect('localhost', 'root', '', 'your_database_name');

# Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
