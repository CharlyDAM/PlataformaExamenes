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
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Categorías</title>
    <link rel="stylesheet" href="css\estilogeneral.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
</head>


<br><br><br>
<body>
<div class="contenedor">
    <header class="cabecera">
        <h1>CJCAGPEX</h1>
    </header>   
    <h2>Administración de Subcategorías</h2>
    <main class="area-trabajo">  
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
            WHERE categoria_id = $categoria_id
            ORDER BY subcategorias.id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Subcategoría</th><th>Editar</th></tr>";
        
        // Mostrar las subcategorías
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["ID"] . "</td>";
            echo "<td>" . $row["subcategoria"] . "</td>";
            echo "<td><a href='editar_subcategoria.php?id=" . $row["ID"] . "'>Editar</a></td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "No se encontraron subcategorías para esta categoría.";
    }
} else {
    echo "No se proporcionó un ID de categoría.";
}

// Cerrar la conexión
$conn->close();
?>
<br><br>
<div class="form-group">    
    <!-- Botones para crear y eliminar categorías -->
    <button onclick="crearSubcategoria()" class="boton">Crear Subcategoría</button>
    <button onclick="eliminarSubcategoria()" class="boton">Eliminar Subcategoría</button>

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
</main> 
</div>
</body>
<footer>
<a href="categorias.php" class="boton">Ir a Categorias</a>
</footer>
</html>
