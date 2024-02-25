<?php
// Include connection file
include '../settings/connection.php';

// Enable error reporting and display errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form is submitted
if (isset($_POST['login_btn'])) {
    // Get the form data
    $email = $_POST['email'];
    $password = $_POST['passwd'];

    // Prepare and execute SQL query to retrieve user data
    $query = "SELECT * FROM people WHERE email = ?"; 
    $stmt = $con->prepare($query);
    if (!$stmt) {
        $response = array(
            'success' => false,
            'message' => 'Database error: ' . $con->error
        );
        echo json_encode($response);
        exit;
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any row was returned
    if ($result === false) {
        $response = array(
            'success' => false,
            'message' => 'Database error: ' . $stmt->error
        );
        echo json_encode($response);
        exit;
    }

    if ($result->num_rows == 1) {
        // Fetch record
        $user = $result->fetch_assoc();

        // Verify password user provided against database record 
        if (password_verify($password, $user['passwd'])) {
            // Authentication successful
            // Create session for user id and role id
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role_id'] = $user['role_id'];

            // Generate the JSON response for successful login
            $response = array(
                'success' => true,
                'message' => 'Login successful'
            );
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

    // Send the JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;

} else {
    // Return JSON response indicating error (if login button not clicked)
    echo json_encode(array(
        'success' => false,
        'message' => 'Login button not clicked'
    ));
    exit;
}

