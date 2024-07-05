<?php
session_start();
if (isset($_SESSION['login'])) {
    unset($_SESSION['login']);  // Unset the session variable
}

// Optionally, clear the entire session:
// session_unset(); // Unset all session variables
// session_destroy(); // Destroy the session

// Clear any session cookie if set
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Redirect to the login page after logout
header('Location: login.php');
exit();
?>
