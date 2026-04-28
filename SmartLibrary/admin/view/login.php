<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/mystyle.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="../js/login.js"></script> 
</head>
<body>
<?php include 'header.php'; ?>
    <div class="container">
        <h1>Login</h1>

        
        <form action="../control/login_control.php" method="POST" onsubmit="return validateLoginForm()">
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email">
                <p id="email_error" class="error-message"></p> 
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
                <p id="password_error" class="error-message"></p> 
            </div>

           
            <div class="form-group">
                <label for="remember">
                    <input type="checkbox" id="remember" name="remember">
                    Remember Me
                </label>
            </div>

            
            <button type="submit" class="btnShape btnSubmit">Login</button>
        </form>

        
        <p>
            <a href="forgot_password.php">Forgot Password?</a>
        </p>
        <p>
            Don't have an account? <a href="signup.php">Register here</a>.
        </p>
    </div>
    <script src="../js/login.js"></script>
    <?php include 'footer.php'; ?>
</body>
</html>
