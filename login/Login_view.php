<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">     
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css" integrity="sha512-17AHGe9uFHHt+QaRYieK7bTdMMHBMi8PeWG99Mf/xEcfBLDCn0Gze8Xcx1KoSZxDnv+KnCC+os/vuQ7jrF/nkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Nyumba Safi - Login</title>
    <script>
        window.onload = function() {
            // Check if there's an error message in the URL parameter
            const urlParams = new URLSearchParams(window.location.search);
            const error = urlParams.get('error');
            if (error) {
               
                alert(error);
            }
        };
    </script>
</head>
<body>

    <div class="login-container">
        <h1>Login</h1>
        
        <form action="../actions/login_user_action.php" method="post">
            <div class="input-container">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email">
            </div>

            <div class="input-container">           
                <label for="passwd">Password: </label>            
                <input type="password" id="passwd" name="passwd" placeholder="Enter your password">
            </div>
            
            <input type="submit" name="submit"  value="Login" class="form-btn">
            </form>
                
        <p class="forgot-password"><a href="../view/Password_reset.html">Forgot password?</a></p>

        <p class="sign-up-link">Need an account? <a href="../login/register_view.php">Sign up</a></p>
    </div>

    <script>
        document.getElementById("login-form").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent default form submission

            // Get form data
            var formData = new FormData(this);

            // Send form data via AJAX
            fetch("../actions/login_user_action.php", {
                method: "POST",
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.text(); // Return the response as text
            })
            .then(text => {
                try {
                    return JSON.parse(text); // Try to parse the response as JSON
                } catch (error) {
                    // If parsing fails, assume it's an error message
                    throw new Error("Invalid JSON response from server");
                }
            })
            .then(data => {
                // Check response and show appropriate SweetAlert
                if (data.success) {
                    // Redirect to home page or show success message
                    window.location.href = "../view/Dashboard.html";
                } else {
                    // Show error message based on response
                    swal("Error", data.message, "error");
                }
            })
            .catch(error => {
                // Show error message if AJAX request fails
                console.error("An error occurred:", error);
                swal("Error", "An error occurred. Please try again later.", "error");
            });
        });
    </script>
</body>
</html>