<?php
class Producto {
    public $id;
    public $nombre;
    public $precio;
    public $descripcion;

    public function __construct($id, $nombre, $precio, $descripcion) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->descripcion = $descripcion;
    }

    public static function obtenerPorId($id) {
        // Conexión a la base de datos
        $conexion = new mysqli('localhost', 'root', '', 'mvc');
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        $id = $conexion->real_escape_string($id);
        $sql = "SELECT * FROM productos WHERE id = $id";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $producto = new Producto($fila['id'], $fila['nombre'], $fila['precio'], $fila['descripcion']);
            return $producto;
        } else {
            return null;
        }

        $conexion->close();
    }

    public static function obtenerTodos() {
        // Conexión a la base de datos
        $conexion = new mysqli('localhost', 'root', '', 'mvc');
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        $productos = [];

        $sql = "SELECT * FROM productos";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $producto = new Producto($fila['id'], $fila['nombre'], $fila['precio'], $fila['descripcion']);
                $productos[] = $producto;
            }
        }

        $conexion->close();

        return $productos;
    }
}
?>
