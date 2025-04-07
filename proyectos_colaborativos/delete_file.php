<?php
require_once __DIR__ . '/classes/User.php';
require_once __DIR__ . '/classes/File.php';

if (!User::isLoggedIn()) {
    header("Location: index.php");
    exit;
}

$fileManager = new File();
if ($fileManager->delete($_GET['file_id'])) {
    header("Location: dashboard.php");
} else {
    echo "Error al eliminar el archivo.";
}
?>