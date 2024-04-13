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

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir y limpiar los datos del formulario
    $categoria_id = mysqli_real_escape_string($conn, $_POST['categoria']);
    $subcategoria_id = mysqli_real_escape_string($conn, $_POST['subcategoria']);
    $dificultad_id = mysqli_real_escape_string($conn, $_POST['dificultad']);
    $tipo_pregunta_id = mysqli_real_escape_string($conn, $_POST['tipo_pregunta']);
    $pregunta = mysqli_real_escape_string($conn, $_POST['pregunta']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    $pistas = mysqli_real_escape_string($conn, $_POST['pistas']);

    // Validar que todos los campos estén completos
    if (!empty($categoria_id) && !empty($subcategoria_id) && !empty($dificultad_id) && !empty($tipo_pregunta_id) && !empty($pregunta)) {
        // Insertar la pregunta en la base de datos
        $sql = "INSERT INTO preguntas (categoria_id, subcategoria_id, dificultad_id, tipo_pregunta_id, pregunta, descripcion, pistas) 
                VALUES ('$categoria_id', '$subcategoria_id', '$dificultad_id', '$tipo_pregunta_id', '$pregunta', '$descripcion', '$pistas')";

        if ($conn->query($sql) === TRUE) {
            // Redireccionar a la página preguntas.php
            header("Location: preguntasdocente.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Por favor completa todos los campos.";
    }
}
?>
