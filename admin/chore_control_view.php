<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='../css/chore_control_view.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Chore Control</title>
</head>

<body>
    <h1>Chore Control</h1>

    <h2>Current Chores</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Chore Name</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Include the chore functions file
            require_once('../functions/chore_fxn.php');
            require_once('../actions/get_all_chores_action.php');

            // Fetch all chores
            $allChores = getAllChores();

            // Check if there are any chores
            if (!empty($allChores)) {
                // Display chores
                foreach ($allChores as $chore) {
                    echo "<tr>
                            <td>" . htmlspecialchars($chore['chorename']) . "</td>
                            <td>
                                <form action='../actions/delete_chore_action.php' method='post' style='display: inline;'>
                                    <input type='hidden' name='delete_id' value='" . $chore['cid'] . "'>
                                    <button type='submit' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this chore?\");'>Delete</button>
                                </form>
                                <button class='btn btn-primary' onclick='editChore(" . $chore['cid'] . ", \"" . htmlspecialchars($chore['chorename']) . "\")'>Edit</button>
                            </td>
                        </tr>";
                }
            } else {
                // No chores found
                echo "<tr><td colspan='2'>No chores found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Button to redirect to the dashboard -->
    <a href="../view/dashboard.html" class="btn btn-primary">Go to Dashboard</a>

    <!-- Modal for adding chore -->
    <div id="addChoreModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="toggleAddChoreModal()">&times;</span>
            <h2>Add Chore</h2>
            <form id="addChoreForm" action="../actions/add_chore_action.php" method="POST">
                <label for="chorename">Chore Name:</label>
                <input type="text" id="chorename" name="chorename" required>
                <input type="submit" class="btn btn-primary" value="Add Chore">
            </form>
        </div>
    </div>

    <!-- Modal for editing chore -->
    <div id="editChoreModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="toggleEditChoreModal()">&times;</span>
            <h2>Edit Chore</h2>
            <form id="editChoreForm" action="../actions/edit_chore_action.php" method="POST">
                <input type="hidden" id="edit_cid" name="edit_cid">
                <label for="edit_chorename">Chore Name:</label>
                <input type="text" id="edit_chorename" name="edit_chorename" required>
                <input type="submit" class="btn btn-primary" value="Save Changes">
            </form>
        </div>
    </div>

    <!-- Button to open modal -->
    <button class="btn btn-primary" onclick="toggleAddChoreModal()">Add Chore</button>


    <script>
        // JavaScript function to toggle visibility of the add chore modal
        function toggleAddChoreModal() {
            var modal = document.getElementById("addChoreModal");
            if (modal.style.display === "none" || modal.style.display === "") {
                modal.style.display = "block";
            } else {
                modal.style.display = "none";
            }
        }

        // JavaScript function to toggle visibility of the edit chore modal
        function toggleEditChoreModal() {
            var modal = document.getElementById("editChoreModal");
            if (modal.style.display === "none" || modal.style.display === "") {
                modal.style.display = "block";
            } else {
                modal.style.display = "none";
            }
        }

        // JavaScript function to populate edit chore form with chore details
        function editChore(cid, choreName) {
            var editChoreForm = document.getElementById("editChoreForm");
            var editChoreIdInput = document.getElementById("edit_cid");
            var editChoreNameInput = document.getElementById("edit_chorename");

            editChoreIdInput.value = cid;
            editChoreNameInput.value = choreName;

            toggleEditChoreModal();
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hp
