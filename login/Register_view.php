<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <title> Nyumba Safi - Registration</title>
  <link rel="stylesheet" href="../css/Registration.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <div class="container">
    <div class="title">Registration</div>
    <div class="content">

   <?php
   if(isset($_POST["register_button"])) { 
    $fullName = $_POST['fullName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
   }
   ?>

    <form action="../actions/register_user_action.php" method="post" onsubmit="return validateForm()">
        <div class="user-details">
          <div class="input-box">
            <span class="details">First Name</span>
            <input type="text" id="fullName" name="fullName" placeholder="Enter your first name" pattern="[A-Za-z ]+" required>
          </div>
          <div class="input-box">
            <span class="details">Last  Name</span>
            <input type="text" id="lastName" name="lastName" placeholder="Enter your last name" pattern="[A-Za-z ]+" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" id="email" name="email" placeholder="Enter your email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" id="phoneNumber" name="phoneNumber" placeholder="Enter your number" pattern="[0-9]{10}" title="Phone number should contain exactly 10 digits" required>
          </div>
          <div class="input-box">
            <span class="details">Password</span>      
            <input type="password" id="password" name="password" placeholder="Enter your password" minlength="6" required>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" required>
          </div>
        </div>
        <div class="button">
          <input type="submit" name="register_button" value="Register">
        </div>
      </form>
      <?php if (!empty($registration_error)): ?>
        <div class="error"><?php echo $registration_error; ?></div>
      <?php endif; ?>
    </div>
  </div>

  <script>
    function validateForm() {
      var fullName = document.getElementById("fullName").value;
      var lastName = document.getElementById("lastName").value;
      var email = document.getElementById("email").value;
      var phoneNumber = document.getElementById("phoneNumber").value;
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("confirmPassword").value;

      // Validate First Name and Last Name
      if (!/^[A-Za-z ]+$/.test(fullName) || !/^[A-Za-z ]+$/.test(lastName)) {
        alert("First name and last name cannot contain a number.");
        return false;
      }

      // Validate Email
      if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)) {
        alert("Invalid email format. Make sure it contains an @ symbol.");
        return false;
      }

      // Validate Password Length
      if (password.length < 6) {
        alert("Password should be at least 6 characters long.");
        return false;
      }

      // Validate if Passwords Match
      if (password !== confirmPassword) {
        alert("Passwords do not match.");
        return false;
      }

      return true; 
    }  
  </script>
</body>
</html>
