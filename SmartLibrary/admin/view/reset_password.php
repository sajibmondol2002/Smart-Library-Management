<?php
session_start();
require '../model/db.php';

if (!isset($_GET['token'])) {
    echo "Invalid or expired token.";
    exit();
}

$token = $_GET['token'];
$db = new myDB();
$conn = $db->openCon();

// টোকেন চেক করি
$stmt = $conn->prepare("SELECT * FROM admin WHERE reset_token = ?");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows === 1) {
    $user = $result->fetch_assoc();
} else {
    echo "Invalid or expired token.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        echo "<p style='color:red;'>Passwords do not match.</p>";
    } elseif (strlen($new_password) < 6) {
        echo "<p style='color:red;'>Password must be at least 6 characters.</p>";
    } else {
        $stmt = $conn->prepare("UPDATE admin SET password = ?, reset_token = NULL WHERE id = ?");
        $stmt->bind_param("si", $new_password, $user['id']);  // ❗ হ্যাশ ব্যবহার না করলে সরাসরি $new_password
        $stmt->execute();
        echo "<p style='color:green;'>Password reset successful. <a href='login.php'>Login Now</a></p>";
    }
}
?>

<h2>Reset Your Password</h2>
<form method="POST">
    <label>New Password:</label><br>
    <input type="password" name="new_password" required><br><br>
    <label>Confirm Password:</label><br>
    <input type="password" name="confirm_password" required><br><br>
    <input type="submit" value="Reset Password">
</form>
