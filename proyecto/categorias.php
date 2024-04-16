<?php
// Verificar la sesión antes de mostrar la página
session_start();

// Verificar si la sesión está establecida para el usuario
if (!isset($_SESSION['tipo_permiso'])) {
    // Si no hay sesión, redirige a la página de inicio de sesión
    header("Location: index.php");
    exit();
}
?>
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
$sql = "SELECT categorias.id AS ID, categorias.nombre AS categoria
        FROM categorias
        ORDER BY categorias.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Categorías</title>
    <link rel="stylesheet" href="css\estilogeneral.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
</head>
<body>
<div class="contenedor">
    <header class="cabecera">
        <h1>CJC.A.G.P.EX</h1>
    </header>
    <h2>Administración de Categorías</h2>
    <main class="area-trabajo">    
    <div class="form-group">    
        <table border="1">
        <tr>
            <th>Id</th>
            <th>Categoría</th>
            <th>Subcategoría</th>
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
            echo "<td>" . $row["categoria"] . "</td>";
            echo "<td><a href='subcategorias.php?id=" . $row["ID"] . "'>Entrar</a></td>";
            echo "<td><a href='editar_categoria.php?id=" . $row["ID"] . "'>Editar</a></td>";
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
    <button onclick="crearCategoria()" class="boton">Crear Categoría</button>
    <button onclick="eliminarCategoria()" class="boton">Eliminar Categoría</button>

    
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
    
    <br><br><br>
</div>
</main> 
</div>
</body>
<footer>
<a href="inicio.php" class="pie">Ir a Inicio</a>
</footer>
</html>

