<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Finalizar Compra</h1>
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Resumen de la Compra</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Producto</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productosCarrito as $producto): ?>
                        <tr>
                            <td><?php echo $producto['nombre']; ?></td>
                            <td>$<?php echo $producto['precio']; ?></td>
                            <td><?php echo $producto['cantidad']; ?></td>
                            <td>$<?php echo $producto['subtotal']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <h5 class="card-title">Total a Pagar: $<?php echo $totalCompra; ?></h5>
                <a href="index.php?accion=confirmarCompra" class="btn btn-success">Confirmar Compra</a>
                <a href="index.php?accion=verCarrito" class="btn btn-primary">Volver al Carrito</a>
            </div>
        </div>
    </div>
    <!-- Scripts de Bootstrap y jQuery al final del body para mejorar rendimiento -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
