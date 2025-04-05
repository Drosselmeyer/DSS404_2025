<?php
// Datos de conexión a la base de datos
$host = 'localhost';
$usuario = 'root';
$contrasena = '';
$base_datos = 'ventas';

// Conexión a la base de datos
$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Manejar GET, POST, PUT y DELETE
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        // Código para manejar solicitudes GET
        if (isset($_GET['id_venta'])) {
            $id_venta = $_GET['id_venta'];

            // Query para obtener información de la venta
            $query_venta = "SELECT * FROM ventas WHERE id_venta = $id_venta";
            $resultado_venta = $conexion->query($query_venta);

            if ($resultado_venta && $resultado_venta->num_rows > 0) {
                $venta = $resultado_venta->fetch_assoc();
                echo json_encode($venta);
            } else {
                echo json_encode(['error' => 'Venta no encontrada']);
            }
        } else {
            // Query para obtener información de la venta
            $query_venta = "SELECT * FROM ventas";
            $resultado_venta = $conexion->query($query_venta);
            $venta = array();
            if ($resultado_venta && $resultado_venta->num_rows > 0) {
                while ($row = $resultado_venta->fetch_assoc()) {
                $venta[] = $row;
                }
                echo json_encode($venta);
            } else {
                echo json_encode(['error' => 'Venta no encontrada']);
            }
        }
        break;

    case 'POST':
        // Código para manejar solicitudes POST
        $data = json_decode(file_get_contents("php://input"), true);

        // Verifica que los datos necesarios estén presentes en la solicitud
        if (isset($data['id_usuario']) && isset($data['id_producto'])) {
            $id_usuario = $data['id_usuario'];
            $id_producto = $data['id_producto'];

            // Query para insertar nueva venta en la tabla ventas
            $query_insert_venta = "INSERT INTO ventas (id_usuario, id_producto) VALUES ($id_usuario, $id_producto)";
            if ($conexion->query($query_insert_venta) === TRUE) {
                echo json_encode(['message' => 'Venta registrada correctamente']);
            } else {
                echo json_encode(['error' => 'Error al registrar la venta']);
            }
        } else {
            echo json_encode(['error' => 'Faltan parámetros']);
        }
        break;

    case 'PUT':
        // Código para manejar solicitudes PUT
        $put_vars=json_decode(file_get_contents("php://input"), true);

        // Verifica que los datos necesarios estén presentes en la solicitud
        if (isset($put_vars['id_venta']) && isset($put_vars['id_usuario']) && isset($put_vars['id_producto'])) {
            $id_venta = $put_vars['id_venta'];
            $id_usuario = $put_vars['id_usuario'];
            $id_producto = $put_vars['id_producto'];

            // Query para actualizar la venta en la tabla ventas
            $query_update_venta = "UPDATE ventas SET id_usuario = $id_usuario, id_producto = $id_producto WHERE id_venta = $id_venta";
            if ($conexion->query($query_update_venta) === TRUE) {
                echo json_encode(['message' => 'Venta actualizada correctamente']);
            } else {
                echo json_encode(['error' => 'Error al actualizar la venta']);
            }
        } else {
            echo json_encode(['error' => 'Faltan parámetros']);
        }
        break;

    case 'DELETE':
        // Código para manejar solicitudes DELETE
        $delete_vars = json_decode(file_get_contents("php://input"), true);

        // Verifica que los datos necesarios estén presentes en la solicitud
        if (isset($delete_vars['id_venta'])) {
            $id_venta = $delete_vars['id_venta'];

            // Query para eliminar la venta de la tabla ventas
            $query_delete_venta = "DELETE FROM ventas WHERE id_venta = $id_venta";
            if ($conexion->query($query_delete_venta) === TRUE) {
                echo json_encode(['message' => 'Venta eliminada correctamente']);
            } else {
                echo json_encode(['error' => 'Error al eliminar la venta']);
            }
        } else {
            echo json_encode(['error' => 'Faltan parámetros']);
        }
        break;

    default:
        echo json_encode(['error' => 'Método no permitido']);
        break;
}
?>
