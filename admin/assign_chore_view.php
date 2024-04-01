<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='../css/chore_control_view.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Assign Chore</title>

    <?
    include ('../settings/core.php');
    ?>
</head>


<body>
    <h1>Assign Chore</h1>

    <!-- Button to open assign chore form -->
    <button class="btn btn-primary" onclick="toggleAssignChoreForm()">Assign Chore</button>

    <h2>Assigned Chores</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Chore Name</th>
                <th scope="col">Assigned By</th>
                <th scope="col">Date Assigned</th>
                <th scope="col">Date Due</th>
                <th scope="col">Chore Status</th>
                <th scope="col">Assigned</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Populate with assigned chores from database -->
            <?php
            // Include the function file to get all assignments
           include '../functions/select_assignee_and_chore_fxn.php';
           include '../settings/core.php';
                       
            // Check if there are any assigned chores
            if (!empty($assignedChores)) {
                // Loop through assigned chores and display them
                foreach ($assignedChores as $assignedChore) {
                    echo "<tr>
                            <td>" . htmlspecialchars($assignedChore['chore_name']) . "</td>
                            <td>" . htmlspecialchars($assignedChore['assigned_by']) . "</td>
                            <td>" . htmlspecialchars($assignedChore['date_assigned']) . "</td>
                            <td>" . htmlspecialchars($assignedChore['due_date']) . "</td>
                            <td>" . htmlspecialchars($assignedChore['chore_status']) . "</td>
                            <td>" . htmlspecialchars($assignedChore['assigned_to']) . "</td>
                            <td>
                                <!-- Add action icons/buttons here -->
                                <!-- For example, edit and delete -->
                                <button class='btn btn-primary' onclick='editChore(" . $assignedChore['chore_id'] . ")'>Edit</button>
                                <button class='btn btn-danger' onclick='deleteChore(" . $assignedChore['chore_id'] . ")'>Delete</button>
                            </td>
                        </tr>";
                }
            } else {
                // If no assigned chores found
                echo "<tr><td colspan='7'>No assigned chores found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Assign Chore Form -->
    <div id="assignChoreFormDiv" style="display: none;">
    <h2>Assign Chore</h2>
    <form id="assignChoreForm" action="../actions/assign_chore_action.php" method="POST">
        <label for="assigned_to">Assign To:</label>
        <select id="assigned_to" name="assigned_to" required>
            <option value="">Select Assignee</option>
            <?php foreach ($assignees as $assignee): ?>
                <option value="<?php echo $assignee; ?>"><?php echo $assignee; ?></option>
            <?php endforeach; ?>
        </select>  
              
        <label for="chore">Chore:</label>
        <select id="chore" name="chore" required>
            <option value="">Select Chore</option>
            <?php foreach ($chores as $chore): ?>
                <option value="<?php echo $chore; ?>"><?php echo $chore; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="due_date">Due Date:</label>
        <input type="date" id="date_due" name="date_due" required>
        <button type="submit" class="btn btn-primary" name="Assign">Assign</button>
    </form>
</div>

    <script>
        // JavaScript function to toggle visibility of the assign chore form
        function toggleAssignChoreForm() {
            var formDiv = document.getElementById("assignChoreFormDiv");
            if (formDiv.style.display === "none" || formDiv.style.display === "") {
                formDiv.style.display = "block";
            } else {
                formDiv.style.display = "none";
            }
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>
    
