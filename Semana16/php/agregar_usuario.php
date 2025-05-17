<?php
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "usu";

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    $sql = "INSERT INTO usuarios (nombre, email) VALUES ('$nombre', '$email')";
    if ($conexion->query($sql) === TRUE) {
        echo "Usuario agregado correctamente.";
    } else {
        echo "Error al agregar usuario: " . $conexion->error;
    }
}

$conexion->close();
?>
