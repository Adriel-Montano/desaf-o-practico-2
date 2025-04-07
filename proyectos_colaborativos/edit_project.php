<?php
require_once __DIR__ . '/classes/User.php';
require_once __DIR__ . '/classes/Project.php';

if (!User::isLoggedIn()) {
    header("Location: index.php");
    exit;
}

$project = new Project();
$projectData = $project->getProject($_GET['project_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if ($project->update($_GET['project_id'], $_POST['title'], $_POST['description'])) {
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
    <title>Editar Proyecto - Sistema de Proyectos Colaborativos</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Editar Proyecto</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <label>Título: <input type="text" name="title" value="<?php echo $projectData['title']; ?>" required></label>
            <label>Descripción: <textarea name="description"><?php echo $projectData['description']; ?></textarea></label>
            <button type="submit">Actualizar</button>
        </form>
        <a href="dashboard.php">Volver</a>
    </div>
</body>
</html>