<?php
// Include connection file
include '../settings/connection.php';

// Check if form submitted
if (isset($_POST['register_button'])) {
    // Collect form data and assign each to a variable
    $username = $_POST['username']; // Update this line to match the correct field name from your HTML form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Encrypt the password 
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the connection object is valid
    if ($con) {
        // Prepare the SQL statement
        $query = "INSERT INTO people (username, email, password, rid) VALUES (?, ?, ?, 3)";
        $stmt = $con->prepare($query);

        if ($stmt) {
            // Bind parameters and execute the query
            $stmt->bind_param("sss", $username, $email, $hashed_password);
            if ($stmt->execute()) {
                // Redirect to login page if registration is successful
                header("Location: ../Login/login_view.php");
                exit();
            } else {
                // Redirect to registration page with error message
                header("Location: ../login/register_view.php?error=registration_failed");
                exit();
            }
        } else {
            // Redirect to registration page with error message
            header("Location: register_view.php?error=statement_prepare_failed");
            exit();
        }
    } else {
        // Redirect to registration page with error message
        header("Location: ../login/register_view.php?error=db_connection_failed");
        exit();
    }
} else {
    // If form not submitted, redirect back to register_view page
    header("Location: ../login/register_view.php");
    exit();
}

