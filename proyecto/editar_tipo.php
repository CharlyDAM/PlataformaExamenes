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
    $sql = "SELECT * FROM tipospreguntas WHERE id = $categoria_id";
    $result = $conn->query($sql);
    
    if($result->num_rows > 0) {
        // Obtener los datos de la categoría
        $categoria = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Dificultades</title>
    <link rel="stylesheet" href="css\estilogeneral.css">
    
</head>
<body>
<div class="contenedor">
    <header class="cabecera">
        <h1>CJCAGPEX</h1>
    </header>
    <h2>Editar Tipos de preguntas</h2>
    <main class="area-trabajo">
    <form action="editar_tipo.php" method="POST">
        <input type="hidden" name="categoria_id" value="<?php echo $categoria['id']; ?>">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $categoria['nombre']; ?>"><br><br>
        <input type="submit" name="submit" class="boton" value="Modificar">
    </form>
    <br><br><br>
    <a href="tipospreguntas.php" class="boton">Volver</a>
    </main>
    </div>
</body>
</html>
<?php
    } else {
        echo 'El tipo de pregunta no existe no existe.';
    }
} else {
    echo 'No se proporcionó ID del tipo de pregunta.';
}
// editar_categoria.php


// Verificar si se envió el formulario
if(isset($_POST['submit'])) {
    // Obtener los datos del formulario
    $categoria_id = $_POST['categoria_id'];
    $nuevo_nombre = $_POST['nombre'];
    
    // Actualizar la categoría en la base de datos
    $sql = "UPDATE tipospreguntas SET nombre = '$nuevo_nombre' WHERE id = $categoria_id";
    if($conn->query($sql) === TRUE) {
        // Redirigir de vuelta a categorias.php después de la edición
        header('Location: tipospreguntas.php');
        exit();
    } else {
        echo 'Error al actualizar la categoría: ' . $conn->error;
        echo 'No se envió el formulario.';
    }
}
?>



