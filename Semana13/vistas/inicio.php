<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Bienvenido a la Tienda Online</h1>
        <p>Encuentra los mejores productos al mejor precio</p>
        <a href="../controlador/index.php?accion=verProductos" class="btn btn-primary">Ver Productos</a>
        <a href="../controlador/index.php?accion=login" class="btn btn-primary">Iniciar sesion</a>
        <a href="../controlador/index.php?accion=registro" class="btn btn-primary">Registro</a>
        <a href="../controlador/index.php?accion=verCarrito" class="btn btn-primary">Ver Carrito</a>        
        <a href="../controlador/index.php?accion=finalizarCompra" class="btn btn-primary">Ver Carrito</a>
        <a href="../controlador/index.php?accion=verPerfil" class="btn btn-primary">Ver Perfil</a>
        <a href="../controlador/index.php?accion=cerrarSesion" class="btn btn-primary">Ver Perfil</a>
    </div>
    <!-- Scripts de Bootstrap y jQuery al final del body para mejorar rendimiento -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
