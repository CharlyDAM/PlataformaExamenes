<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "zero_krawen83";
$database = "bd_plataforma_examenes";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el nombre de la nueva categoría desde la solicitud POST
$nombre = $_POST['nombre'];
$categoria = $_POST['categoria'];

// Preparar la consulta SQL para insertar la nueva categoría en la tabla de categorías
$sql = "INSERT INTO subcategorias (nombre, categoria_id) VALUES ('$nombre','$categoria')";

// Ejecutar la consulta SQL
if ($conn->query($sql) === TRUE) {
    echo "Subcategoría insertada correctamente";
} else {
    echo "Error al insertar la Subcategoría: " . $conn->error;
}

$conn->close();
?>
