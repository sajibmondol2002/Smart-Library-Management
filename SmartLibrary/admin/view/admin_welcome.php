<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Home</title>
    <link rel="stylesheet" href="../css/mystyle.css"> 
</head>

<body>
<?php include 'header.php'; ?>

<center>
    <div class="image-container">
        <img src="library.png" alt="Library Image" class="library-img" height="300" width="300">
    </div>

    <div class="main-content">
        <div class="text-content">
            <h1>Welcome to Our Library</h1>
            <h3>Your gateway to thousands of books, journals, and more.</h3>
            <h2>Sign in or create an account to borrow books, track due dates, and enjoy seamless digital services.</h2>

            <form method="POST" action="../view/login.php">
                <button type="submit" name="login" class="button">Login Here</button>
            </form>

            <p class="black">
                Don't have an account? <a href="signup.php">Sign up here</a></p>
        </div>
    </div>
</center>
<br>

<?php include 'footer.php'; ?>
</body>
</html>
