<?php
// Verificar si se recibió el ID de la categoría a eliminar
if(isset($_POST['id'])) {
    // Obtener el ID de la categoría a eliminar
    $id = $_POST['id'];

    // Realizar la conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "zero_krawen83";
    $database = "bd_plataforma_examenes";

    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Preparar la consulta SQL para eliminar la categoría
    $sql = "DELETE FROM subcategorias WHERE id = $id";

    // Ejecutar la consulta SQL
    if ($conn->query($sql) === TRUE) {
        // Enviar una respuesta al cliente indicando que la eliminación fue exitosa
        echo json_encode(array('success' => true));
    } else {
        // Enviar una respuesta al cliente indicando que ocurrió un error durante la eliminación
        echo json_encode(array('success' => false, 'error' => $conn->error));
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Enviar una respuesta al cliente indicando que no se recibió el ID de la categoría
    echo json_encode(array('success' => false, 'error' => 'ID de categoría no proporcionado.'));
}
?>
