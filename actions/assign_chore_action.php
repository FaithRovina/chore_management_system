<?php
// Include necessary files for database connection and functions
require_once('../settings/connection.php');
require_once('../settings/core.php');

// Check if form submitted
if (isset($_POST['Assign'])) {
    // Collect form data and assign each to a variable
    $chorename = $_POST['chore'];
    $assignedToName = $_POST['assigned_to']; // Keep the assigned to name as it is for clarity
    $date_due = $_POST['date_due'];
    $assignedBy = $_SESSION['pid']; 

    // Debugging output for assigned-to name
    echo "Debug: Assigned-to Name: " . $assignedToName . "<br>";

    // Fetch the assigned-to person's ID based on their name
    $assignedToQuery = "SELECT pid FROM people WHERE fname = ?";
    $stmt_assigned_to = $con->prepare($assignedToQuery);
    $stmt_assigned_to->bind_param("s", $assignedToName);
    $stmt_assigned_to->execute();
    $assignedToResult = $stmt_assigned_to->get_result();

    if ($assignedToResult && $assignedToResult->num_rows > 0) {
        $row = $assignedToResult->fetch_assoc();
        $assignedToId = $row['pid'];

        // Prepare the statement to fetch chore ID based on chore name
        $choreQuery = "SELECT cid FROM chores WHERE chorename = ?";
        $stmt_chore = $con->prepare($choreQuery);
        $stmt_chore->bind_param("s", $chorename);
        $stmt_chore->execute();
        $choreResult = $stmt_chore->get_result();

        if ($choreResult && $choreResult->num_rows > 0) {
            $row = $choreResult->fetch_assoc();
            $cid = $row['cid'];

            // Prepare the statement to insert into database
            $sql = "INSERT INTO assignment (cid, sid, date_assign, date_due, last_updated, date_completed, img, who_assigned, assigned_to) 
                VALUES (?, 1, NOW(), ?, NOW(), NULL, NULL, ?, ?)";
            $stmt_insert = $con->prepare($sql);
            $stmt_insert->bind_param("iiss", $cid, $date_due, $assignedBy, $assignedToId);

            if ($stmt_insert->execute()) {
                // Fetch the newly assigned chore details
                $assignedChoreQuery = "SELECT * FROM assignment WHERE cid = ? ORDER BY date_assign DESC LIMIT 1";
                $stmt_assigned_chore = $con->prepare($assignedChoreQuery);
                $stmt_assigned_chore->bind_param("i", $cid);
                $stmt_assigned_chore->execute();
                $assignedChoreResult = $stmt_assigned_chore->get_result();

                if ($assignedChoreResult) {
                    // Fetch the assigned chore details
                    $assignedChore = $assignedChoreResult->fetch_assoc();

                    // Output the assigned chore details as JSON
                    echo json_encode($assignedChore);
                } else {
                    // If the query failed, return an error message
                    echo json_encode(array('error' => 'Failed to fetch assigned chore details.'));
                }
                // Close the prepared statement for fetching assigned chore details
                $stmt_assigned_chore->close();
            } else {
                // If the database insert failed, return an error message
                echo json_encode(array('error' => 'Failed to assign chore.'));
            }
            // Close the prepared statement for inserting data
            $stmt_insert->close();
        } else {
            // If chore name not found, return an error message
            echo json_encode(array('error' => 'Chore not found.'));
        }
        // Close the prepared statement for fetching chore ID
        $stmt_chore->close();
    } else {
        // If assigned-to name not found, return an error message
        echo json_encode(array('error' => 'Assigned-to person not found.'));
    }

    // Close the prepared statement for fetching assigned-to person's ID
    $stmt_assigned_to->close();

    // Close the database connection
    $con->close();
} else {
    // If the form was not submitted properly, return an error message
    echo json_encode(array('error' => 'Form submission failed.'));
}
?>
