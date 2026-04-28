<?php
session_start(); 

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require_once '../model/db.php'; 

$db = new myDB();
$books = $db->getBooks("");
$patrons = $db->getAllPatrons();
$loans = $db->getAllLoans();
$reservations = $db->getAllReservations();
$staffs = $db->getStafff();
$admins = $db->getAdmins();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/mystyle.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Dashboard</title>
</head>
<body>
<?php include 'header.php'; ?>

<div class="container">
    <h1 class="welcome-title">Welcome, <?php echo $_SESSION['user']['email']; ?></h1>

    <?php if (isset($_SESSION['success'])): ?>
        <p class="success-message"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
    <?php elseif (isset($_SESSION['error'])): ?>
        <p class="error-message"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>

    <nav>
        <ul>
            <li><a href="#book-section">Book Catalog</a></li>
            <li><a href="#patron-section">Borrower Accounts</a></li>
            <li><a href="#loan-section">Check-in/Check-out</a></li>
            <li><a href="#reservation-section">Reservations</a></li>
            <li><a href="#stafff-section">Library Staff</a></li>
            <li><a href="#admin-section">Admin Users</a></li>
        </ul>
    </nav>

       <h2 id="book-section" class="section-title">Book Catalog</h2>
<?php if ($books && $books->num_rows > 0): ?>
    <table class="user-table">
        <tr>
            <th>ISBN</th><th>Title</th><th>Author</th><th>Category</th><th>Shelf</th><th>Action</th>
        </tr>
        <?php while ($row = $books->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['isbn']) ?></td>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= htmlspecialchars($row['author']) ?></td>
                <td><?= htmlspecialchars($row['category']) ?></td>
                <td><?= htmlspecialchars($row['shelf_location']) ?></td>
                <td>
                    <a href="book_update.php?isbn=<?= urlencode($row['isbn']) ?>" class="edit-link">Edit</a> |
                    <a href="book_delete.php?isbn=<?= urlencode($row['isbn']) ?>" onclick="return confirm('Are you sure to delete?')" class="delete-link">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>No books found.</p>
<?php endif; ?>
<div class="add_new_message">
    <h3>Want to Add a New Book?</h3>
    <a href="book_add.php" class="action-link">Add Book</a>
</div>





    <h2 id="patron-section" class="section-title">Borrower Accounts</h2>
    <?php if ($patrons && $patrons->num_rows > 0): ?>
        <table class="user-table">
            <tr><th>Name</th><th>Email</th><th>Phone</th><th>Card Number</th></tr>
            <?php while ($row = $patrons->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['phone'] ?></td>
                    <td><?= $row['card_number'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No patrons found.</p>
    <?php endif; ?>

  
    <h2 id="loan-section" class="section-title">Current Loans</h2>
    <?php if ($loans && $loans->num_rows > 0): ?>
        <table class="user-table">
            <tr><th>Book ID</th><th>Card Number</th><th>Checkout</th><th>Due Date</th><th>Status</th></tr>
            <?php while ($row = $loans->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['book_id'] ?></td>
                    <td><?= $row['card_number'] ?></td>
                    <td><?= $row['checkout_date'] ?></td>
                    <td><?= $row['due_date'] ?></td>
                    <td><?= $row['status'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No current loans.</p>
    <?php endif; ?>


    <h2 id="reservation-section" class="section-title">Book Reservations</h2>
<?php if ($reservations && $reservations->num_rows > 0): ?>
    <table class="user-table">
        <tr>
            <th>Book ID</th>
            <th>Card Number</th>
            <th>Reserve Date</th>
        </tr>
        <?php while ($row = $reservations->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['book_id']) ?></td>
                <td><?= htmlspecialchars($row['card_number']) ?></td>
                <td><?= htmlspecialchars($row['reserve_date']) ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>No reservations found.</p>
<?php endif; ?>

<div class="add_new_message">
    <h3>Want to Add a New Reservation?</h3>
    <a href="reservation.php" class="action-link">Add Reservation</a>
</div>


    <h2 id="stafff-section" class="section-title">Library Stafff</h2>
    <?php if ($staffs && $staffs->num_rows > 0): ?>
        <table class="user-table">
            <tr><th>Name</th><th>Role</th><th>Email</th></tr>
            <?php while ($row = $staffs->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['role'] ?></td>
                    <td><?= $row['email'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No stafff found.</p>
    <?php endif; ?>
    <h2 id="stafff-section" class="section-title">Library Stafff</h2>

    
     <div class ="add_new_message">
    <a href="stafff_add.php" class="action-link"> Add New Stafff</a>
    <br><br></div>
    <td>




        <h2 id="admin-section" class="section-title">All Admin Users</h2>
        <?php
        if ($admins && $admins->num_rows > 0) {
            echo "<table class='user-table'>
                    <tr>
                        <th>Admin ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>";

            while ($row = $admins->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['id'] . "</td>
                        <td>" . $row['full_name'] . "</td>
                        <td>" . $row['email'] . "</td>
                        <td>
                            <a href='admin_update.php?id=" . $row['id'] . "' class='edit-link'>Edit</a>
                        </td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No admin users found.</p>";
        }
        ?>

    <br><br>
    <a href="logout.php" class="logout-link">Logout</a>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
