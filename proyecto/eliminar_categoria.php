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
    
    // Verificar si hay preguntas asociadas a esta categoría
    $sql_check_questions = "SELECT COUNT(*) AS total FROM preguntas WHERE categoria_id = $id";
    $result_check_questions = $conn->query($sql_check_questions);

    if ($result_check_questions === FALSE) {
        // Enviar una respuesta al cliente indicando que ocurrió un error al verificar las preguntas asociadas
        echo json_encode(array('success' => false, 'error' => 'Error al verificar las preguntas asociadas.'));

        exit();
    }

    $row = $result_check_questions->fetch_assoc();
    $total_questions = $row['total'];

    if ($total_questions > 0) {
        // Enviar una respuesta al cliente indicando que no se puede eliminar la categoría debido a preguntas asociadas
        alert("No se puede eliminar la categoría porque tiene preguntas asociadas.");
        echo json_encode(array('success' => false, 'error' => 'No se puede eliminar la categoría porque tiene preguntas asociadas.'));
        
        exit();
    }
    
    // Preparar la consulta SQL para eliminar la categoría
    $sql = "DELETE FROM categorias WHERE id = $id";

    // Ejecutar la consulta SQL
    if ($conn->query($sql) === TRUE) {
        // Enviar una respuesta al cliente indicando que la eliminación fue exitosa
        echo json_encode(array('success' => true));
    } else {
        // Enviar una respuesta al cliente indicando que ocurrió un error durante la eliminación
        alert("No se puede eliminar la categoría porque tiene preguntas asociadas.");
        echo json_encode(array('success' => false, 'error' => $conn->error));
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Enviar una respuesta al cliente indicando que no se recibió el ID de la categoría
    echo json_encode(array('success' => false, 'error' => 'ID de categoría no proporcionado.'));
}
?>
