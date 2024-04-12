<?php
// Conexión a la base de datos (suponiendo que ya tienes esta parte configurada)
$servername = "localhost";
$username = "root";
$password = "zero_krawen83";
$database = "bd_plataforma_examenes";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener las categorías disponibles
$sql_categorias = "SELECT id, nombre FROM categorias";
$result_categorias = $conn->query($sql_categorias);



//Consulta para obtener las preguntas y su información
$sql_preguntas = "SELECT preguntas.id, preguntas.pregunta, preguntas.descripcion, preguntas.pistas, categorias.nombre as categoria, subcategorias.nombre as subcategoria, dificultades.nombre as dificultad, tipospreguntas.nombre as tipo_pregunta  
        FROM preguntas
        INNER JOIN categorias ON preguntas.categoria_id = categorias.id
        INNER JOIN subcategorias ON preguntas.subcategoria_id = subcategorias.id
        INNER JOIN dificultades ON preguntas.dificultad_id = dificultades.id
        INNER JOIN tipospreguntas ON preguntas.tipo_pregunta_id = tipospreguntas.id
        ORDER BY preguntas.id";
        
        if(isset($_POST['filtrar_categoria'])) {
            $categoria_id = $_POST['categoria_id'];
            $sql_preguntas = "SELECT preguntas.id, preguntas.pregunta, preguntas.descripcion, preguntas.pistas, categorias.nombre as categoria, subcategorias.nombre as subcategoria, dificultades.nombre as dificultad, tipospreguntas.nombre as tipo_pregunta  
            FROM preguntas
            INNER JOIN categorias ON preguntas.categoria_id = categorias.id
            INNER JOIN subcategorias ON preguntas.subcategoria_id = subcategorias.id
            INNER JOIN dificultades ON preguntas.dificultad_id = dificultades.id
            INNER JOIN tipospreguntas ON preguntas.tipo_pregunta_id = tipospreguntas.id
            WHERE preguntas.categoria_id = $categoria_id
            ORDER BY preguntas.id";
        
        } elseif(isset($_POST['anular_filtro'])) {
        // Anular filtro y mostrar todas las preguntas sin filtrar
        $sql_preguntas .= ""; // No se añade ninguna condición extra
         }
        
        $result_preguntas = $conn->query($sql_preguntas);
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Preguntas</title>
    <link rel="stylesheet" href="css/estilogeneral.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Listado de Preguntas</h2>

    <form method="post">
        <label for="categoria">Filtrar por Categoría:</label>
        <select id="categoria" name="categoria_id">
            
            <?php
            if ($result_categorias->num_rows > 0) {
                while($row = $result_categorias->fetch_assoc()) {
                    echo "<option value='" . $row["id"] . "'>" . $row["nombre"] . "</option>";
                }
            }
            ?>
        </select>
        <button type="submit" name="filtrar_categoria">Filtrar</button>
        <button type="submit" name="anular_filtro">Anular Filtro</button>
    </form>
    <br><br><br>
    <table>
        <tr>
            <th>ID Pregunta</th>
            <th>Categoría</th>
            <th>Subcategoría</th>
            <th>Dificultad</th>
            <th>Tipo de Pregunta</th>
            <th>Pregunta</th>
            <th>Descripción</th>
            <th>Pistas</th>
        </tr>
        <?php
        if ($result_preguntas->num_rows > 0) {
            while($row = $result_preguntas->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["categoria"] . "</td>";
                echo "<td>" . $row["subcategoria"] . "</td>";
                echo "<td>" . $row["dificultad"] . "</td>";
                echo "<td>" . $row["tipo_pregunta"] . "</td>";
                echo "<td>" . $row["pregunta"] . "</td>";
                echo "<td>" . $row["descripcion"] . "</td>";
                echo "<td>" . $row["pistas"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No hay preguntas almacenadas.</td></tr>";
        }
        ?>
    </table>
    <br><br><br>
        <!-- Botón para crear una nueva pregunta -->
    <a href="crear_preguntaDocente.php"><button>Crear Pregunta</button></a>
    <button onclick="eliminarPregunta()">Eliminar Pregunta</button>
    <script>
        // Función para abrir una ventana emergente y crear una nueva categoría
        function eliminarPregunta() {
            var id = prompt("Ingrese el Id de la pregunta a eliminar:");

            // Verificar si se ingresó un nombre
            if (id != null && id != "") {
                // Realizar una solicitud AJAX para insertar la nueva categoría en la base de datos
                $.ajax({
                    url: 'borrar_pregunta.php',
                    type: 'POST',
                    data: {id: id},
                    success: function(response) {
                        // Recargar la página para actualizar la lista de categorías
                        location.reload();
                    }
                });
            }
        }
    </script>

        <br><br><br>
  
</body>
<footer>
    <br><br><br>
<a href="inicioDocente.php"><button>Ir a Inicio</button></a>
</footer>
</html>



<?php
// Cerrar la conexión a la base de datos al finalizar
$conn->close();
?>
