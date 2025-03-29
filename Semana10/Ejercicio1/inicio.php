<?php
session_start();

if (!isset($_SESSION['usuario_id'])) { // Verificar si el usuario no ha iniciado sesión
    header("Location: login.php"); // Redirigir al usuario al formulario de inicio de sesión
    exit(); // Finalizar el script para evitar que se siga ejecutando código innecesario
}

$usuario_nombre = $_SESSION['usuario_nombre']; // Obtener el nombre de usuario de la sesión
$tipo_usuario = $_SESSION['tipo_usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <!-- Incluir estilos de Materialize CSS -->
    <?php include('conexion.php'); ?>
</head>
<body>
    <!-- Barra de navegación -->
    <?php include('nav.php'); ?>
    
    <div class="container">
        <h2>Bienvenido, <?php echo $usuario_nombre; ?></h2> <!-- Saludo de bienvenida al usuario -->
    
    </div>
    
</body>
</html>
