<?php
session_start();
require '../model/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    $full_name = trim($_POST['full_name']);
    if (strlen($full_name) < 4) {
        $errors[] = "Full Name must be at least 4 characters.";
    }

    $username = trim($_POST['username']);
    if (strlen($username) < 4) {
        $errors[] = "Username must be at least 4 characters.";
    }

    $email = trim($_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    $phone_number = trim($_POST['phone_number']);
    if (!ctype_digit($phone_number) || strlen($phone_number) > 11) {
        $errors[] = "Phone number must be numeric and not longer than 11 digits.";
    }

    $password = trim($_POST['password']);
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    } elseif (!preg_match('/[@#$&]/', $password)) {
        $errors[] = "Password must contain at least one special character (@, #, $, &).";
    }

    $confirm_password = trim($_POST['confirm_password']);
    if ($confirm_password != $password) {
        $errors[] = "Passwords do not match.";
    }

    $role = trim($_POST['role']);
    if (empty($role)) {
        $errors[] = "Please select a role.";
    }

    $employee_id = trim($_POST['employee_id']);
    if (empty($employee_id)) {
        $errors[] = "Employee ID is required.";
    }

    $address = trim($_POST['address']);

    $security_question = trim($_POST['security_question']);
    if (empty($security_question)) {
        $errors[] = "Please select a security question.";
    }

    $profile_picture = $_FILES['profile_picture'];
    $profile_picture_path = "";
    if ($profile_picture['error'] == 0) {
        $upload_dir = "../uploads/profile_pictures/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $profile_picture_path = $upload_dir . basename($profile_picture['name']);
        if (!move_uploaded_file($profile_picture['tmp_name'], $profile_picture_path)) {
            $errors[] = "Failed to upload profile picture.";
        }
    } else {
        $errors[] = "Please upload a valid profile picture.";
    }

    $default_language = trim($_POST['default_language']);
    if (empty($default_language)) {
        $errors[] = "Please select a default language.";
    }

    $time_zone = trim($_POST['time_zone']);
    if (empty($time_zone)) {
        $errors[] = "Please select a time zone.";
    }

    if (empty($errors)) {
        
        $db = new myDB();

        $form_data = [
            "full_name" => $full_name,
            "username" => $username,
            "email" => $email,
            "phone_number" => $phone_number,
            "password" => $password, 
            "role" => $role,
            "employee_id" => $employee_id,
            "address" => $address,
            "security_question" => $security_question,
            "profile_picture" => $profile_picture_path,
            "default_language" => $default_language,
            "time_zone" => $time_zone
        ];

        // Save JSON (optional)
        $json_data = json_encode($form_data, JSON_PRETTY_PRINT);
        file_put_contents('../data/userdata.json', $json_data . PHP_EOL, FILE_APPEND);

        // Insert to DB
        $result = $db->insertAdminData(
            $full_name, $username, $email, $password, 
            $phone_number, $role, $employee_id, $address,
            $security_question, $profile_picture_path,
            $default_language, $time_zone
        );

        if ($result === true) {
            setcookie('user_email', $email, time() + (86400 * 30), "/");
            header("Location: ../view/login.php");
            exit();
        } else {
            $errors[] = "Error: Unable to save user data to the database.";
        }
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
}
?>
