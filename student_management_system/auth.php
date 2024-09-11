<?php
include 'db.php';

class Auth {
    private $connection;

    public function __construct() {
        $db = Database::getInstance();
        $this->connection = $db->connection;
        session_start(); // Start the session
    }

    public function login($username, $password) {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE username = ?");
        if (!$stmt) {
            die("Query failed: " . $this->connection->errno);
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $hashedPassword = $user['password'];

            if (password_verify($password, $hashedPassword)) {
                $_SESSION['username'] = $username;
                header("Location: dashboard.php");
                exit();
            } else {
                return "Sorry, password doesn't match";
            }
        } else {
            return "Sorry, you were not able to access it";
        }

        $stmt->close();
    }
}

// Usage
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $auth = new Auth();
    $message = $auth->login($username, $password);
    if ($message) {
        echo $message;
    }
}
?>
