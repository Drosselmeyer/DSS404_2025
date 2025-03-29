<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <!-- Incluir estilos de Materialize CSS -->
    <?php include('conexion.php'); ?>
</head>
<body>
    <!-- Barra de navegación -->
    <?php include('nav.php'); ?>

    <div class="container">
        <h2>Iniciar sesión</h2>
        <?php
        session_start(); // Iniciar la sesión
        require_once('conexion.php'); // Incluir el archivo de conexión

        if ($_SERVER["REQUEST_METHOD"] == "POST") { // Verificar si se envió el formulario
            $correo = $_POST['correo'];
            $contrasena = $_POST['contrasena'];

            // Consulta para verificar las credenciales del usuario
            //$sql = "SELECT id, nombre, tipo_usuario FROM usuarios WHERE correo = '$correo' AND contrasena = '$contrasena'";
            //$resultado = $conn->query($sql);

            /* Prepared statement*/
            $stmt = $conn->prepare("SELECT id, nombre, tipo_usuario FROM usuarios WHERE correo = ? AND contrasena = ?");

            $cor = $correo;
            $con = $contrasena;
            $stmt->bind_param("ss", $cor, $con); 
            
            $stmt->execute();
            $resultado = $stmt->get_result();
            
            if ($resultado->num_rows > 0) { // Si se encontró un usuario con las credenciales
                $usuario = $resultado->fetch_assoc();
                $_SESSION['usuario_id'] = $usuario['id']; // Almacenar el ID del usuario en la sesión
                $_SESSION['usuario_nombre'] = $usuario['nombre']; // Almacenar el nombre del usuario en la sesión
                $_SESSION['tipo_usuario'] = $usuario['tipo_usuario']; // Almacenar el tipo de usuario en la sesión
                header("Location: inicio.php"); // Redirigir al usuario a la página de inicio
            } else {
                $error = "Correo o contraseña incorrectos.";
            }
        }
        ?>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>

        <!-- Formulario de inicio de sesión -->
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="input-field">
                <input type="text" id="correo" name="correo" class="validate" required>
                <label for="correo">Correo electrónico</label>
            </div>
            <div class="input-field">
                <input type="text" id="contrasena" name="contrasena" class="validate" required>
                <label for="contrasena">Contraseña</label>
            </div>
            <button class="btn waves-effect waves-light" type="submit">Iniciar sesión</button>
        </form>
    </div>
</body>
</html>
