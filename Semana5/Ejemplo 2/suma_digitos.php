<?php
// Función recursiva para calcular la suma de los dígitos de un número
function sumaDigitos($numero) {
    // Si el número tiene un solo dígito, devolvemos ese dígito
    if ($numero < 10) {
        return $numero;
    } else {
        // Obtenemos el último dígito
        $ultimo_digito = $numero % 10;
        // Sumamos el último dígito con la suma de los dígitos restantes
        return $ultimo_digito + sumaDigitos(intval($numero / 10));
    }
}

// Verificar si se ha enviado un número a través del formulario
if (isset($_POST['numero'])) {
    $numero = $_POST['numero'];
    
    // Calcular la suma de los dígitos del número ingresado
    $suma_digitos = sumaDigitos($numero);
    
    // Mostrar el resultado
    echo "<h2 class='mt-5'>Resultado</h2>";
    echo "<p>La suma de los dígitos del número $numero es $suma_digitos.</p>";
}
?>
