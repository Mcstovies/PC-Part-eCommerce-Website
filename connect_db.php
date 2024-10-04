<?php
# Database connection details
$conn = mysqli_connect('localhost', 'root', '', 'codespace');

# Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
