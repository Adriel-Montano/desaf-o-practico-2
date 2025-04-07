<?php
require_once __DIR__ . '/Database.php';

class Project {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function create($user_id, $title, $description) {
        $title = trim($title);
        if (!preg_match('/^[a-zA-Z0-9\s]{3,100}$/', $title)) {
            throw new Exception("El título del proyecto debe tener entre 3 y 100 caracteres alfanuméricos.");
        }

        $stmt = $this->db->getConnection()->prepare("INSERT INTO projects (user_id, title, description) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $title, $description);
        return $stmt->execute();
    }

    public function getProjects($user_id) {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM projects WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getProject($id) {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM projects WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function update($id, $title, $description) {
        $title = trim($title);
        if (!preg_match('/^[a-zA-Z0-9\s]{3,100}$/', $title)) {
            throw new Exception("El título del proyecto debe tener entre 3 y 100 caracteres alfanuméricos.");
        }

        $stmt = $this->db->getConnection()->prepare("UPDATE projects SET title = ?, description = ? WHERE id = ?");
        $stmt->bind_param("ssi", $title, $description, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->getConnection()->prepare("DELETE FROM projects WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>