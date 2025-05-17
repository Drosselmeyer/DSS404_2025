create database mvc;

use mvc;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    contrasena VARCHAR(255) NOT NULL
);

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    descripcion TEXT
);

CREATE TABLE carrito (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL DEFAULT 1,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);

INSERT INTO usuarios (nombre, email, contrasena) VALUES
('Juan Pérez', 'juan@example.com', 'contrasena123'),
('María García', 'maria@example.com', 'clave456'),
('Pedro López', 'pedro@example.com', 'pass789');

INSERT INTO productos (nombre, precio, descripcion) VALUES
('Camisa de manga larga', 29.99, 'Camisa elegante para hombres'),
('Pantalones vaqueros', 39.99, 'Pantalones de mezclilla para mujeres'),
('Zapatos deportivos', 59.99, 'Zapatos cómodos para correr');

INSERT INTO carrito (usuario_id, producto_id, cantidad) VALUES
(1, 1, 2), -- Juan Pérez agrega 2 camisas al carrito
(2, 2, 1), -- María García agrega 1 par de pantalones al carrito
(3, 3, 1); -- Pedro López agrega 1 par de zapatos al carrito
