<?php
session_start();
require_once '../model/db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$isbn = $_GET['isbn'] ?? '';
if (!$isbn) {
    $_SESSION['error'] = "Invalid ISBN.";
    header("Location: welcome.php");
    exit();
}

$db = new myDB();
$conn = $db->openCon();
$stmt = $conn->prepare("SELECT * FROM books WHERE isbn = ?");
$stmt->bind_param("s", $isbn);
$stmt->execute();
$book = $stmt->get_result()->fetch_assoc();
$stmt->close();
$db->closeCon($conn);

if (!$book) {
    $_SESSION['error'] = "Book not found.";
    header("Location: welcome.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>
    <link rel="stylesheet" href="../css/mystyle.css">
</head>
<body>
<?php include 'header.php'; ?>
<h2>Edit Book</h2>
<form action="../control/book_update_control.php" method="POST">
    <input type="hidden" name="isbn" value="<?= htmlspecialchars($book['isbn']) ?>">
    <label>Title: <input type="text" name="title" value="<?= htmlspecialchars($book['title']) ?>" required></label><br>
    <label>Author: <input type="text" name="author" value="<?= htmlspecialchars($book['author']) ?>" required></label><br>
    <label>Category: <input type="text" name="category" value="<?= htmlspecialchars($book['category']) ?>" required></label><br>
    <label>Shelf: <input type="text" name="shelf_location" value="<?= htmlspecialchars($book['shelf_location']) ?>" required></label><br>
    <button type="submit">Update Book</button>
</form>
<a href="welcome.php">Back to Dashboard</a>
<?php include 'footer.php'; ?>
</body>
</html>
