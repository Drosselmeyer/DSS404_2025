<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Multiplicar</title>
</head>
<body>
    <h1>Tabla de Multiplicar Personalizada</h1>
    
    <form action="" method="get">
        <label for="inicio">Inicio de la tabla:</label>
        <input type="number" id="inicio" name="inicio" required>
        <label for="fin">Fin de la tabla:</label>
        <input type="number" id="fin" name="fin" required>
        <button type="submit">Generar Tabla</button>
    </form>

    <?php
    // Verificar si se han proporcionado los números para generar la tabla
    if (isset($_GET['inicio']) && isset($_GET['fin'])) {
        $inicio = $_GET['inicio'];
        $fin = $_GET['fin'];
    ?>
        <h2>Tabla de Multiplicar del <?php echo $inicio; ?> al <?php echo $fin; ?></h2>

        <table border="1">
            <tr>
                <th></th>
                <?php
                // Imprimir los encabezados de la tabla
                for ($i = $inicio; $i <= $fin; $i++) {
                    echo "<th>$i</th>";
                }
                ?>
            </tr>
            <?php
            // Generar la tabla de multiplicar
            /*for ($i = $inicio; $i <= $fin; $i++) {
                echo "<tr>";
                echo "<th>$i</th>"; // Imprimir el encabezado de la fila
                for ($j = $inicio; $j <= $fin; $j++) {
                    echo "<td>" . ($i * $j) . "</td>"; // Calcular y mostrar el resultado de la multiplicación
                }
                echo "</tr>";
            }*/

            $i = $inicio;
            while( $i <= $fin)
            {
                echo "<tr>";
                echo "<th>$i</th>"; // Imprimir el encabezado de la fila
                $j = $inicio; 
                while( $j <= $fin)
                {
                    echo "<td>" . ($i * $j) . "</td>"; // Calcular y mostrar el resultado de la multiplicación
                    $j++;
                }
                echo "</tr>";
                $i++;
            }
            ?>
        </table>
    <?php
    }
    ?>
</body>
</html>
