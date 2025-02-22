<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo de Variables Locales y Estáticas en PHP</title>
    <!-- Enlace al archivo CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Ejemplo de Variables Locales y Estáticas en PHP</h1>
        
        <?php
        // Función que cuenta el número de veces que se llama a sí misma
        function contarLlamadas() {
            // Variable local para contar las llamadas
            $contador_local = 1; // Se inicializa a 1 ya que estamos en la primera llamada
            // Variable estática para mantener el conteo entre llamadas
            static $contador_estatico = 0;
            $contador_estatico++;
            echo "<p>Esta función ha sido llamada $contador_local vez(es) localmente.</p>";
            echo "<p>Esta función ha sido llamada $contador_estatico vez(es) estáticamente.</p>";
            $contador_local++; // Incrementamos el contador local
        }

        // Llamamos a la función varias veces
        contarLlamadas();
        contarLlamadas();
        contarLlamadas();
        contarLlamadas();
        contarLlamadas();
        ?>

    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>