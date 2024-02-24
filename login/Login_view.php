<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    

    <title>Nyumba Safi - Login</title>
</head>
<body>

    <div class="login-container">
        <h1>Login</h1>
        
        <form id="login-form" method="POST" action="../actions/login_user_action.php">
            <div class="input-container">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email">
            </div>

            <div class="input-container">           
                <label for="passwd">Password: </label>            
                <input type="passwd" id="passwd" name="passwd" placeholder="Enter your password">
            </div>
            <button type="submit" class="login-btn">Sign In</button>#
            <input type="hidden" name="login_btn" value="1">

        </form>
                
        <p class="forgot-password"><a href="../view/Password_reset.html">Forgot password?</a></p>

        <p class="sign-up-link">Need an account? <a href="../login/register_view.php">Sign up</a></p>
    </div>
</body>
</html>
