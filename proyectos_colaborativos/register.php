<?php
require_once __DIR__ . '/classes/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    try {
        if ($user->register($_POST['username'], $_POST['email'], $_POST['password'])) {
            header("Location: index.php?success=Registro exitoso");
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registro - Sistema de Proyectos Colaborativos</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Registro</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <label>Usuario: <input type="text" name="username" required></label>
            <label>Correo: <input type="email" name="email" required></label>
            <label>Contraseña: <input type="password" name="password" required></label>
            <button type="submit">Registrar</button>
        </form>
        <a href="index.php">Volver al login</a>
    </div>
</body>
</html>