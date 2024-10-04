<?php
# Database connection details
$link = mysqli_connect('localhost', 'root', '', 'codespace');

# Check if the connection is successful
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

?>
