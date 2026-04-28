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
    <meta charset="UTF-8">
    <title>Add Stafff</title>
    <link rel="stylesheet" href="../css/mystyle.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="container">
    <h2>Add New Stafff Member</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <p class="error-message"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php elseif (isset($_SESSION['success'])): ?>
        <p class="success-message"><?= $_SESSION['success']; unset($_SESSION['success']); ?></p>
    <?php endif; ?>

    <form action="../control/stafff_add_control.php" method="POST">
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-group">
            <label>Password:</label>
            <input type="text" name="password" required>
        </div>

        <div class="form-group">
            <label>Role:</label>
            <input type="text" name="role" required>
        </div>

        <div class="form-group">
            <label>Permissions:</label>
            <input type="text" name="permissions" required>
        </div>

        <div class="form-group">
            <label>Status:</label>
            <select name="status" required>
                <option value="">Select</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <button type="submit">Add Stafff</button>
    </form>

    <br>
    <a href="welcome.php">Back to Dashboard</a>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
