<?php
// Include necessary files for database connection and functions
require_once('../settings/core.php');
require_once('../settings/connection.php');

// Check if the user is logged in
checkLogin();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data
    $chorename = $_POST['chorename'];
    
    // Validate chore name (just checking if it's not empty for demonstration)
    if (empty($chorename)) {
        // Redirect back with error message if chore name is empty
        header("Location: ../admin/chore_control_view.php?error=emptychore");
        exit();
    }

    // Insert chore into database
    $sql = "INSERT INTO chores (chorename) VALUES (?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $chorename);
    if ($stmt->execute()) {
        // Chore added successfully
        header("Location: ../admin/chore_control_view.php?success=choreadded");
        exit();
    } else {
        // Error occurred while adding chore
        header("Location: ../admin/chore_control_view.php?error=choreadderror");
        exit();
    }
} else {
    // Redirect back if form not submitted
    header("Location: ../admin/chore_control_view.php");
    exit();
}

