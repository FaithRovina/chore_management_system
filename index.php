<?php
// Start or resume the session
session_start();

// Include the database connection file
include('../settings/connection.php');

// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location:../login/login_view.php");
    exit();
}

// Retrieve user information from the session
$user_id = $_SESSION['user_id'];

// Fetch user details from the database
$sql = "SELECT * FROM people WHERE user_id = $user_id";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // Display user information
    $row = $result->fetch_assoc();
    $user_name = $row['f_name'];

    echo "Welcome, $user_name!";
    
    // Logout link
    echo "<br><a href='logout.php'>Logout</a>";
} else {
    echo "User not found.";
}

// Close the database connection
$con->close();

