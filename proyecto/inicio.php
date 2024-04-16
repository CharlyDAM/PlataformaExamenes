<?php
// Verificar la sesión antes de mostrar la página
session_start();

// Verificar si la sesión está establecida para el usuario
if (!isset($_SESSION['tipo_permiso'])) {
    // Si no hay sesión, redirige a la página de inicio de sesión
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="css\estilogeneral.css">
</head>
<body>
    
<div class="contenedor">
    <header class="cabecera">
        <h1>CJC.A.G.P.EX</h1>
    </header>
    <main class="area-trabajo">
    <div class="form-group">
        <div class="botones">
            <a href="categorias.php" class="boton">Categorías</a>
            <a href="dificultades.php" class="boton">Dificultades</a>
            <a href="tipospreguntas.php" class="boton">TiposDePreguntas</a>
            <a href="preguntas.php" class="boton">Preguntas</a>
        </div>    
    </div>

 </main> 
</div> 

</body>
<br>

<footer>
<div class="botones">
<a href="cerrar_sesion.php" class="pie">Cerrar sesión</a>
<a href="BaseDatos.html" class="pie">Base datos</a>

</div>
</footer>
</html>
