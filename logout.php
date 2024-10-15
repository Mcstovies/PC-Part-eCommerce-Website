<?php
session_start();

// Unset session variables
session_unset();

// Destroy the session
session_destroy();

// Clear cookies
setcookie('user_email', '', time() - 3600, "/");
setcookie('user_token', '', time() - 3600, "/");

// Redirect to login page
header('Location: login.php');
?>
