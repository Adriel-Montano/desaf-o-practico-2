<?php
require_once __DIR__ . '/Database.php';

class User {
    private $db;
    private $id;
    private $username;
    private $email;

    public function __construct() {
        $this->db = new Database();
    }

    public function register($username, $email, $password) {
        $username = trim($username);
        $email = trim($email);
        $password = password_hash($password, PASSWORD_DEFAULT);

        if (!preg_match('/^[a-zA-Z0-9]{3,50}$/', $username)) {
            throw new Exception("El nombre de usuario debe tener entre 3 y 50 caracteres alfanuméricos.");
        }
        if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
            throw new Exception("Correo inválido.");
        }

        $stmt = $this->db->getConnection()->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        return $stmt->execute();
    }

    public function login($username, $password) {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if ($result && password_verify($password, $result['password'])) {
            session_start();
            $_SESSION['user_id'] = $result['id'];
            $_SESSION['username'] = $result['username'];
            return true;
        }
        return false;
    }

    public static function isLoggedIn() {
        session_start();
        return isset($_SESSION['user_id']);
    }

    public static function getUserId() {
        return $_SESSION['user_id'];
    }
}
?>