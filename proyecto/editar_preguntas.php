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
if(isset($_GET['id'])) {
    // Obtener el ID de la categoría
    $categoria_id = $_GET['id'];
    
    // Consultar la base de datos para obtener la información de la categoría por su ID
    $sql_preguntas = "SELECT preguntas.id, preguntas.pregunta, preguntas.descripcion, preguntas.pistas, categorias.nombre as categoria, subcategorias.nombre as subcategoria, dificultades.nombre as dificultad, tipospreguntas.nombre as tipo_pregunta  
        FROM preguntas
        INNER JOIN categorias ON preguntas.categoria_id = categorias.id
        INNER JOIN subcategorias ON preguntas.subcategoria_id = subcategorias.id
        INNER JOIN dificultades ON preguntas.dificultad_id = dificultades.id
        INNER JOIN tipospreguntas ON preguntas.tipo_pregunta_id = tipospreguntas.id
        ORDER BY preguntas.id";
    $result = $conn->query($sql_preguntas);
    
    if($result->num_rows > 0) {
        // Obtener los datos de la categoría
        $categoria = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Categorías</title>
    <link rel="stylesheet" href="css\estilogeneral.css">
    <h2>Editar Preguntas</h2>
</head>
<body>
    
    <form action="editar_preguntas.php" method="POST">
        <label>ID:</label>
        <input type="text" name="id" value="<?php echo $categoria['id']; ?>"> <br>
        <label>Categoria:</label>
        <input type="text" name="categoria" value="<?php echo $categoria['categoria']; ?>"><br>
        <label>Subcategoria:</label>
        <input type="text" name="subcategoria" value="<?php echo $categoria['subcategoria']; ?>"><br>
        <label>Dificultad:</label>
        <input type="text" name="dificultad" value="<?php echo $categoria['dificultad']; ?>"><br>
        <label>Tipo de pregunta:</label>
        <input type="text" name="tipo" value="<?php echo $categoria['tipo_pregunta']; ?>"><br>
        <label>Pregunta:</label>
        <textarea name="pregunta" value="<?php echo $categoria['pregunta']; ?>"></textarea><br>
        <label>Descripcion:</label>
        <textarea type="text" name="descripcion" value="<?php echo $categoria['descripcion']; ?>"></textarea><br>
        <label>Pistas:</label>
        <textarea type="text" name="pista" value="<?php echo $categoria['pistas']; ?>"></textarea><br>
        <input type="submit" name="submit" value="Modificar">
    </form>
    <br><br><br>
    <a href="preguntas.php" class="boton">Volver</a>
</body>
</html>
<?php
    } else {
        echo 'La categoría no existe.';
    }
} else {
    echo 'No se proporcionó ID de categoría.';
}



// Verificar si se envió el formulario
if(isset($_POST['submit'])) {
    // Obtener los datos del formulario
    $pregunta_id = $_POST['id'];
    $categoria_nombre = $_POST['categoria'];
    $subcategoria_nombre = $_POST['subcategoria'];
    $dificultad = $_POST['dificultad'];
    $tipos_nombre = $_POST['tipo'];
    $nueva_pregunta = $_POST['pregunta'];
    $nueva_descripcion = $_POST['descripcion'];
    $nueva_pista = $_POST['pista'];
    
    // Actualizar la categoría en la base de datos
    $sql = "UPDATE preguntas SET pregunta = $nueva_pregunta WHERE id = $pregunta_id";
    $sql = "UPDATE preguntas SET descripcion = $nueva_descripcion WHERE id = $pregunta_id";
    $sql = "UPDATE preguntas SET pista = $nueva_pista WHERE id = $pregunta_id";
    $sql = "UPDATE preguntas SET tipo_pregunta = $tipos_nombre WHERE id = $pregunta_id";
    $sql = "UPDATE preguntas SET dificultad = $dificultad WHERE id = $pregunta_id";
    $sql = "UPDATE preguntas SET subcategoria = $subcategoria_nombre WHERE id = $pregunta_id";
    $sql = "UPDATE preguntas SET categoria = $categoria_nombre WHERE id = $pregunta_id";

    if($conn->query($sql) === TRUE) {
        // Redirigir de vuelta a categorias.php después de la edición
        header('Location: preguntas.php');
        exit();
    } else {
        echo 'Error al actualizar la categoría: ' . $conn->error;
        echo 'No se envió el formulario.';
    }
}
?>



