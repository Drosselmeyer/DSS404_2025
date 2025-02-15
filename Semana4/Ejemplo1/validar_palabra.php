<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Validando Palabra...</title>
</head>
<body>
    <h1>Validando Palabra...</h1>
    
    <?php
    // Función para validar si una palabra contiene algún número
    function validarPalabra($palabra) {
        $longitud = strlen($palabra);
        $ultimo_char = ($longitud-1);
        echo "<p>La palabra termina con la letra \"$palabra[$ultimo_char]\"</p>";
        $i = 0;
        while ($i < $longitud) {
            
            if (is_numeric($palabra[$i])) {
                return true; // Si se encuentra un número, se devuelve true
            }
            $i++;
        }
        return false; // Si no se encuentra ningún número, se devuelve false
    }

    // Verificar si se ha enviado una palabra a través del formulario
    if (isset($_POST['palabra'])) {
        $palabra = $_POST['palabra'];
        
        // Validar la palabra
        if (validarPalabra($palabra)) {
            echo "La palabra \"$palabra\" contiene al menos un número.</p>";
        } else {
            echo "<p>La palabra \"$palabra\" no contiene ningún número.</p>";
        }
    } else {
        // Mostrar un mensaje de error si no se ha enviado una palabra
        echo "<p>No se ha enviado ninguna palabra.</p>";
    }
    ?>
</body>
</html>
