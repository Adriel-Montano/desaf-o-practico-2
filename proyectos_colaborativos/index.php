<?php
require_once __DIR__ . '/classes/User.php';

if (User::isLoggedIn()) {
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    if ($user->login($_POST['username'], $_POST['password'])) {
        header("Location: dashboard.php");
    } else {
        $error = "Credenciales inválidas.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Sistema de Proyectos Colaborativos</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container login-container">
        <h2>Login</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <label>Usuario: <input type="text" name="username" required></label>
            <label>Contraseña: <input type="password" name="password" required></label>
            <button type="submit">Iniciar sesión</button>
        </form>
        <a href="register.php">Registrarse</a>
    </div>
</body>
</html>