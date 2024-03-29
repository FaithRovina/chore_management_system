<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <title> Nyumba Safi - Registration</title>
  <link rel="stylesheet" href="../css/Registration.css">

  <!-- Include SweetAlert CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css" 
  integrity="sha512-17AHGe9uFHHt+QaRYieK7bTdMMHBMi8PeWG99Mf/xEcfBLDCn0Gze8Xcx1KoSZxDnv+KnCC+os/vuQ7jrF/nkw==" 
  crossorigin="anonymous" referrerpolicy="no-referrer" />

  <?php
  include("../functions/select_role_fxn.php");
  ?>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <div class="container">
    <div class="title">Registration</div>
    <div class="content">

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
          <input type="text" id="email" name="email" placeholder="Enter your email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" autocomplete="on"required>
        </div>
        <div class="input-box">
          <span class="details">Phone Number</span>
          <input type="text" id="phoneNumber" name="phoneNumber" placeholder="Enter your number" pattern="^(\+\d{1,3}\s?)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$" title="Phone number should be between 10 to 20 digits and can include spaces, brackets, plus, and dash" required>
        </div>

        <div class="input-box">
            <span class="details">Family Name</span>
            <select name="family_name" id="family_name" class="browser-default" required>
              <option value="">Select Family Name</option>
              <?php foreach ($family_name as $fam_name): ?>
              <option value="<?php echo $fam_name; ?>"><?php echo $fam_name; ?></option>
              <?php endforeach; ?>
            </select>

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
      return false;
    }

    // Ensure the dropdown has a selected value
    var selectedFamilyName = document.getElementById("family_name").value;
    if (selectedFamilyName === "") {
        alert("Please select a family name.");
        return false;
    }

    // validate phone number
    var phonePattern = /^(\+\d{1,3}\s?)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/;
    // Check if the phone number matches the pattern
    if (!phonePattern.test(phoneNumber)) {
      alert("Invalid phone number format.");
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
    if ($registration) {
        swal("Registration Successful!", "You can now login.", "success")
            .then((value) => {
                window.location.href = "../login/login_view.php";
            });
        return true;
    } else {
        return false;
    }

    return true; 
  }  
  
</script>
</body>
</html>

