<?php
class Carrito {
    private $productos;

    public function __construct() {
        // Inicializar el carrito como un array vacío al crear una instancia
        $this->productos = [];
    }

    public function agregarProducto($productoId, $nombre, $precio, $cantidad = 1) {
        // Verificar si el producto ya está en el carrito
        if (isset($this->productos[$productoId])) {
            // Si está en el carrito, aumentar la cantidad
            $this->productos[$productoId]['cantidad'] += $cantidad;
        } else {
            // Si no está en el carrito, agregarlo como un nuevo elemento
            $this->productos[$productoId] = [
                'nombre' => $nombre,
                'precio' => $precio,
                'cantidad' => $cantidad
            ];
        }
    }

    public function eliminarProducto($productoId) {
        // Verificar si el producto está en el carrito antes de eliminarlo
        if (isset($this->productos[$productoId])) {
            unset($this->productos[$productoId]);
        }
    }

    public function obtenerProductos() {
        return $this->productos;
    }

    public function vaciarCarrito() {
        $this->productos = [];
    }

    public function calcularTotal() {
        $total = 0;
        foreach ($this->productos as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];
        }
        return $total;
    }

    public function mostrarCarrito() {
        // Lógica para mostrar el carrito de compras en la vista
        // Aquí puedes usar un bucle para mostrar cada producto en el carrito
        foreach ($this->productos as $productoId => $producto) {
            echo "Producto: {$producto['nombre']} - Precio: {$producto['precio']} - Cantidad: {$producto['cantidad']} <br>";
        }
    }
}
?>
