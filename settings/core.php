<?php

// Start session
session_start();

// Set idle timeout in seconds
define('IDLE_TIMEOUT', 300); // 5 minutes for testing purpose

// Function to check for login using user id session
function checkLogin() {
    // Check if user id session exists
    if (!isset($_SESSION['user_id'])) {
        // Redirect to login page
        header("Location: ../login/login_view.php");
        exit; // Stop further execution
    }
    
    // Reset idle timer
    resetIdleTimer();
}

// Function to check for user role id session
function checkUserRole() {
    // Check if user role id session exists
    if (!isset($_SESSION['user_role_id'])) {
        return false;
    }

    // Return role id
    return $_SESSION['role_id'];
}

// Function to reset idle timer
function resetIdleTimer() {
    // Update last activity time
    $_SESSION['last_activity'] = time();
}

// Function to check for idle timeout
function checkIdleTimeout() {
    // Check if last activity time is set
    if (isset($_SESSION['last_activity'])) {
        // Calculate time difference
        $idle_time = time() - $_SESSION['last_activity'];
        
        // Check if idle time exceeds timeout
        if ($idle_time > IDLE_TIMEOUT) {
            // Destroy session and redirect to login page
            session_unset();
            session_destroy();
            header("Location:../login/login_view.php");
            exit; // Stop further execution
        } else {
            // Reset idle timer
            resetIdleTimer();
        }
    }
}

// Call checkIdleTimeout on each request to check for idle timeout
checkIdleTimeout();


