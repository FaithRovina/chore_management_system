<?php
// Start session
session_start();

// Unset the session IDs created during login
unset($_SESSION['pid']);
unset($_SESSION['rid']);

// Redirect to login_view page
header("Location: login_view.php");
exit(); 

