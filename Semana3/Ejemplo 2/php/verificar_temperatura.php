<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener la temperatura ingresada por el usuario
    $temperatura = $_POST["temperatura"];

    // Verificar la temperatura
    if ($temperatura < 0) {
        $mensaje = "¡Cuidado! La temperatura es muy baja.";
    } elseif ($temperatura >= 0 && $temperatura <= 25) {
        $mensaje = "La temperatura es moderada.";
    } else {
        $mensaje = "¡Cuidado! La temperatura es alta.";
    }

    // Redireccionar a la página de resultado
    header("Location: resultado_temperatura.html?mensaje=" . urlencode($mensaje));
    exit();
}
?>
