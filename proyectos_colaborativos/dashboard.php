<?php
require_once __DIR__ . '/classes/User.php';
require_once __DIR__ . '/classes/Project.php';
require_once __DIR__ . '/classes/File.php';

if (!User::isLoggedIn()) {
    header("Location: index.php");
    exit;
}

$project = new Project();
$projects = $project->getProjects(User::getUserId());
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Sistema de Proyectos Colaborativos</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Bienvenido, <?php echo $_SESSION['username']; ?></h2>
        <a href="logout.php" class="logout">Cerrar sesión</a>
        <h3>Mis Proyectos</h3>
        <a href="create_project.php">Crear nuevo proyecto</a>
        <?php foreach ($projects as $p): ?>
            <div class="project">
                <h4><?php echo $p['title']; ?></h4>
                <p><?php echo $p['description']; ?></p>
                <div class="project-actions">
                    <a href="edit_project.php?project_id=<?php echo $p['id']; ?>">Editar</a> |
                    <a href="delete_project.php?project_id=<?php echo $p['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar este proyecto?');">Eliminar</a> |
                    <a href="upload_file.php?project_id=<?php echo $p['id']; ?>">Subir archivo</a>
                </div>
                <?php
                $fileManager = new File();
                $files = $fileManager->getFiles($p['id']);
                foreach ($files as $f): ?>
                    <div class="file">
                        <span><?php echo $f['file_name']; ?> (<?php echo $f['file_type']; ?>)</span>
                        <a href="delete_file.php?file_id=<?php echo $f['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar este archivo?');">Eliminar</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>