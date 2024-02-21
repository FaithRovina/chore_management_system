<?php
// Start session
session_start();

// Unset the session IDs created during login
unset($_SESSION['user_id']);
unset($_SESSION['username']);

// Redirect to login_view page
header("Location: login_view.php");
exit(); 
?>
