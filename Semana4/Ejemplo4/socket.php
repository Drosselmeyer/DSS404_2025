<?php
// Definir la dirección IP y el puerto en el que el servidor escuchará las solicitudes
$ip = 'localhost';
$puerto = 9000;

// Crear un socket de escucha para el servidor
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

// Vincular el socket a la dirección IP y al puerto
socket_bind($socket, $ip, $puerto);

// Escuchar las solicitudes entrantes en el socket
socket_listen($socket);

echo "Servidor web en ejecución en http://$ip:$puerto" . PHP_EOL;

// Ciclo infinito para aceptar conexiones entrantes
while (true) {
    // Aceptar la conexión entrante
    $cliente_socket = socket_accept($socket);

    // Leer la solicitud del cliente
    $solicitud = socket_read($cliente_socket, 1024);

    // Preparar la respuesta del servidor
    $respuesta = "HTTP/1.1 200 OK\r\nContent-Type: text/html\r\n\r\n";
    $respuesta .= "<h1>Servidor Web en PHP</h1>";
    $respuesta .= "<p>¡Hola! Esta es una respuesta del servidor PHP.</p>";

    // Enviar la respuesta al cliente
    socket_write($cliente_socket, $respuesta, strlen($respuesta));

    // Cerrar la conexión con el cliente
    socket_close($cliente_socket);
}

// Cerrar el socket de escucha
socket_close($socket);
?>
