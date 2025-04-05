CREATE DATABASE ventas;

USE ventas;

-- Crear la tabla de usuarios
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL
);

-- Crear la tabla de productos
CREATE TABLE productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre_producto VARCHAR(50) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL
);

-- Crear la tabla de ventas
CREATE TABLE ventas (
    id_venta INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_producto INT NOT NULL,
    fecha_venta TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto)
);

-- Insertar datos de prueba en la tabla usuarios
INSERT INTO usuarios (nombre, email) VALUES
('Juan Pérez', 'juan@example.com'),
('María García', 'maria@example.com'),
('Pedro López', 'pedro@example.com');

-- Insertar datos de prueba en la tabla productos
INSERT INTO productos (nombre_producto, precio) VALUES
('Producto A', 100.00),
('Producto B', 150.00),
('Producto C', 200.00);

-- Insertar datos de prueba en la tabla ventas
INSERT INTO ventas (id_usuario, id_producto) VALUES
(1, 1),  -- Juan Pérez compra Producto A
(2, 2),  -- María García compra Producto B
(3, 3);  -- Pedro López compra Producto C
