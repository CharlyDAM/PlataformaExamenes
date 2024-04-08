<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
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
        
    .boton {
          
            justify-content: center;
            margin-top: 20px;
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
    <h1>Bienvenido a la aplicación</h1>
 
    <div class="botones">
    <a href="categorias.php" class="boton">Categorías</a>
    <a href="dificultades.php" class="boton">Dificultades</a>
    <a href="tipospreguntas.php" class="boton">TiposDePreguntas</a>
    <a href="preguntas.php" class="boton">Preguntas</a>
    </div>

  
 
</body>
<br><br><br>
<footer>
<div class="botones">
<a href="cerrar_sesion.php" class="boton">Cerrar sesión</a>
</div>
</footer>
</html>
