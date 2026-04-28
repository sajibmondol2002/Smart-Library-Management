<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/mystyle.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <script src="../js/forgot_password.js"></script> 
</head>
<body>
    <div class="container">
    <?php include 'header.php'; ?>
        <h1>Forgot Password</h1>

        
        <form action="../control/forgot_password_control.php" method="POST" onsubmit="return validateForgotPasswordForm()">
            <!-- Email -->
            <div class="form-group">
                <label for="email">Enter your email:</label>
                <input type="text" id="email" name="email" placeholder="Enter your registered email">
                <p id="email_error" class="error-message"></p> <
            </div>

            
            <button type="submit" class="btn">Submit</button>
        </form>

        
        <p>
            Remembered your password? <a href="login.php">Back to Login</a>.
        </p>
    </div>
    <script src="../js/forgot_password.js"></script>
    <?php include 'footer.php'; ?>
</body>
</html>
