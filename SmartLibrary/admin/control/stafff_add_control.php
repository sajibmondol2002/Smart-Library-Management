<?php
session_start();
require_once '../model/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);
    $permissions = trim($_POST['permissions']);
    $status = trim($_POST['status']);

    if (empty($name) || empty($email) || empty($password) || empty($role) || empty($permissions) || empty($status)) {
        $_SESSION['error'] = "All fields are required!";
        header("Location: ../view/stafff_add.php");
        exit();
    }

    $db = new myDB();
    $result = $db->insertStafff($name, $email, $password, $role, $permissions, $status);

    if ($result === true) {
        $_SESSION['success'] = "Staff member added successfully!";
        header("Location: ../view/welcome.php");
    } else {
        $_SESSION['error'] = "Error: " . $result;
        header("Location: ../view/stafff_add.php");
    }
} else {
    header("Location: ../view/stafff_add.php");
    exit();
}
