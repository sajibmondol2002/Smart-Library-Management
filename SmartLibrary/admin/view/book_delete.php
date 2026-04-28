<?php
session_start();
require_once '../model/db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$isbn = $_GET['isbn'] ?? '';
if (!$isbn) {
    $_SESSION['error'] = "No ISBN provided.";
    header("Location: welcome.php");
    exit();
}

$db = new myDB();
$conn = $db->openCon();
$stmt = $conn->prepare("DELETE FROM books WHERE isbn = ?");
$stmt->bind_param("s", $isbn);

if ($stmt->execute()) {
    $_SESSION['success'] = "Book deleted.";
} else {
    $_SESSION['error'] = "Delete failed.";
}

$stmt->close();
$db->closeCon($conn);
header("Location: welcome.php");
