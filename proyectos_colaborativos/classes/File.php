<?php
require_once __DIR__ . '/Database.php';

class File {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function upload($project_id, $file) {
        $uploadDir = 'uploads/';
        $fileName = basename($file['name']);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $filePath = $uploadDir . $project_id . '_' . time() . '_' . $fileName;

        // Validar tipo de archivo (solo PDF o imágenes)
        if (!in_array(strtolower($fileType), ['pdf', 'jpg', 'jpeg', 'png'])) {
            throw new Exception("Solo se permiten archivos PDF o imágenes (jpg, jpeg, png).");
        }

        if ($file['size'] > 5000000) { // Límite de 5MB
            throw new Exception("El archivo excede el tamaño máximo de 5MB.");
        }

        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            $stmt = $this->db->getConnection()->prepare("INSERT INTO files (project_id, file_name, file_type, file_path) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isss", $project_id, $fileName, $fileType, $filePath);
            return $stmt->execute();
        }
        return false;
    }

    public function delete($file_id) {
        $stmt = $this->db->getConnection()->prepare("SELECT file_path FROM files WHERE id = ?");
        $stmt->bind_param("i", $file_id);
        $stmt->execute();
        $file = $stmt->get_result()->fetch_assoc();

        if ($file && unlink($file['file_path'])) {
            $stmt = $this->db->getConnection()->prepare("DELETE FROM files WHERE id = ?");
            $stmt->bind_param("i", $file_id);
            return $stmt->execute();
        }
        return false;
    }

    public function getFiles($project_id) {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM files WHERE project_id = ?");
        $stmt->bind_param("i", $project_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
?>