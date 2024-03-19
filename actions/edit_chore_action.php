<?php
// Include necessary files for database connection and functions
require_once('../settings/connection.php');
require_once('../settings/core.php');

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set and not empty
    if (isset($_POST["edit_cid"]) && isset($_POST["edit_chorename"]) && !empty($_POST["edit_cid"]) && !empty($_POST["edit_chorename"])) {
        // Sanitize input to prevent SQL injection
        $cid = $con->real_escape_string($_POST["edit_cid"]);
        $chorename = $con->real_escape_string($_POST["edit_chorename"]);

        // Update chore in the database
        $sql = "UPDATE chores SET chorename = '$chorename' WHERE cid = $cid";

        if ($con->query($sql) === TRUE) {
            // Chore updated successfully
            // Redirect back to chore control view
            header("Location: ../admin/chore_control_view.php");
            exit();
        } else {
            // Error updating chore
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    } else {
        // Required fields not set or empty
        echo "All fields are required.";
    }
} else {
    // Redirect to index page if accessed directly
    header("Location: ../index.php");
    exit();
}
?>
