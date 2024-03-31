<?php
// Include connection file
include '../settings/connection.php';

// Initialize empty arrays to store assignees and chores
$assignees = array();
$chores = array();

// Function to select assignees from the people table
function select_assignee_fxn($con) {
    global $assignees;
    // Prepare SQL statement
    $query = "SELECT fname FROM people";
    $result = $con->query($query);

    if ($result) {
        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Fetch all rows from the result set
            while ($row = $result->fetch_assoc()) {
                // Store assignees in the array
                $assignees[] = $row['fname'];
            }
        } else {
            echo "No assignees found.";
        }
    } else {
        echo "Error executing query: " . $con->error;
    }
}

// Function to select chores from the chores table
function select_chore_fxn($con) {
    global $chores;
    // Prepare SQL statement
    $query = "SELECT chorename FROM chores";
    $result = $con->query($query);

    if ($result) {
        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Fetch all rows from the result set
            while ($row = $result->fetch_assoc()) {
                // Store chores in the array
                $chores[] = $row['chorename'];
            }
        } else {
            echo "No chores found.";
        }
    } else {
        echo "Error executing query: " . $con->error;
    }
}

// Check if the connection object is valid
if ($con) {
    // Call the functions to populate arrays
    select_assignee_fxn($con);
    select_chore_fxn($con);

    // Close the database connection
    $con->close();
} else {
    echo "Error: Database connection failed.";
}
?>
