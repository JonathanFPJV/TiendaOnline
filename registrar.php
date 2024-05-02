<?php
session_start();

// Database connection
$pdo = new PDO(
    'mysql:host=localhost;dbname=tiendaonline',
    'root',
    ''
);

// Función para validar y limpiar los datos del formulario
function validateInput($data) {
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y limpiar los datos del formulario
    $nombre = validateInput($_POST['nombre']);
    $apellido = validateInput($_POST['apellido']);
    $usuario = validateInput($_POST['usuario']);
    $correo = validateInput($_POST['correo']);
    $contrasena = password_hash($_POST['password'], PASSWORD_DEFAULT); // Cifrar la contraseña

    // Verificar si el usuario ya existe en la base de datos
    $stmt = $pdo->prepare("SELECT usuario FROM usuarios WHERE usuario = ?");
    $stmt->execute([$usuario]);
    $existingUser = $stmt->fetch();

    if($existingUser) {
        $error = "El nombre de usuario ya está en uso.";
    } else {
        // Insertar datos del usuario en la tabla usuarios
        $insertStmt = $pdo->prepare("INSERT INTO usuarios (nombre, apellido, usuario, correo, contrasenia) VALUES (?, ?, ?, ?, ?)");
        $insertStmt->execute([$nombre, $apellido, $usuario, $correo, $contrasena]);

        // Redirigir a otra página después del registro
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="Estilos/registrostilo.css">
</head>
<body>
    <div class="register-container">
        <h2>Registro de Usuario</h2>
        <?= isset($error) ? "<p class='error-message'>$error</p>" : "" ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="nombre" placeholder="Nombre" required><br>
            <input type="text" name="apellido" placeholder="Apellido" required><br>
            <input type="text" name="usuario" placeholder="Usuario" required><br>
            <input type="text" name="correo" placeholder="Correo" required><br>
            <input type="password" name="password" placeholder="Contraseña" required><br>
            <input type="submit" value="Registrar">
        </form>
        <button onclick="window.location.href='login.php'">Regresar al inicio</button>
    </div>
</body>
</html>


