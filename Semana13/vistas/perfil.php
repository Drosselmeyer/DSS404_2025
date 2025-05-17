<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Perfil de Usuario</h1>
        <div class="card mt-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Nombre: <?php echo $usuario->nombre; ?></h5>
                <p class="card-text">Correo electrónico: <?php echo $usuario->email; ?></p>
                <a href="index.php?accion=editarPerfil" class="btn btn-primary">Editar Perfil</a>
                <a href="index.php?accion=cambiarContrasena" class="btn btn-secondary">Cambiar Contraseña</a>
                <a href="index.php?accion=cerrarSesion" class="btn btn-danger">Cerrar Sesión</a>
            </div>
        </div>
    </div>
    <!-- Scripts de Bootstrap y jQuery al final del body para mejorar rendimiento -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
