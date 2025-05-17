<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Lista de Productos</h1>
        <div class="row">
            <?php foreach ($productos as $producto): ?>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img src="assets/img/producto.jpg" class="card-img-top" alt="Producto">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $producto->nombre; ?></h5>
                            <p class="card-text"><?php echo $producto->descripcion; ?></p>
                            <p class="card-text">Precio: $<?php echo $producto->precio; ?></p>
                            <form action="index.php?accion=agregarAlCarrito" method="POST">
                                <input type="hidden" name="producto_id" value="<?php echo $producto->id; ?>">
                                <label for="cantidad">Cantidad:</label>
                                <input type="number" id="cantidad" name="cantidad" min="1" value="1" required>
                                <button type="submit" class="btn btn-primary">Agregar al Carrito</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- Scripts de Bootstrap y jQuery al final del body para mejorar rendimiento -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
