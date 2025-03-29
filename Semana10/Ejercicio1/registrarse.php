<?php
session_start();

if (isset($_SESSION['usuario_id'])){
    header("Location: inicio.php");
    exit();
}

// Incluir el archivo de conexión
require_once('conexion.php');

// Procesar el formulario de creación de usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $tipo_usuario = $_POST['tipo_usuario'];

    $sql = "INSERT INTO usuarios (nombre, correo, contrasena, tipo_usuario) VALUES ('$nombre', '$correo', '$contrasena', '$tipo_usuario')";
    if ($conn->query($sql) === TRUE) {
        $mensaje = "Usuario creado exitosamente.";
    } else {
        $error = "Error al crear el usuario: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
    <!-- Incluir estilos de Materialize CSS -->
    <?php include('conexion.php'); ?>
</head>
<body>
    
    <?php include('nav.php'); ?>

    <div class="container">
        <h2>Bienvenido</h2> <!-- Saludo de bienvenida al usuario -->

        <!-- Formulario de creación de usuario -->
        <h3>Registrar Nuevo Usuario</h3>
        <?php if (isset($mensaje)) {
            echo "<p>$mensaje</p>";
            header( "refresh:5;url=inicio.php" );
        }  ?>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="input-field">
                <input type="text" id="nombre" name="nombre" class="validate" required>
                <label for="nombre">Nombre</label>
            </div>
            <div class="input-field">
                <input type="email" id="correo" name="correo" class="validate" required>
                <label for="correo">Correo electrónico</label>
            </div>
            <div class="input-field">
                <input type="password" id="contrasena" name="contrasena" class="validate" required>
                <label for="contrasena">Contraseña</label>
            </div>
            <div class="input-field">
                <input type="hidden" id="tipo_usuario" name="tipo_usuario" value="usuario">
            </input>
            </div>
            <button class="btn waves-effect waves-light" type="submit">Crear Usuario</button>
        </form>
    </div>
</body>
</html>
