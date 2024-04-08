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
$sql = "SELECT categorias.id AS ID, categorias.nombre AS categoria, subcategoria.id AS SubID, subcategoria.nombre AS subcategoria
        FROM categorias
        INNER JOIN subcategoria ON categorias.id = subcategoria.categoria_id
        ORDER BY categorias.id, subcategoria.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
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
        }
        
        button {
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
    </style>
</head>
<body>
    
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Categoría</th>
            <th>Id</th>
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
        <h2>Administración de Categorías y Subcategorías</h2>
    
    <!-- Botones para crear y eliminar categorías -->
    <button onclick="crearCategoria()">Crear Categoría</button>
    <button onclick="alert('Eliminar categoría')">Eliminar Categoría</button>

   

    <!-- Botones para crear y eliminar subcategorías -->
    <button onclick="alert('Crear nueva subcategoría')">Crear Subcategoría</button>
    <button onclick="alert('Eliminar subcategoría')">Eliminar Subcategoría</button>
    <br><br>
    </table>
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
</body>
</html>

