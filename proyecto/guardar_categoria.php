<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "zero_krawen83", "bd_plataforma_examenes");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Recibir los datos del formulario
$nombre = $_POST['nombre'];
//$categoria = $_POST['categoria_padre_id'];

// Preparar la consulta SQL para insertar la categoría
$sql = "INSERT INTO categorias (nombre) VALUES ('$nombre')";

// Ejecutar la consulta
if ($conexion->query($sql) === TRUE) {
    echo "Categoría creada con éxito";
} else {
    echo "Error al crear la categoría: " . $conexion->error;
}

// Cerrar la conexión
$conexion->close();
?>
