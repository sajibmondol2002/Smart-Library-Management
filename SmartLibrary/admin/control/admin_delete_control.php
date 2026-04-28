<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../view/login.php");
    exit();
}

require_once '../model/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['admin_id'])) {
    $adminId = intval($_POST['admin_id']);

    if ($adminId > 0) {
        $db = new myDB();
        $connection = $db->openCon();

        $stmt = $connection->prepare("DELETE FROM admin WHERE id = ?");
        $stmt->bind_param("i", $adminId);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Admin deleted successfully!";
        } else {
            $_SESSION['error'] = "Failed to delete admin!";
        }

        $stmt->close();
        $db->closeCon($connection);
    } else {
        $_SESSION['error'] = "Invalid admin ID!";
    }

    header("Location: ../view/welcome.php");
    exit();
} else {
    $_SESSION['error'] = "Invalid request!";
    header("Location: ../view/welcome.php");
    exit();
}
