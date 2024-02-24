<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <title> Nyumba Safi - Registration</title>
  <link rel="stylesheet" href="../css/Registration.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css" 
  integrity="sha512-17AHGe9uFHHt+QaRYieK7bTdMMHBMi8PeWG99Mf/xEcfBLDCn0Gze8Xcx1KoSZxDnv+KnCC+os/vuQ7jrF/nkw==" 
  crossorigin="anonymous" referrerpolicy="no-referrer" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <div class="container">
    <div class="title">Registration</div>
    <div class="content">

   <?php
   if(isset($_POST["register_button"])) { 
    $firstName = $_POST['firstName'];
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
            <input type="text" id="firstName" name="firstName" placeholder="Enter your first name" pattern="[A-Za-z ]+" required>
          </div>
          <div class="input-box">
            <span class="details">Last  Name</span>
            <input type="text" id="lastName" name="lastName" placeholder="Enter your last name" pattern="[A-Za-z ]+" required>
          </div>

          <div class="input-box">
            <span class="details">Gender</span>
            <div>
              <input type="radio" id="male" name="gender" value="male" required>
              <label for="male">Male</label>
            </div>
            <div>
              <input type="radio" id="female" name="gender" value="female" required>
              <label for="female">Female</label>
            </div>
          </div>


          <div class="input-box">
            <span class="details">Date of Birth</span>
            <input type="date" id="dob" name="dob" required>
          </div>

          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" id="email" name="email" placeholder="Enter your email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" id="phoneNumber" name="phoneNumber" placeholder="Enter your number" pattern="^(\+\d{1,3}\s?)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$" title="Phone number should be between 10 to 20 digits and can include spaces, brackets, plus, and dash" required>
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
      var firstName = document.getElementById("firstName").value;
      var lastName = document.getElementById("lastName").value;
      var email = document.getElementById("email").value;
      var phoneNumber = document.getElementById("phoneNumber").value;
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("confirmPassword").value;

      // Validate First Name and Last Name
      if (!/^[A-Za-z ]+$/.test(firstName) || !/^[A-Za-z ]+$/.test(lastName)) {
        alert("First name and last name cannot contain a number.");
        return false;
      }

      // Validate Email
      if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)) {
        alert("Invalid email format. Make sure it contains an @ symbol.");
        return false;
      }

      // Validate gender selection
      var maleChecked = document.getElementById("male").checked;
      var femaleChecked = document.getElementById("female").checked;
      if (!maleChecked && !femaleChecked) {
        alert("Please select a gender.");
        return false;
      }

      // Validate date of birth
      var dob = new Date(document.getElementById("dob").value);
      var currentDate = new Date();
      if (dob >= currentDate) {
        alert("Date of birth cannot be in the future.");
          eturn false;
        }
   
      // validate phone number
      var phonePattern = /^(\+\d{1,3}\s?)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/;
  
     // Check if the phone number matches the pattern
       if (phonePattern.test(phoneNumber)) {
        return true; // Valid phone number
      } else {
        return false; // Invalid phone number
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

    alert("Registration successful! You can now login.");
    window.location.href = "../login/login_view.php";

    <div class="error"><?php echo $registration_error; ?></div>
  </script>
</body>
</html>
