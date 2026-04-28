<?php

class myDB {
    private $connectionObject;

    public function openCon() {
        $DBHost = "localhost";
        $DBUser = "root";
        $DBPassword = "";
        $DBName = "smartlibrarymanagement";

        $this->connectionObject = new mysqli($DBHost, $DBUser, $DBPassword, $DBName);

        if ($this->connectionObject->connect_error) {
            die("Connection failed: " . $this->connectionObject->connect_error);
        }

        return $this->connectionObject;
    }

    public function closeCon($connectionObject) {
        $connectionObject->close();
    }

    // BOOKS
    public function getBooks($searchTerm) {
        $connection = $this->openCon();
        $stmt = $connection->prepare("SELECT * FROM books WHERE title LIKE CONCAT('%', ?, '%') OR author LIKE CONCAT('%', ?, '%')");
        $stmt->bind_param("ss", $searchTerm, $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->closeCon($connection);
        return $result;
    }

    public function insertBook($isbn, $title, $author, $category, $shelf_location) {
        return $this->insertData(
            'books',
            ['isbn', 'title', 'author', 'category', 'shelf_location'],
            [$isbn, $title, $author, $category, $shelf_location]
        );
    }

    // PATRONS
    public function registerPatron($name, $email, $phone, $card_number, $guardian_id = null) {
        return $this->insertData(
            'patrons',
            ['name', 'email', 'phone', 'card_number', 'guardian_id'],
            [$name, $email, $phone, $card_number, $guardian_id]
        );
    }

    public function getPatronLoans($card_number) {
        $connection = $this->openCon();
        $stmt = $connection->prepare("SELECT * FROM loans WHERE card_number = ?");
        $stmt->bind_param("s", $card_number);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->closeCon($connection);
        return $result;
    }

    public function getAllPatrons() {
        $connection = $this->openCon();
        $query = "SELECT * FROM patrons";
        $result = $connection->query($query);
        $this->closeCon($connection);
        return $result;
    }

    // LOANS (Check-in / Check-out)
    public function checkoutBook($book_id, $card_number, $due_date) {
        return $this->insertData(
            'loans',
            ['book_id', 'card_number', 'checkout_date', 'due_date', 'status'],
            [$book_id, $card_number, date("Y-m-d"), $due_date, 'borrowed']
        );
    }

    public function returnBook($loan_id) {
        $connection = $this->openCon();
        $stmt = $connection->prepare("UPDATE loans SET return_date = ?, status = 'returned' WHERE id = ?");
        $date = date("Y-m-d");
        $stmt->bind_param("si", $date, $loan_id);
        $stmt->execute();
        $success = $stmt->affected_rows > 0;
        $stmt->close();
        $this->closeCon($connection);
        return $success;
    }

    public function getAllLoans() {
        $connection = $this->openCon();
        $query = "SELECT * FROM loans";
        $result = $connection->query($query);
        $this->closeCon($connection);
        return $result;
    }

    // FINES
    public function calculateFine($loan_id, $ratePerDay = 0.25) {
        $connection = $this->openCon();
        $stmt = $connection->prepare("SELECT DATEDIFF(NOW(), due_date) AS overdue_days FROM loans WHERE id = ? AND status = 'borrowed'");
        $stmt->bind_param("i", $loan_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        $fine = 0;
        if ($result && $result['overdue_days'] > 0) {
            $fine = min($result['overdue_days'] * $ratePerDay, 10.00);
        }

        $this->closeCon($connection);
        return $fine;
    }

    // RESERVATIONS
    public function getAllReservations() {
    $connection = $this->openCon();
    $query = "SELECT * FROM reservations";
    $result = $connection->query($query);
    $this->closeCon($connection);
    return $result;
}

public function reserveBook($book_id, $card_number) {
    return $this->insertData(
        'reservations',
        ['book_id', 'card_number', 'reserve_date'],
        [$book_id, $card_number, date("Y-m-d")]
    );
}

    // DONATIONS
    public function logDonation($donor_name, $book_title, $condition, $decision) {
        return $this->insertData(
            'donations',
            ['donor_name', 'book_title', 'condition', 'decision', 'donation_date'],
            [$donor_name, $book_title, $condition, $decision, date("Y-m-d")]
        );
    }

    // STAFF
    public function getStafff() {
        $connection = $this->openCon();
        $query = "SELECT * FROM stafff";
        $result = $connection->query($query);
        $this->closeCon($connection);
        return $result;
    }

        public function insertStafff($name, $email, $password, $role, $permissions, $status) {
         return $this->insertData(
        'stafff',
        ['name', 'email', 'password', 'role', 'permissions', 'status'],
        [$name, $email, $password, $role, $permissions, $status]
    );
}


    // ADMIN
    public function insertAdminData($full_name, $username, $email, $password, $phone_number, $role, $employee_id, $address, $security_question, $profile_picture, $default_language, $time_zone) {
        return $this->insertData(
            'admin',
            ['full_name', 'username', 'email', 'password', 'phone_number', 'role', 'employee_id', 'address', 'security_question', 'profile_picture', 'default_language', 'time_zone'],
            [$full_name, $username, $email, $password, $phone_number, $role, $employee_id, $address, $security_question, $profile_picture, $default_language, $time_zone]
        );
    }

    public function getAdmins() {
        $connection = $this->openCon();
        $query = "SELECT * FROM admin";
        $result = $connection->query($query);
        $this->closeCon($connection);
        return $result;
    }

    // GENERIC INSERT FUNCTION
    private function insertData($table, $columns, $values) {
        $connection = $this->openCon();
        $placeholders = implode(", ", array_fill(0, count($values), "?"));
        $columnsString = implode(", ", $columns);

        $stmt = $connection->prepare("INSERT INTO $table ($columnsString) VALUES ($placeholders)");
        if (!$stmt) {
            die("Error preparing statement: " . $connection->error);
        }

        $types = str_repeat("s", count($values)); // assuming all strings
        $stmt->bind_param($types, ...$values);
        $result = $stmt->execute() ? true : "Error: " . $stmt->error;

        $stmt->close();
        $this->closeCon($connection);
        return $result;
    }
}
?>
