<?php
session_start();
require_once '../model/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $isbn = $_POST['isbn'];
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $category = trim($_POST['category']);
    $shelf_location = trim($_POST['shelf_location']);

    if (!$isbn || !$title || !$author || !$category || !$shelf_location) {
        $_SESSION['error'] = "All fields required.";
        header("Location: ../view/book_update.php?isbn=$isbn");
        exit();
    }

    $db = new myDB();
    $conn = $db->openCon();
    $stmt = $conn->prepare("UPDATE books SET title=?, author=?, category=?, shelf_location=? WHERE isbn=?");
    $stmt->bind_param("sssss", $title, $author, $category, $shelf_location, $isbn);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Book updated successfully.";
    } else {
        $_SESSION['error'] = "Failed to update book.";
    }

    $stmt->close();
    $db->closeCon($conn);
    header("Location: ../view/welcome.php");
}
