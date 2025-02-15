<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener la edad ingresada por el usuario
    $edad = $_POST["edad"];

    // Verificar la elegibilidad para votar
    if ($edad >= 18) {
        $mensaje = "¡Felicidades! Usted es elegible para votar.";
    } else {
        $mensaje = "Lo siento, usted no es elegible para votar todavía.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de la Verificación</title>
    <!-- Agregar el enlace al CDN de Bootstrap para estilos -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Resultado de la Verificación</h2>
        
        <?php if (isset($mensaje)): ?>
            <p class="alert alert-info"><?php echo $mensaje; ?></p>
        <?php endif; ?>
        
        <p><a href="index.html" class="btn btn-primary">Volver a la verificación</a></p>
    </div>

    <!-- Agregar el script de Bootstrap (jQuery y Popper.js son requeridos) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
