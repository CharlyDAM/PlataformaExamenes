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

// Consulta para obtener las categorías disponibles
$sql_categorias = "SELECT id, nombre FROM categorias";
$result_categorias = $conn->query($sql_categorias);

// Consulta para obtener las subcategorías disponibles
$sql_subcategorias = "SELECT id, nombre FROM subcategorias";
$result_subcategorias = $conn->query($sql_subcategorias);

// Consulta para obtener las dificultades disponibles
$sql_dificultades = "SELECT id, nombre FROM dificultades";
$result_dificultades = $conn->query($sql_dificultades);

// Consulta para obtener los tipos de pregunta disponibles
$sql_tipos_pregunta = "SELECT id, nombre FROM tipospreguntas";
$result_tipos_pregunta = $conn->query($sql_tipos_pregunta);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Preguntas</title>
    <link rel="stylesheet" href="css/estilogeneral.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
</head>
<body>
<div class="contenedor">
    <header class="cabecera">
        <h1>CJC.A.G.P.EX</h1>
    </header>
    <h2>Crear Nueva Pregunta</h2>
    <main class="area-trabajo"> 
    
    <form action="guardar_pregunta.php" method="post">
        <label for="categoria">Categoría:</label>
        <select id="categoria" name="categoria">
            <?php
            if ($result_categorias->num_rows > 0) {
                while($row = $result_categorias->fetch_assoc()) {
                    echo "<option value='" . $row["id"] . "'>" . $row["nombre"] . "</option>";
                }
            }
            ?>
        </select><br><br>

        <label for="subcategoria">Subcategoría:</label>
        <select id="subcategoria" name="subcategoria">
        </select><br><br>

        <label for="dificultad">Dificultad:</label>
        <select id="dificultad" name="dificultad">
            <?php
            if ($result_dificultades->num_rows > 0) {
                while($row = $result_dificultades->fetch_assoc()) {
                    echo "<option value='" . $row["id"] . "'>" . $row["nombre"] . "</option>";
                }
            }
            ?>
        </select><br><br>

        <label for="tipo_pregunta">Tipo de Pregunta:</label>
        <select id="tipo_pregunta" name="tipo_pregunta">
            <?php
            if ($result_tipos_pregunta->num_rows > 0) {
                while($row = $result_tipos_pregunta->fetch_assoc()) {
                    echo "<option value='" . $row["id"] . "'>" . $row["nombre"] . "</option>";
                }
            }
            ?>
        </select><br><br>

        <label for="pregunta">Pregunta:</label><br>
        <textarea id="pregunta" name="pregunta" rows="4" cols="50"></textarea><br><br>

        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion" rows="4" cols="50"></textarea><br><br>

        <label for="pistas">Pistas:</label><br>
        <textarea id="pistas" name="pistas" rows="4" cols="50"></textarea><br><br>

        <button type="submit" name="submit"class="boton">Guardar Pregunta</button>
    </form>

    <script>
        $(document).ready(function(){
            // Función para cargar las subcategorías relacionadas con la categoría seleccionada
            function cargarSubcategorias(categoria_id) {
                // Realizar una solicitud AJAX para obtener las subcategorías relacionadas
                $.ajax({
                    url: 'obtener_subcategorias.php',
                    type: 'POST',
                    data: {categoria_id: categoria_id},
                    success: function(response) {
                        // Actualizar las opciones del desplegable de subcategorías
                        $('#subcategoria').html(response);
                    }
                });
            }

            // Cuando se cambia la categoría seleccionada
            $('#categoria').change(function(){
                var categoria_id = $(this).val(); // Obtener el ID de la categoría seleccionada
                cargarSubcategorias(categoria_id); // Cargar las subcategorías relacionadas
            });

            // Al cargar la página, cargar las subcategorías relacionadas con la categoría preseleccionada
            var categoria_preseleccionada = $('#categoria').val();
            cargarSubcategorias(categoria_preseleccionada);
        });
    </script>
    </main>
    </div>
</body>
</html>
<footer>
    <br><br><br>
<a href="preguntas.php" class="boton">Ir a Preguntas</a>
</footer>
</html>