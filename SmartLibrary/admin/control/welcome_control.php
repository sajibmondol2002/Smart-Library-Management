<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../view/login.php");
    exit();
}

require_once '../model/db.php';

class WelcomeController {
    private $db;

    public function __construct() {
        $this->db = new myDB();
    }

    public function index() {
        
        $books = $this->db->getBooks("");
        $patrons = $this->db->getAllPatrons();
        $loans = $this->db->getAllLoans();
        $reservations = $this->db->getAllReservations();
        $staffs = $this->db->getStaff();
        $admins = $this->db->getAdmins();

        
        require_once '../view/welcome.php';
    }
}

$controller = new WelcomeController();
$controller->index();
