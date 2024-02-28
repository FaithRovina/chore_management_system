<?php
// Include connection file
include '../settings/connection.php';

// Enable error reporting and display errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the form data
    $email = $_POST['email'];
    $passwd = $_POST['passwd'];

    // Prepare and execute SQL query to retrieve user data
    $query = "SELECT * FROM people WHERE email = ?"; 
    $stmt = $con->prepare($query);
    
    if (!$stmt) {
        // Database error
        $response = array(
            'success' => false,
            'message' => 'Database error: ' . $con->error
        );
    } else {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if any row was returned
        if ($result === false) {
            // Database error
            $response = array(
                'success' => false,
                'message' => 'Database error: ' . $stmt->error
            );
        } elseif ($result->num_rows == 1) {
            // Fetch record
            $user = $result->fetch_assoc();

            // Verify password user provided against database record 
            if (password_verify($passwd, $user['passwd'])) {
                // Authentication successful
                // Create session for user id and role id
                session_start();
                $_SESSION['pid'] = $user['pid'];
                $_SESSION['rid'] = $user['rid'];

                // Generate the JSON response for successful login
                // $response = array(
                //     'success' => true,
                //     'message' => 'Login successful'
                header("Location: ../view/dashboard.html");
                
            } else {
                // Invalid password
                $response = array(
                    'success' => false,
                    'message' => 'Incorrect password'
                );
            }
        } else {
            // User not registered
            $response = array(
                'success' => false,
                'message' => 'User not registered'
            );
        }
    }

    // Send the JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
} 
// Login button not clicked (form not submitted)
