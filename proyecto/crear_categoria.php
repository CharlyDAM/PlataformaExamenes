<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Categoría</title>
</head>
<body>
    <h2>Crear Nueva Categoría</h2>
    <form action="guardar_categoria.php" method="post">
        <label for="nombre">Nombre de la categoría:</label>
        <input type="text" id="nombre" name="nombre" required>
        <input type="text" id="categoria" name="categoria_padre_id" required>
        <br><br>
        <input type="submit" value="Guardar">
    </form>
</body>
</html>
