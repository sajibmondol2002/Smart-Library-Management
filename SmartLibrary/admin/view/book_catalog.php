<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require_once '../model/db.php';

$bookData = null;

if (isset($_GET['isbn'])) {
    $isbn = $_GET['isbn'];
    $db = new myDB();
    $connection = $db->openCon();

    $stmt = $connection->prepare("SELECT * FROM books WHERE isbn = ?");
    $stmt->bind_param("s", $isbn);
    $stmt->execute();
    $result = $stmt->get_result();
    $bookData = $result->fetch_assoc();

    $stmt->close();
    $db->closeCon($connection);

    if (!$bookData) {
        $_SESSION['error'] = "Book not found.";
        header("Location: welcome.php");
        exit();
    }
} else {
    $_SESSION['error'] = "No book selected.";
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

<div class="container">
    <h2>Edit Book Information</h2>

    <?php if (isset($_SESSION['success'])): ?>
        <p class="success-message"><?= $_SESSION['success']; unset($_SESSION['success']); ?></p>
    <?php elseif (isset($_SESSION['error'])): ?>
        <p class="error-message"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>

    <form action="../control/book_update_control.php" method="POST">
        <input type="hidden" name="isbn" value="<?= htmlspecialchars($bookData['isbn']) ?>">

        <label>Title:</label>
        <input type="text" name="title" value="<?= htmlspecialchars($bookData['title']) ?>"><br>

        <label>Author:</label>
        <input type="text" name="author" value="<?= htmlspecialchars($bookData['author']) ?>"><br>

        <label>Category:</label>
        <input type="text" name="category" value="<?= htmlspecialchars($bookData['category']) ?>"><br>

        <label>Shelf Location:</label>
        <input type="text" name="shelf_location" value="<?= htmlspecialchars($bookData['shelf_location']) ?>"><br>

        <button type="submit">Update Book</button>
    </form>

    <br>
    <a href="welcome.php">Back to Dashboard</a>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
