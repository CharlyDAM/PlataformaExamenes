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

// Obtener todas las categorías
$sql = "SELECT categorias.id AS ID, categorias.nombre AS categoria, subcategorias.id AS SubID, subcategorias.nombre AS subcategoria
        FROM categorias
        INNER JOIN subcategorias ON categorias.id = subcategorias.categoria_id
        ORDER BY categorias.id, subcategorias.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Categorías</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 12%;
    padding: 12%;
    display: flexbox;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f0f0f0;
}
        
        button {
          
            justify-content: center;
            margin-top: 20px;
            padding: 10px 20px;
            margin: 0 10px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        
        button:hover {
            background-color: #0056b3;
        }
        .form-group {
    margin-bottom: 15px;
}
    </style>
    <h2>Administración de Categorías y Subcategorías</h2>
</head>
<body>
<div class="form-group">    
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Categoría</th>
            <th>Sub_Id</th>
            <th>Subcategoría</th>
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
            echo "<td>" . $row["categoria"] . "</td>";
            } else {
            // Si el ID es el mismo que el de la fila anterior, solo mostrar las columnas de subcategoría
            echo "<td></td><td></td>"; // Columnas vacías para compensar el colspan
        }
        
        // Mostrar las columnas de subcategoría
        echo "<td>" . $row["SubID"] . "</td>";
        echo "<td>" . $row["subcategoria"] . "</td>";
        echo "</tr>";

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
    <button onclick="crearCategoria()">Crear Categoría</button>
    <button onclick="eliminarCategoria()">Eliminar Categoría</button>

   

    <!-- Botones para crear y eliminar subcategorías -->
    <button onclick="crearSubcategoria()">Crear Subcategoría</button>
    <button onclick="eliminarSubcategoria()">Eliminar Subcategoría</button>
    <br><br>
    
    <script>
        // Función para abrir una ventana emergente y crear una nueva categoría
        function crearCategoria() {
            var nombre = prompt("Ingrese el nombre de la nueva categoría:");

            // Verificar si se ingresó un nombre
            if (nombre != null && nombre != "") {
                // Realizar una solicitud AJAX para insertar la nueva categoría en la base de datos
                $.ajax({
                    url: 'insertar_categoria.php',
                    type: 'POST',
                    data: {nombre: nombre},
                    success: function(response) {
                        // Recargar la página para actualizar la lista de categorías
                        location.reload();
                    }
                });
            }
        }
    </script>
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
        function eliminarCategoria() {
            var id = prompt("Ingrese el ID de la categoría a eliminar:");

            // Verificar si se ingresó un ID
            if (id != null && id != "") {
                // Realizar una solicitud AJAX para eliminar la categoría de la base de datos
                $.ajax({
                    url: 'eliminar_categoria.php',
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
    <script>
        // Función para abrir una ventana emergente y eliminar una categoría
        function eliminarSubcategoria() {
            var id = prompt("Ingrese el ID de la subcategoría a eliminar:");

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
<a href="inicio.php"><button>Ir a Inicio</button></a>
</footer>
</html>

