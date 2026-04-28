<?php
session_start();
require '../model/db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $errors = [];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }

    if (empty($errors)) {
        $db = new myDB();
        $connection = $db->openCon();

        $username_or_email = $email;
        $stmt = $connection->prepare("SELECT * FROM admin WHERE email = ? OR username = ?");
        $stmt->bind_param("ss", $username_or_email, $username_or_email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Debugging output: Check what's being compared
            echo "<p>🔍 Input Password: " . htmlspecialchars($password) . "</p>";
            echo "<p>🔐 DB Password: " . htmlspecialchars($user['password']) . "</p>";

            if ($password === $user['password']) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'email' => $user['email']
                ];

                if (isset($_POST['remember'])) {
                    setcookie('user_email', $user['email'], time() + (86400 * 30), "/");
                }

                header("Location: ../view/welcome.php");
                exit();
            } else {
                $errors[] = "Invalid email or password.";
            }
        } else {
            $errors[] = "Invalid email or password. (No user found)";
        }

        $stmt->close();
        $db->closeCon($connection);
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
} else {
    header("Location: ../view/login.php");
    exit();
}
?>
