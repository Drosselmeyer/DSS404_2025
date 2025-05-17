<?php
// Cargar los archivos necesarios (controlador, modelos, etc.)
require_once 'Controlador.php';
require_once '../modelo/Usuario.php';
require_once '../modelo/Producto.php';
require_once '../modelo/Carrito.php';

// Inicializar el controlador
$controlador = new Controlador();

// Verificar la acción solicitada por el usuario
if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];

    // Enrutamiento de acciones
    switch ($accion) {
        case 'login':
            $controlador->login();
            break;
        case 'registro':
            $controlador->registro();
            break;
        case 'verProductos':
            $controlador->obtenerTodosLosProductos();
            break;
        case 'agregarAlCarrito':
            $controlador->agregarAlCarrito();
            break;
        case 'verCarrito':
            $controlador->verCarrito();
            break;
        case 'finalizarCompra':
            $controlador->finalizarCompra();
            break;
        case 'verPerfil':
            $controlador->verPerfil();
            break;
        case 'editarPerfil':
            $controlador->editarPerfil();
            break;
        case 'cambiarContrasena':
            $controlador->cambiarContrasena();
            break;
        case 'cerrarSesion':
            $controlador->cerrarSesion();
            break;
        default:
            // Mostrar una página de error o redirigir a la página de inicio
            header('Location: inicio.php');
            exit();
    }
} else {
    // Si no se especifica ninguna acción, cargar la página de inicio por defecto
    include 'inicio.php';
}
?>
