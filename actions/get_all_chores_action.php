<?php
// Include database connection
require_once('../settings/connection.php');

// Function to get all chores from the database
function getAllChores() {
    global $con;

    // Initialize variable to store result
    $result = [];

    // Query to select all chores
    $sql = "SELECT * FROM chores";

    // Execute the query
    $queryResult = $con->query($sql);

    // Check if query execution was successful
    if ($queryResult) {
        // Check if any records were returned
        if ($queryResult->num_rows > 0) {
            // Fetch all records and store them in the result array
            while ($row = $queryResult->fetch_assoc()) {
                $result[] = $row;
            }
        }
    }

    // Return the result
    return $result;
}
?>
