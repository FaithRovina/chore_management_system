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
                                <a href='../admin/edit_chore_view.php?id=" . $chore['cid'] . "' class='btn btn-primary'>Edit</a>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>
