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

// Verificar si se recibió el ID de la categoría
if (isset($_POST['categoria_id'])) {
    $categoria_id = $_POST['categoria_id'];

    // Consulta para obtener las subcategorías relacionadas con la categoría seleccionada
    $sql = "SELECT id, nombre FROM subcategorias WHERE categoria_id = $categoria_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Construir las opciones de subcategoría en formato HTML
        $options = "";
        while ($row = $result->fetch_assoc()) {
            $options .= "<option value='" . $row["id"] . "'>" . $row["nombre"] . "</option>";
        }
        echo $options; // Devolver las opciones de subcategoría
    } else {
        echo "<option value=''>No hay subcategorías disponibles</option>";
    }
} else {
    echo "<option value=''>Seleccione una categoría primero</option>";
}

// Cerrar la conexión
$conn->close();
?>
