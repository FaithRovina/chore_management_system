<?php
// Include database connection
require_once('../settings/connection.php');

// Function to get all chores from the database
function getAllChores() {
    global $con;

    // Check if the connection object is valid
    if ($con) {
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
        } else {
            // Handle query execution error
            echo "Error executing query: " . $con->error;
        }

        // Return the result
        return $result;
    } else {
        // Handle database connection error
        echo "Error: Database connection failed.";
        return null;
    }
}
?>
