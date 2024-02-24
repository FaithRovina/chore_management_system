<?php
// Include connection file
include '../settings/connection.php';

//Enable error reporting and display errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include connection file
include '../settings/connection.php';

// Check if login button was clicked
if (!isset($_POST['login_btn'])) {
    // Stop processing and provide appropriate message or redirection
    header("Location:../login/login_view.php?error=login_button_not_clicked");
    exit();
}

// Collect form data and store in variables
$email = $_POST['email']; 
$passwd = $_POST['passwd'];

// Check if email or passwd is empty
if (empty($email) || empty($passwd)) {
    // Provide appropriate message or redirection
    header("Location:../login/login_view.php?error=empty_fields");
    exit();
}

// Prepare and execute SQL query to retrieve user data
$query = "SELECT * FROM users WHERE email = ?"; // Changed to select by email
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if any row was returned
if ($result->num_rows == 0) {
    // Provide appropriate response (user not registered, incorrect email or passwd, etc.)
    header("Location:../login/login_view.php?error=user_not_registered");
    exit();
}

// Fetch record
$user = $result->fetch_assoc();

// Verify passwd user provided against database record 
if (!passwd_verify($passwd, $user['passwd'])) {
    header("Location:../login/Login_view.php?error=incorrect_passwd");
    exit();
}

// Create session for user id and role id
session_start();
$_SESSION['user_id'] = $user['id'];
$_SESSION['role_id'] = $user['role_id'];

// Redirect to home page
header("Location:../view/Dashboard.html");
exit();
