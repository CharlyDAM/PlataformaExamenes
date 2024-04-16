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
$sql = "SELECT dificultades.id AS ID, dificultades.nombre AS dificultad
        FROM dificultades
        ORDER BY dificultades.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Dificultades</title>
    <link rel="stylesheet" href="css\estilogeneral.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
      
</head>
<body>
<div class="contenedor">
    <header class="cabecera">
        <h1>CJCAGPEX</h1>
    </header>
    <h2>Administración de Dificultades</h2>
    <main class="area-trabajo">   
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Dificultad</th>
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
            echo "<td>" . $row["dificultad"] . "</td>";
            echo "<td><a href='editar_dificultad.php?id=" . $row["ID"] . "'>Editar</a></td>";
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
    <button onclick="crearDificultad()" class="boton">Crear Dificultad</button>
    <button onclick="eliminarDificultad()" class="boton">Eliminar Dificultad</button>
    <br><br><br>

      
   
    <script>
        // Función para abrir una ventana emergente y crear una nueva categoría
        function crearDificultad() {
            var nombre = prompt("Ingrese el nivel de dificultad:");

            // Verificar si se ingresó un nombre
            if (nombre != null && nombre != "") {
                // Realizar una solicitud AJAX para insertar la nueva categoría en la base de datos
                $.ajax({
                    url: 'insertar_dificultad.php',
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
        function eliminarDificultad() {
            var id = prompt("Ingrese el ID de la dificultad a eliminar:");

            // Verificar si se ingresó un ID
            if (id != null && id != "") {
                // Realizar una solicitud AJAX para eliminar la categoría de la base de datos
                $.ajax({
                    url: 'eliminar_dificultad.php',
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
    </main>
    </div>    
</body>
<footer>
<a href="inicio.php" class="boton">Ir a Inicio</a>
</footer>
</html>

