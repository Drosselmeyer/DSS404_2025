<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usuario'] !== 'administrador') {
    header("Location: inicio.php");
    exit();
}

$usuario_nombre = $_SESSION['usuario_nombre'];
$tipo_usuario = $_SESSION['tipo_usuario'];

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

// Consulta para obtener todos los usuarios
$sql_usuarios = "SELECT id, nombre, correo, tipo_usuario FROM usuarios";
$resultado_usuarios = $conn->query($sql_usuarios);
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
        <h2>Bienvenido, <?php echo $usuario_nombre; ?></h2> <!-- Saludo de bienvenida al usuario -->

        <!-- Formulario de creación de usuario -->
        <h3>Crear Nuevo Usuario</h3>
        <?php if (isset($mensaje)) echo "<p>$mensaje</p>"; ?>
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
            <div class="form-group">
                <div class="ms-select"> 
                <select class="form-control" id="tipo_usuario" name="tipo_usuario">
                    <option value="administrador">Administrador</option>
                    <option value="usuario">Usuario</option>
                </select>
                <label class="floating-label"for="tipo_usuario">Tipo de usuario</label>
                </div>
            </div>
            <button class="btn waves-effect waves-light" type="submit">Crear Usuario</button>
        </form>

        <!-- Lista de usuarios -->
        <h3>Lista de Usuarios</h3>
        <table class="striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th>Tipo de Usuario</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultado_usuarios->num_rows > 0) {
                    while ($row = $resultado_usuarios->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['nombre'] . "</td>";
                        echo "<td>" . $row['correo'] . "</td>";
                        echo "<td>" . $row['tipo_usuario'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No hay usuarios registrados.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
