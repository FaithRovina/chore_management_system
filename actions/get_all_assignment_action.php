<?php
// Include the database connection
require_once('../settings/connection.php');
require_once('../settings/core.php');

// Function to get all assignments
function getAllAssignments() {
    global $con;

    // Query to select all assignments
    $sql = "SELECT * FROM assignment";

    // Perform the query
    $result = $con->query($sql);

    // Check if the query was successful
    if ($result) {
        // Check if any record was returned
        if ($result->num_rows > 0) {
            // Fetch records and return them
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // No records found
            return array();
        }
    } else {
        // Query execution failed
        return false;
    }
}

