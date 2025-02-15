<?php
// Verificar si se han enviado los números a través del formulario
if (isset($_POST['numeros'])) {
    $numeros = $_POST['numeros'];

    // Convertir la cadena de números separados por comas en un array
    $lista_numeros = explode(',', $numeros);
    
    // Bucle que se ejecuta continuamente
    while (true) {
        // Variable para rastrear si se encontró un número no numérico
        $no_numerico = false;

        // Recorrer la lista de números
        foreach ($lista_numeros as $numero) {
            // Verificar si el número es numérico
            if (!is_numeric($numero)) {
                echo "<p>El valor '$numero' no es un número válido.</p>";
                $no_numerico = true;
                break; // Salir del bucle foreach si se encuentra un valor no numérico
            }

            // Verificar si el número está dentro del rango deseado (1-10)
            if ($numero < 1 || $numero > 10) {
                echo "<p>Número $numero inválido. Por favor, ingrese un número entre 1 y 10.</p>";
                echo "<a href='index.html'>Volver al formulario</a>";
                exit; // Salir del script si se encuentra un número inválido
            }
        }

        // Verificar si se encontró un valor no numérico
        if ($no_numerico) {
            echo "<p>Por favor, ingrese solo números válidos.</p>";
            echo "<a href='index.html'>Volver al formulario</a>";
            exit; // Salir del script si se encuentra un valor no numérico
        }

        echo "<p>¡Todos los números son válidos!</p>";
        break; // Salir del bucle while(true) si todos los números son válidos
    }
} else {
    echo "<p>No se han proporcionado números.</p>";
    echo "<a href='index.html'>Volver al formulario</a>";
}
?>
