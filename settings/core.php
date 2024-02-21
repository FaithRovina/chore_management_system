<?php
// Start the session
session_start();

// Function to check if user is logged in
function checkLogin() {
    // Check if user id session exists
    if (!isset($_SESSION['user_id'])) {
        // Redirect to login page
        header("Location: login_view.php");
        // Stop further execution
        die();
    }
}

// Call the function to check login status on pages where login is required
checkLogin();
?>
