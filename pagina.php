<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}

// Función para destruir la sesión y redirigir al formulario de inicio de sesión
if (isset($_GET['cerrar_sesion'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Ropa</title>
    <link rel="stylesheet" href="Estilos/estilos.css">
</head>
<body>
    <header>
        <h1>Tienda de Ropa</h1>
        <nav>
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Productos</a></li>
                <li><a href="#">Contacto</a></li>
                <?php if(isset($username)) : ?>
                <li>Bienvenido, <?php echo $username; ?></li>
                <li class="cerrar-sesion"><a href="?cerrar_sesion">Cerrar Sesión</a></li>
                <?php else : ?>
                <li><a href="login.php">Iniciar Sesión</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Últimas novedades</h2>
            <div class="producto">
                <img src="imagen1.jpg" alt="Producto 1">
                <h3>Producto 1</h3>
                <p>Descripción del producto 1</p>
            </div>
            <div class="producto">
                <img src="imagen2.jpg" alt="Producto 2">
                <h3>Producto 2</h3>
                <p>Descripción del producto 2</p>
            </div>
        </section>

        <section>
            <h2>Ofertas especiales</h2>
            <div class="producto">
                <img src="imagen3.jpg" alt="Producto 3">
                <h3>Producto 3</h3>
                <p>Descripción del producto 3</p>
            </div>
            <div class="producto">
                <img src="imagen4.jpg" alt="Producto 4">
                <h3>Producto 4</h3>
                <p>Descripción del producto 4</p>
            </div>
        </section>
    </main>

    <footer>
        <p>Todos los derechos reservados &copy; 2024</p>
        
    </footer>
</body>
</html>

