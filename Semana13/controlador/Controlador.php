<?php
class Controlador {
    public function inicio() {
        // Aquí podrías cargar una página de inicio o redirigir a otra vista
        include 'vistas/inicio.php';
    }

    public function login() {
        // Lógica para el inicio de sesión
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $contrasena = $_POST['contrasena'];

            if (Usuario::login($email,$contrasena)) {
                // Iniciar sesión
                $_SESSION['usuario'] = $email;
                header('Location: ../vistas/perfil.php');
                exit;
            } else {
                echo 'Credenciales incorrectas';
            }
        }

        // Mostrar formulario de inicio de sesión
        include '../vistas/login.php';
    }

    public function registro() {
        // Lógica para el registro de usuarios
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $contrasena = $_POST['contrasena'];

            // Validar y crear el usuario (ejemplo simplificado)
            $usuario = new Usuario(null, $nombre, $email, $contrasena);
            $resultado = $usuario->guardar();

            if ($resultado) {
                echo 'Registro exitoso';
                // También podrías iniciar sesión automáticamente aquí
            } else {
                echo 'Error al registrar el usuario';
            }
        }

        // Mostrar formulario de registro
        include '../vistas/registro.php';
    }

    public function agregarAlCarrito() {
        // Lógica para agregar un producto al carrito de compras
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verificar si el usuario está autenticado
            if (!isset($_SESSION['usuario'])) {
                echo 'Debes iniciar sesión para agregar productos al carrito';
                return;
            }
    
            $productoId = $_POST['producto_id'];
            $cantidad = $_POST['cantidad'];
    
            // Validar y agregar al carrito (ejemplo simplificado)
            // Aquí deberías tener en cuenta la sesión del usuario para asociar el producto a su carrito
            echo "Se agregó el producto $productoId al carrito con una cantidad de $cantidad";
        } else {
            echo 'Error al agregar el producto al carrito';
        }
    }
    

    public function verCarrito() {
        // Lógica para mostrar el contenido del carrito de compras
        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['usuario'])) {
            echo 'Debes iniciar sesión para ver tu carrito de compras';
            return;
        }
    
        // Obtener productos del carrito (ejemplo simplificado)
        // Aquí deberías obtener los productos del carrito asociados al usuario en sesión
        $productosCarrito = [
            ['id' => 1, 'nombre' => 'Camisa', 'precio' => 29.99, 'cantidad' => 2],
            ['id' => 2, 'nombre' => 'Pantalones', 'precio' => 39.99, 'cantidad' => 1]
        ];
    
        // Mostrar la vista del carrito de compras
        include '../vistas/carrito.php';
    }
    

    public function finalizarCompra() {
        // Lógica para finalizar la compra y procesar el pago
        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['usuario'])) {
            echo 'Debes iniciar sesión para finalizar la compra';
            return;
        }
    
        // Lógica para procesar el pago (ejemplo simplificado)
        $totalCompra = 0;
        $productosCarrito = []; // Aquí deberías obtener los productos del carrito asociados al usuario en sesión
    
        foreach ($productosCarrito as $producto) {
            $totalCompra += $producto['precio'] * $producto['cantidad'];
        }
    
        // Mostrar mensaje de compra realizada
        echo "Compra realizada correctamente. Total a pagar: $totalCompra";
    }
    

    public function eliminarDelCarrito() {
        // Lógica para eliminar un producto del carrito de compras
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productoId = $_POST['producto_id'];
    
            // Validar y eliminar del carrito (ejemplo simplificado)
            if (!isset($_SESSION['usuario'])) {
                echo 'Debes iniciar sesión para agregar productos al carrito';
                return;
            }
            
            echo "Se eliminó el producto $productoId del carrito";
        } else {
            echo 'Error al eliminar el producto del carrito';
        }
    }

    public function obtenerTodosLosProductos() {
        // Lógica para obtener todos los productos disponibles
        $productos = Producto::obtenerTodos();
    
        // Aquí podrías pasar los datos de los productos a una vista para mostrarlos
        include '../vistas/productos.php';
    }
    
    public function verPerfil() {
        // Lógica para mostrar el perfil del usuario
        if (!isset($_SESSION['usuario'])) {
            echo 'Debes iniciar sesión para agregar productos al carrito';
            return;
        }
        // Obtener datos del usuario en sesión (ejemplo simplificado)
        $usuarioEmail = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : '';
    
        // Aquí podrías obtener más información del usuario desde la base de datos
        $usuario = Usuario::obtenerPorEmail($usuarioEmail);
    
        // Mostrar la vista del perfil del usuario
        include '../vistas/perfil.php';
    }
    
}
?>
