<?php
require_once __DIR__ . '/classes/User.php';
require_once __DIR__ . '/classes/File.php';

if (!User::isLoggedIn()) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $fileManager = new File();
    try {
        if ($fileManager->upload($_GET['project_id'], $_FILES['file'])) {
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
    <title>Subir Archivo - Sistema de Proyectos Colaborativos</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Subir Archivo</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="file" required>
            <button type="submit">Subir</button>
        </form>
        <a href="dashboard.php">Volver</a>
    </div>
</body>
</html>