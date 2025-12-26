<?php
session_start();

// Unset the username and role variables
unset($_SESSION['username']);
unset($_SESSION['role']);

// Destroy the session
session_destroy();

// Redirect to the login page
header("Location: ../website/index.php");
exit;
?>