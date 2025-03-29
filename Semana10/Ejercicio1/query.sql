create database if not exists login;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    tipo_usuario ENUM('administrador', 'usuario') NOT NULL DEFAULT 'usuario'
);

-- Insertar un usuario administrador
INSERT INTO usuarios (nombre, correo, contrasena, tipo_usuario) 
VALUES ('Admin', 'admin@example.com', 'contrasena_admin', 'administrador');

-- Insertar un usuario normal
INSERT INTO usuarios (nombre, correo, contrasena, tipo_usuario) 
VALUES ('Usuario', 'usuario@example.com', 'contrasena_usuario', 'usuario');
