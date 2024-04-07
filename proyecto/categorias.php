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
$sql = "SELECT * FROM categorias";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Categorías</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 12%;
    padding: 12%;
    display: flexbox;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f0f0f0;
}
        
        .botones {
          
            justify-content: center;
            margin-top: 20px;
        }
        
        .boton {
            padding: 10px 20px;
            margin: 0 10px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        
        .boton:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Gestión de Categorías</h1>
    

    <!-- Menú desplegable con las categorías existentes -->
    <form action="accion_categoria.php" method="post">
        <select name="categoria_id">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?><?php echo $row['categoria_padre_id']; ?></option>
            <?php } ?>
        </select>

        <div class="botones">
    <a <!-- Botón para abrir el formulario de creación de categoría -->
    <button id="btnCrearCategoria">Crear Categoría</button>

    <!-- Script para abrir la ventana/modal al hacer clic en el botón -->
    <script>
    document.getElementById("btnCrearCategoria").addEventListener("click", function() {
    // Abre una nueva ventana o modal
    window.open("crear_categoria.php", "_blank", "width=400,height=400");
    });
    </script>

    <a href="borrarcategoria.php" class="boton">Borrar</a>
    <a href="editarcategoria.php" class="boton">Editar</a>
   
    </div>
        
    </form>

    <?php
    // Cerrar la conexión a la base de datos
    $conn->close();
    ?>
</body>
</html>

<?php
// Verificar si se ha enviado una acción y el usuario es administrador
if ($_SERVER["REQUEST_METHOD"] == "POST" && $es_administrador) {
    $accion = $_POST["accion"];
    $categoria_id = $_POST["categoria_id"];

    // Procesar la acción seleccionada
    switch ($accion) {
        case "editar":
            // Redirigir a la página de edición con el ID de la categoría seleccionada
            header("Location: editar_categoria.php?categoria_id=$categoria_id");
            exit();
        case "borrar":
            // Realizar la eliminación de la categoría seleccionada
            // (debes implementar la lógica para la eliminación)
            break;
        case "crear":
            // Redirigir a la página de creación de categorías
            header("Location: crear_categoria.php");
            exit();
    }
}
?>
