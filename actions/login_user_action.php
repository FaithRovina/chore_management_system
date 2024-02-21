<?php
// Enable error reporting and display errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include connection file
include '../settings/connection.php';

// Check if login button was clicked
if (!isset($_POST['login_button'])) {
    // Stop processing and provide appropriate message or redirection
    header("Location:../login/login_view.php?error=login_button_not_clicked");
    exit();
}

// Collect form data and store in variables
$username = $_POST['username'];
$password = $_POST['password'];

// Check if username or password is empty
if (empty($username) || empty($password)) {
    // Provide appropriate message or redirection
    header("Location:../login/login_view.php?error=empty_fields");
    exit();
}

// Prepare and execute SQL query to retrieve user data
$query = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Check if any row was returned
if ($result->num_rows == 0) {
    // Provide appropriate response (user not registered, incorrect username or password, etc.)
    header("Location:../login/login_view.php?error=user_not_registered");
    exit();
}

// Fetch record
$user = $result->fetch_assoc();

// Verify password user provided against database record 
if (!password_verify($password, $user['password'])) {
    header("Location:../login/login_view.php?error=incorrect_password");
    exit();
}

// Create session for user id and role id
session_start();
$_SESSION['user_id'] = $user['id'];
$_SESSION['role_id'] = $user['role_id'];

// Redirect to home page
header("Location:../view/home.php");
exit();

