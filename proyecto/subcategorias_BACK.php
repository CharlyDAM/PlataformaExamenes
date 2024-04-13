<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "zero_krawen83";
$database = "bd_plataforma_examenes";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $categoria_id = $_GET['id'];

    // Consulta para recuperar las subcategorías de la categoría seleccionada
    $sql = "SELECT subcategorias.id AS ID, subcategorias.nombre AS subcategoria
    FROM subcategorias
    INNER JOIN categorias ON subcategorias.categoria_id = categorias.id
    WHERE categoria_id = $categoria_id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Mostrar las subcategorías
        while ($row = $result->fetch_assoc()) {
            echo "Subcategoría: " . $row["subcategoria"] . "<br>";
        }
    } else {
        echo "No se encontraron subcategorías para esta categoría.";
    }
} else {
    echo "No se proporcionó un ID de categoría.";
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Categorías</title>
    <link rel="stylesheet" href="css\estilogeneral.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <h2>Administración de Subcategorías</h2>
</head>
<body>
<div class="form-group">    
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Subcategoria</th>
            <th>Editar</th>
            
        </tr>
        <?php
            $previous_id = null; // Variable para almacenar el ID de la fila anterior
            if ($result->num_rows > 0) {
            // Mostrar datos de cada fila
            while($row = $result->fetch_assoc()) {
            // Verificar si el ID es diferente al de la fila anterior
            if ($row["ID"] != $previous_id) {
            // Si el ID es diferente, mostrar la fila con el nuevo ID
            echo "<tr>";
            echo "<td>" . $row["ID"] . "</td>";
            echo "<td>" . $row["subcategoria"] . "</td>";
            echo "<td><a href='editar_subcategoria.php?id=" . $row["ID"] . "'>Editar</a></td>";
            echo "</tr>";
            } else {
            // Si el ID es el mismo que el de la fila anterior, solo mostrar las columnas de subcategoría
            echo "<td></td><td></td>"; // Columnas vacías para compensar el colspan
        }
        
        
        // Actualizar el ID de la fila anterior con el ID de la fila actual
        $previous_id = $row["ID"];
    }
} else {
    echo "<tr><td colspan='4'>No se encontraron resultados</td></tr>";
}
?>
</table>
<br><br><br>        
    
    <!-- Botones para crear y eliminar categorías -->
    <button onclick="crearSubcategoria()">Crear Subcategoría</button>
    <button onclick="eliminarSubcategoria()">Eliminar Subcategoría</button>

    
    <script>
        // Función para abrir una ventana emergente y crear una nueva subcategoría
        function crearSubcategoria() {
            var nombre = prompt("Ingrese el nombre de la nueva subcategoría:");
            var categoria = prompt("Ingrese el id de la categoría:");

            // Verificar si se ingresó un nombre
            if (nombre != null && nombre != "") {
                // Realizar una solicitud AJAX para insertar la nueva categoría en la base de datos
                $.ajax({
                    url: 'insertar_subcategoria.php',
                    type: 'POST',
                    data: {nombre: nombre,
                           categoria: categoria 
                        },
                    success: function(response) {
                        // Recargar la página para actualizar la lista de categorías
                        location.reload();
                    }
                });
            }
        }
    </script>
    
    <script>
        // Función para abrir una ventana emergente y eliminar una categoría
        function eliminarSubcategoria() {
            var id = prompt("Ingrese el ID de la categoría a eliminar:");

            // Verificar si se ingresó un ID
            if (id != null && id != "") {
                // Realizar una solicitud AJAX para eliminar la categoría de la base de datos
                $.ajax({
                    url: 'eliminar_subcategoria.php',
                    type: 'POST',
                    data: {id: id},
                    success: function(response) {
                        // Recargar la página para actualizar la lista de categorías
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Manejar errores
                        console.error(error);
                        alert("Ocurrió un error al eliminar la categoría.");
                    }
                });
            }
        }
    </script>
    
    <br><br><br>
</div>
</body>
<footer>
<a href="categorias.php"><button>Ir a Categorias</button></a>
</footer>
</html>

