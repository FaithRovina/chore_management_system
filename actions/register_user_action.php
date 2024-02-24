<?php
// Include connection file
include '../settings/connection.php';

// Initialize variables
$registration_success = false;
$registration_error = '';

// Check if form submitted
if (isset($_POST['register_button'])) {
    // Collect form data and assign each to a variable
    $fname = $_POST['firstName']; 
    $lname = $_POST['lastName'];
    $email = $_POST['email'];
    $passwd = $_POST['password'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : "";  // Colllect selected gender
    $dob = $_POST['dob'];
    $tel = $_POST['phoneNumber'];

   // Convert gender to integer value
   $genderInt = ($gender == 'male') ? 1 : 0;


    // Encrypt the password 
    $hashed_password = password_hash($passwd, PASSWORD_DEFAULT);

    // Check if the connection object is valid
    if ($con) {
        // Prepare the SQL statement
        $query = "INSERT INTO people (fname, lname, email, passwd, rid, fid, gender, dob,tel) VALUES (?, ?, ?, ?, 3, ?, ?, ?,?)";
        $stmt = $con->prepare($query);

        if ($stmt) {
            // Bind parameters and execute the query
            $stmt->bind_param("ssssiiss", $fname, $lname, $email, $hashed_password, $fid, $genderInt, $dob,$tel);
            $fid = 1; // Assumed
            
            if ($stmt->execute()) {
                /// Set registration success message and redirect
                $registration_success = true;
                $redirect_url = "../login/login_view.php?registration_success=true"; 
                header("Location: $redirect_url");
                exit();
                }
                          
                
            } else {
                // Set registration error message
                $registration_error = "Registration failed. Please try again.";
            }
        } else {
            // Set registration error message
            $registration_error = "Error: Statement preparation failed.";
        }
    } else {
        // Set registration error message
        $registration_error = "Error: Database connection failed.";
    }
    
    // If form not submitted, redirect back to register_view page
    header("Location: ../login/register_view.php");
    exit();

