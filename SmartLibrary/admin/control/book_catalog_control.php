<?php
session_start();
require '../model/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isbn = $_POST['isbn'];
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $category = trim($_POST['category']);
    $shelf = trim($_POST['shelf_location']);

    if (empty($isbn) || empty($title) || empty($author) || empty($category) || empty($shelf)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: ../view/book_catalog.php?isbn=$isbn");
        exit();
    }

    $db = new myDB();
    $conn = $db->openCon();
    $stmt = $conn->prepare("UPDATE books SET title=?, author=?, category=?, shelf_location=? WHERE isbn=?");
    $stmt->bind_param("sssss", $title, $author, $category, $shelf, $isbn);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Book updated successfully.";
    } else {
        $_SESSION['error'] = "Error updating book.";
    }

    $stmt->close();
    $db->closeCon($conn);
    header("Location: ../view/book_catalog.php?isbn=$isbn");
    exit();
} else {
    header("Location: ../view/welcome.php");
    exit();
}
