<?php
session_start();
require_once 'User.php';
//Creamos un nuevo usuario
$usern = new User();

// Function to validate user input
function validateInput($data) {
    // Remove leading and trailing whitespaces
    $data = trim($data);
    // Convert special characters to HTML entities to prevent XSS attacks
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username and password
    $username = validateInput($_POST['usuario']);
    $password = validateInput($_POST['contraseña']);

    // Query the database to fetch user data
    $user = $usern->loginUser($username, $password);

    // Verify user credentials
    if ($user && password_verify($password, $user['contrasenia'])) {
        // Set session variables
        $_SESSION['username'] = $username;
        // Redirect to dashboard
        header("Location: inicio.php");
        exit();
    } else {
        // Invalid username or password
        $error = "Usuario o contraseña incorrecta.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="Estilos/logines.css">
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <?php if (isset($error)) : ?>
            <p class="error-message"><?= $error ?></p>
        <?php endif; ?>
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="usuario" placeholder="Usuario" required><br>
            <input type="password" name="contraseña" placeholder="Contraseña" required><br>
            <input type="submit" value="Iniciar Sesión">
        </form>
        <p class="forgot-password">¿Olvidaste tu contraseña? <a href="#">Recupérala aquí</a>.</p>
        <button class="register-button" onclick="window.location.href = 'registrar.php';">Registrarse</button>
    </div>
</body>
</html>

