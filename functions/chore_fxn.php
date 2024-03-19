<?php
// Include the get_all_chores_action.php file
require_once('../actions/get_all_chores_action.php');

// Function to generate table rows and elements for chores
function displayChores() {
    // Call the getAllChores() function to get all chores
    $chores = getAllChores();

    // Check if any chores are retrieved
    if (!empty($chores)) {
        // Loop through each chore and display table rows and elements
        foreach ($chores as $chore) {
            echo "<tr>
                    <td>" . htmlspecialchars($chore['chorename']) . "</td>
                    <td>
                        <a href='../actions/edit_chore_action.php'>Edit</a> | 
                        <a href='..actions/delete_chore-action.php'>Delete</a>
                    </td>
                </tr>";
        }
    } else {
        // Display a message if no chores are found
        echo "<tr><td colspan='2'>No chores found</td></tr>";
    }
}
?>

