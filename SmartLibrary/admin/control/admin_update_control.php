<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../view/login.php");
    exit();
}

require_once '../model/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adminId = isset($_POST['admin_id']) ? intval($_POST['admin_id']) : 0;
    $fullName = trim($_POST['full_name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phoneNumber = trim($_POST['phone_number']);
    $role = trim($_POST['role']);
    $address = trim($_POST['address']);
    $securityQuestion = trim($_POST['security_question']);
    $defaultLanguage = trim($_POST['default_language']);
    $timeZone = trim($_POST['time_zone']);

    if (
        empty($fullName) || empty($username) || empty($email) || empty($phoneNumber) ||
        empty($role) || empty($address) || empty($securityQuestion) ||
        empty($defaultLanguage) || empty($timeZone)
    ) {
        $_SESSION['error'] = "All fields are required!";
        header("Location: ../view/admin_update.php?id=" . $adminId);
        exit();
    }

    $db = new myDB();
    $connection = $db->openCon();

    $stmt = $connection->prepare("UPDATE admin SET full_name = ?, username = ?, email = ?, phone_number = ?, role = ?, address = ?, security_question = ?, default_language = ?, time_zone = ? WHERE id = ?");
    $stmt->bind_param("sssssssssi", $fullName, $username, $email, $phoneNumber, $role, $address, $securityQuestion, $defaultLanguage, $timeZone, $adminId);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Admin data updated successfully!";
        header("Location: ../view/welcome.php");
    } else {
        $_SESSION['error'] = "Error updating admin data!";
        header("Location: ../view/admin_update.php?id=" . $adminId);
    }

    $stmt->close();
    $db->closeCon($connection);
} else {
    header("Location: ../view/welcome.php");
    exit();
}
