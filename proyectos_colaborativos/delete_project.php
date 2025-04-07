<?php
require_once __DIR__ . '/classes/User.php';
require_once __DIR__ . '/classes/Project.php';

if (!User::isLoggedIn()) {
    header("Location: index.php");
    exit;
}

$project = new Project();
if ($project->delete($_GET['project_id'])) {
    header("Location: dashboard.php");
} else {
    echo "Error al eliminar el proyecto.";
}
?>