DROP DATABASE IF EXISTS videojuegos_db;
CREATE DATABASE IF NOT EXISTS videojuegos_db;

USE videojuegos_db;

DROP TABLE IF EXISTS plataformas;
CREATE TABLE IF NOT EXISTS plataformas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

DROP TABLE IF EXISTS generos;
CREATE TABLE IF NOT EXISTS generos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

DROP TABLE IF EXISTS juegos;
CREATE TABLE IF NOT EXISTS juegos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    genero_id INT,
    plataforma_id INT,
    desarrolladora VARCHAR(100) NOT NULL,
    lanzamiento DATE,
    FOREIGN KEY (plataforma_id) REFERENCES plataformas(id),
    FOREIGN KEY (genero_id) REFERENCES generos(id)
);

INSERT INTO plataformas(nombre) VALUES ('XBOX'),('PlayStation'),('Nintendo'),('Steam'),('Epic'),('GOG');
INSERT INTO generos(nombre) VALUES ('RPG'),('Survival Horror'),('Shooter'),('Aventura');

SELECT  j.id,j.titulo,g.nombre as genero,p.nombre as plataforma,j.desarrolladora,j.lanzamiento
from juegos j
JOIN plataformas p
ON p.id = j.plataforma_id
JOIN generos g
on g.id = j.genero_id;
