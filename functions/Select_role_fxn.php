<?php
// Include connection file
include '../settings/connection.php';

// Initialize an empty array to store family names
$family_name = array();

// Check if the connection object is valid
if ($con) {
    // Prepare the SQL statement
    $query = "SELECT fam_name FROM family_name"; // Select only the fam_name column
    $result = $con->query($query);

    if ($result) {
        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Fetch all rows from the result set
            while ($row = $result->fetch_assoc()) {
                // Store family names in the array
                $family_name[] = $row['fam_name'];
            }

            // Close the result set
            $result->close();
        } else {
            echo "No family names found.";
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
