<?php
session_start();
require_once '../model/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isbn = trim($_POST['isbn']);
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $category = trim($_POST['category']);
    $shelf = trim($_POST['shelf_location']);

    if (empty($isbn) || empty($title) || empty($author) || empty($category) || empty($shelf)) {
        $_SESSION['error'] = "All fields are required!";
    } else {
        $db = new myDB();
        $success = $db->insertBook($isbn, $title, $author, $category, $shelf);

        if ($success === true) {
            $_SESSION['success'] = "Book added successfully!";
            header("Location: welcome.php");
            exit();
        } else {
            $_SESSION['error'] = "Error adding book: " . $success;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/mystyle.css">
    <meta charset="UTF-8">
    <title>Add New Book</title>
</head>
<body>
<?php include 'header.php'; ?>

<div class="container">
    <h1>Add New Book</h1>

    <?php if (isset($_SESSION['success'])): ?>
        <p class="success-message"><?= $_SESSION['success']; unset($_SESSION['success']); ?></p>
    <?php elseif (isset($_SESSION['error'])): ?>
        <p class="error-message"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="isbn">ISBN:</label>
            <input type="text" name="isbn" id="isbn" required>
        </div>

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>
        </div>

        <div class="form-group">
            <label for="author">Author:</label>
            <input type="text" name="author" id="author" required>
        </div>

        <div class="form-group">
            <label for="category">Category:</label>
            <input type="text" name="category" id="category" required>
        </div>

        <div class="form-group">
            <label for="shelf_location">Shelf Location:</label>
            <input type="text" name="shelf_location" id="shelf_location" required>
        </div>

        <button type="submit">Add Book</button>
    </form>

    <br><a href="welcome.php">← Back to Dashboard</a>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
