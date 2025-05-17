<?php
class Usuario {
    public $id;
    public $nombre;
    public $email;
    public $contrasena;

    public function __construct($id, $nombre, $email, $contrasena) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->contrasena = $contrasena;
    }

    public static function obtenerPorId($id) {
        // Conexión a la base de datos
        $conexion = new mysqli('localhost', 'root', '', 'mvc');
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        $id = $conexion->real_escape_string($id);
        $sql = "SELECT * FROM usuarios WHERE id = $id";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $usuario = new Usuario($fila['id'], $fila['nombre'], $fila['email'], $fila['contrasena']);
            return $usuario;
        } else {
            return null;
        }

        $conexion->close();
    }

    public function guardar() {
        // Conexión a la base de datos
        $conexion = new mysqli('localhost', 'root', '', 'mvc');
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        $nombre = $conexion->real_escape_string($this->nombre);
        $email = $conexion->real_escape_string($this->email);
        $contrasena = $conexion->real_escape_string($this->contrasena);

        $sql = "INSERT INTO usuarios (nombre, email, contrasena) VALUES ('$nombre', '$email', '$contrasena')";
        $resultado = $conexion->query($sql);

        if ($resultado) {
            $this->id = $conexion->insert_id;
            $conexion->close();
            return true;
        } else {
            $conexion->close();
            return false;
        }
    }

    public function actualizar() {
        // Conexión a la base de datos
        $conexion = new mysqli('localhost', 'root', '', 'mvc');
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        $id = $conexion->real_escape_string($this->id);
        $nombre = $conexion->real_escape_string($this->nombre);
        $email = $conexion->real_escape_string($this->email);
        $contrasena = $conexion->real_escape_string($this->contrasena);

        $sql = "UPDATE usuarios SET nombre='$nombre', email='$email', contrasena='$contrasena' WHERE id=$id";
        $resultado = $conexion->query($sql);

        $conexion->close();

        return $resultado;
    }

    public function eliminar() {
        // Conexión a la base de datos
        $conexion = new mysqli('localhost', 'root', '', 'mvc');
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        $id = $conexion->real_escape_string($this->id);

        $sql = "DELETE FROM usuarios WHERE id=$id";
        $resultado = $conexion->query($sql);

        $conexion->close();

        return $resultado;
    }

    public static function login($email,$contrasena) {
        // Conexión a la base de datos
        $conexion = new mysqli('localhost', 'root', '', 'mvc');
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        $email = $conexion->real_escape_string($email);
        $contrasena = $conexion->real_escape_string($contrasena);
        $sql = "SELECT * FROM usuarios WHERE email = '$email' and contrasena = '$contrasena'";
        echo $sql;
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $usuario = new Usuario($fila['id'], $fila['nombre'], $fila['email'], $fila['contrasena']);
            return $usuario;
        } else {
            return null;
        }

        $conexion->close();
    }
}
?>
