<?php
// Conexión a la base de datos
$servername = "localhost"; // Cambia esto si tu servidor de base de datos es diferente
$username = "root"; // Cambia esto por tu nombre de usuario de la base de datos
$password = ""; // Cambia esto por tu contraseña de la base de datos
$dbname = "videojuegos_db";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener géneros de la base de datos
$generos_query = "SELECT id, nombre FROM generos";
$generos_result = $conn->query($generos_query);

// Obtener plataformas de la base de datos
$plataformas_query = "SELECT id, nombre FROM plataformas";
$plataformas_result = $conn->query($plataformas_query);

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $genero_id = $_POST['genero_id'];
    $plataforma_id = $_POST['plataforma_id'];
    $desarrolladora = $_POST['desarrolladora'];
    $lanzamiento = $_POST['lanzamiento'];

    // Preparar la consulta SQL para insertar el juego
    $sql = "INSERT INTO juegos (titulo, genero_id, plataforma_id, desarrolladora, lanzamiento) 
            VALUES ('$titulo', $genero_id, $plataforma_id, '$desarrolladora', '$lanzamiento')";

    if ($conn->query($sql) === TRUE) {
        echo "Juego insertado correctamente."; 
    } else {
        echo "Error al insertar el juego: " . $conn->error;
    }
}

// Obtener juegos insertados
$juegos_query = "SELECT  j.id,j.titulo,g.nombre as genero,p.nombre as plataforma,j.desarrolladora,j.lanzamiento
from juegos j
JOIN plataformas p
ON p.id = j.plataforma_id
JOIN generos g
on g.id = j.genero_id";
$juegos_result = $conn->query($juegos_query);

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Juego</title>
    <!-- Enlace a Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-md mx-auto bg-white rounded p-1">
        <h2 class="text-2xl font-bold mb-4">Insertar Juego</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="space-y-4">
            <div>
                <label for="titulo" class="block">Título:</label>
                <input type="text" id="titulo" name="titulo" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
            </div>
            <div>
                <label for="genero_id" class="block">Género:</label>
                <select id="genero_id" name="genero_id" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    <?php
                    // Mostrar opciones de géneros obtenidos de la base de datos
                    if ($generos_result->num_rows > 0) {
                        while ($row = $generos_result->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="plataforma_id" class="block">Plataforma:</label>
                <select id="plataforma_id" name="plataforma_id" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    <?php
                    // Mostrar opciones de plataformas obtenidas de la base de datos
                    if ($plataformas_result->num_rows > 0) {
                        while ($row = $plataformas_result->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="desarrolladora" class="block">Desarrolladora:</label>
                <input type="text" id="desarrolladora" name="desarrolladora" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
            </div>
            <div>
                <label for="lanzamiento" class="block">Lanzamiento:</label>
                <input type="date" id="lanzamiento" name="lanzamiento" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
            </div>
            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200">Insertar Juego</button>
            </div>
        </form>

        <!-- Tabla para  mostrar juegos -->
        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-4">Juegos Registrados</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Título</th>
                        <th class="px-4 py-2">Género</th>
                        <th class="px-4 py-2">Plataforma</th>
                        <th class="px-4 py-2">Desarrolladora</th>
                        <th class="px-4 py-2">Lanzamiento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Mostrar juegos obtenidos de la base de datos
                    if ($juegos_result->num_rows > 0) {
                        while ($row = $juegos_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='px-4 py-2'>" . $row['id'] . "</td>";
                            echo "<td class='px-4 py-2'>" . $row['titulo'] . "</td>";
                            echo "<td class='px-4 py-2'>" . $row['genero'] . "</td>";
                            echo "<td class='px-4 py-2'>" . $row['plataforma'] . "</td>";
                            echo "<td class='px-4 py-2'>" . $row['desarrolladora'] . "</td>";
                            echo "<td class='px-4 py-2'>" . $row['lanzamiento'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='px-4 py-2'>No hay juegos registrados.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
