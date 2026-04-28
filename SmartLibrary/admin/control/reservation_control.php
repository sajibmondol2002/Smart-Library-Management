<?php
session_start();
require_once '../model/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = trim($_POST['book_id']);
    $card_number = trim($_POST['card_number']);

    if (!empty($book_id) && !empty($card_number)) {
        $db = new myDB();
        $result = $db->reserveBook($book_id, $card_number);

        if ($result === true) {
            $_SESSION['success'] = "Reservation added successfully!";
            header("Location: ../view/welcome.php");
        } else {
            $_SESSION['error'] = "Failed to add reservation.";
        }
    } else {
        $_SESSION['error'] = "All fields are required.";
    }

    header("Location: ../view/reservation.php");
    exit();
} else {
    header("Location: ../view/reservation.php");
    exit();
}
