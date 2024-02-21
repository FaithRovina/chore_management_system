<?php
header('Location: login/login_view.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nyumba Safi - Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Nyuma Safi Family Chore Tracker!</h1>
        <h2>About Us:</h2>
        <p>NyumbaSafi is a user-friendly chore management platform designed to streamline household tasks for your family. Say goodbye to sticky notes and confusing schedules – with our intuitive interface, coordinating chores has never been easier.</p>
        <h2>Key Features:</h2>
        <ol>
            <li>Customizable Chore Lists</li>
            <li>Interactive Calendar</li>
            <li>Reward System</li>
            <li>Messaging Board</li>
            <li>Progress Tracking</li>
        </ol>
        <h2>Get Started:</h2>
        <p><a href="login_view.php" class="btn">Login</a> or <a href="../login/register_view.php" class="btn">Sign Up</a> to get started with FamilyChoreTracker!</p>
    </div>
</body>
</html>
