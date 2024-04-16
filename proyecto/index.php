<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<div class="contenedor">
    <header class="cabecera">
        <h1>CJCAGPEX</h1>
    </header>   
    <main class="area-trabajo">
    <div class="login-container">
        <h2>Iniciar sesión</h2>
        <form action="conexion.php" method="POST">
            <div class="form-group">
                <label for="username">Nombre de usuario:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <br><br>
            <button type="submit"class="boton">Iniciar sesión</button>
        </form>
    </div>
    </main>
</div>
<?php
// Mostrar un mensaje de error si las credenciales son incorrectas
if(isset($_GET['error']) && $_GET['error'] === 'incorrect_credentials') {
    echo '<p style="color: red;">Nombre de usuario o contraseña incorrectos.</p>';
}
?>
</body>
</html>
