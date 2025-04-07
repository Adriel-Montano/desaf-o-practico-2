<?php
require_once __DIR__ . '/classes/User.php';
require_once __DIR__ . '/classes/Project.php';

if (!User::isLoggedIn()) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $project = new Project();
    try {
        if ($project->create(User::getUserId(), $_POST['title'], $_POST['description'])) {
            header("Location: dashboard.php");
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Crear Proyecto - Sistema de Proyectos Colaborativos</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Crear Proyecto</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <label>Título: <input type="text" name="title" required></label>
            <label>Descripción: <textarea name="description"></textarea></label>
            <button type="submit">Crear</button>
        </form>
        <a href="dashboard.php">Volver</a>
    </div>
</body>
</html>