<?php
// Configuración de la base de datos
$servername = "localhost"; // Cambia esto si tu servidor de base de datos es diferente
$username = "root"; // Cambia esto por tu nombre de usuario de la base de datos
$password = ""; // Cambia esto por tu contraseña de la base de datos
$dbname = "videojuegos_db";

// Intentar establecer la conexión usando PDO
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configurar el modo de error de PDO a excepciones
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
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

    try {
        // Preparar la consulta SQL para insertar el juego
        $stmt = $conn->prepare("INSERT INTO juegos (titulo, genero_id, plataforma_id, desarrolladora, lanzamiento) 
                                VALUES (:titulo, :genero_id, :plataforma_id, :desarrolladora, :lanzamiento)");
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':genero_id', $genero_id);
        $stmt->bindParam(':plataforma_id', $plataforma_id);
        $stmt->bindParam(':desarrolladora', $desarrolladora);
        $stmt->bindParam(':lanzamiento', $lanzamiento);

        $stmt->execute();
        echo "Juego insertado correctamente.";
    } catch(PDOException $e) {
        echo "Error al insertar el juego: " . $e->getMessage();
    }
}

// Obtener juegos de la base de datos
$juegos_query = "SELECT  j.id,j.titulo,g.nombre as genero,p.nombre as plataforma,j.desarrolladora,j.lanzamiento
from juegos j
JOIN plataformas p
ON p.id = j.plataforma_id
JOIN generos g
on g.id = j.genero_id";
$juegos_result = $conn->query($juegos_query);

// Cerrar la conexión
$conn = null;
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
    <div class="max-w-md mx-auto bg-white rounded p-6">
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
                    if ($generos_result != null) {
                        foreach ($generos_result as $row) {
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
                    if ($plataformas_result != null) {
                        foreach ($plataformas_result as $row) {
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

        <!-- Tabla para mostrar juegos -->
        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-4">Juegos Registrados</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Título</th>
                        <th class="px-4 py-2">Género ID</th>
                        <th class="px-4 py-2">Plataforma ID</th>
                        <th class="px-4 py-2">Desarrolladora</th>
                        <th class="px-4 py-2">Lanzamiento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Mostrar juegos obtenidos de la base de datos
                    if ($juegos_result != null) {
                        foreach ($juegos_result as $row) {
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
