<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require_once '../model/db.php';

$adminId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($adminId > 0) {
    $db = new myDB();
    $connection = $db->openCon();

    $stmt = $connection->prepare("SELECT * FROM admin WHERE id = ?");
    $stmt->bind_param("i", $adminId);
    $stmt->execute();
    $result = $stmt->get_result();
    $adminData = $result->fetch_assoc();

    $stmt->close();
    $db->closeCon($connection);

    if (!$adminData) {
        header("Location: welcome.php");
        exit();
    }
} else {
    header("Location: welcome.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/mystyle.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Admin</title>
</head>
<body>
<?php include 'header.php'; ?>
<h1>Update Admin Data</h1>

<?php if (isset($_SESSION['success'])): ?>
    <p class="success-message"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
<?php elseif (isset($_SESSION['error'])): ?>
    <p class="error-message"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
<?php endif; ?>

<form action="../control/admin_update_control.php" method="POST">
    <input type="hidden" name="admin_id" value="<?= $adminData['id'] ?>">

    <label>Full Name: <input type="text" name="full_name" value="<?= htmlspecialchars($adminData['full_name']) ?>"></label><br>
    <label>Username: <input type="text" name="username" value="<?= htmlspecialchars($adminData['username']) ?>"></label><br>
    <label>Email: <input type="text" name="email" value="<?= htmlspecialchars($adminData['email']) ?>"></label><br>
    <label>Phone Number: <input type="text" name="phone_number" value="<?= htmlspecialchars($adminData['phone_number']) ?>"></label><br>
    <label>Role: <input type="text" name="role" value="<?= htmlspecialchars($adminData['role']) ?>"></label><br>
    <label>Address: <input type="text" name="address" value="<?= htmlspecialchars($adminData['address']) ?>"></label><br>
    <label>Security Question: <input type="text" name="security_question" value="<?= htmlspecialchars($adminData['security_question']) ?>"></label><br>
    <label>Default Language: <input type="text" name="default_language" value="<?= htmlspecialchars($adminData['default_language']) ?>"></label><br>
    <label>Time Zone: <input type="text" name="time_zone" value="<?= htmlspecialchars($adminData['time_zone']) ?>"></label><br><br>

    <button type="submit">Update Admin</button>
</form>

<form action="../control/admin_delete_control.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this admin?');">
    <input type="hidden" name="admin_id" value="<?= $adminData['id'] ?>">
    <button type="submit" class="delete-button">Delete Admin</button>
</form>

<br><a href="welcome.php">⬅ Back to Welcome Page</a>
<?php include 'footer.php'; ?>
</body>
</html>
