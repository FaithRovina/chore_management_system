<?php
// Include connection file
include '../settings/connection.php';

// Initialize an empty array to store chorenames
$chorename = array();

// Check if the connection object is valid
if ($con) {
    // Prepare the SQL statement
    $query = "SELECT * FROM chores"; 
    $result = $con->query($query);

    if ($result) {
        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Fetch all rows from the result 
            while ($row = $result->fetch_assoc()) {
                
                $chorename[] = $row['chorename'];
            }

            // Close the result set
            $result->close();
        } else {
            echo "No chores found.";
        }
    } else {
        echo "Error executing query: " . $con->error;
    }

    // Close the database connection
    $con->close();
} else {
    echo "Error: Database connection failed.";
}
?>
