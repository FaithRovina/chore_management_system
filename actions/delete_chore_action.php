<?php
// Include core.php to check if the user is logged in
require_once('../settings/core.php');

// Check if the user is logged in
checkLogin();

// Check if the chore ID is provided in the request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    // Sanitize the chore ID to prevent SQL injection
    $cid = intval($_POST['delete_id']);

    // Include database connection
    require_once('../settings/connection.php');

    // Prepare and execute SQL query to delete the chore
    $sql = "DELETE FROM chores WHERE cid = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $cid);
    if ($stmt->execute()) {
        // Chore deleted successfully, redirect to chore control view
        header("Location: ../admin/chore_control_view.php");
        exit();
    } else {
        // Error occurred while deleting chore
        header("Location: ../admin/chore_control_view.php?error=choredeleteerror");
        exit();
    }
} else {
    // Redirect back if chore ID is not provided
    header("Location: ../admin/chore_control_view.php");
    exit();
}

