<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Add Book Reservation</title>
    <link rel="stylesheet" href="../css/mystyle.css" />
</head>
<body>
    <?php include 'header.php'; ?>

    <h2>Add New Reservation</h2>

    <?php
    if (isset($_SESSION['error'])) {
        echo "<p class='error-message'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
    ?>

    <form action="../control/reservation_control.php" method="POST">
        <div class="form-group">
            <label for="book_id">Book ID:</label>
            <input type="text" name="book_id" id="book_id" required>
        </div>

        <div class="form-group">
            <label for="card_number">Card Number:</label>
            <input type="text" name="card_number" id="card_number" required>
        </div>

        <button type="submit">Add Reservation</button>
    </form>

    <br>
    <a href="welcome.php">Back to Reservations</a>
    <?php include 'footer.php'; ?>

</body>
</html>
