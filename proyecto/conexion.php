<?php
// Carlos Jordá Cernuda
// Datos de conexión al servidor SQL de la base de datos
$servername = "localhost";
$username = "root";
$password = "zero_krawen83";
$database = "bd_plataforma_examenes";

// Obtener las credenciales del formulario de inicio de sesión
$usuario = $_POST['username'];
$contraseña = $_POST['password'];

// Crear conexión
$conexion = new mysqli($servername, $username, $password, $database);

// Verificar si la conexión fue exitosa
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta SQL para verificar el usuario y la contraseña en la tabla usuarios
$consulta = "SELECT tipo_permiso FROM usuarios WHERE nombre = '$usuario' AND contraseña = '$contraseña'";
$resultado = $conexion->query($consulta);

// Verificar si se encontró un usuario con las credenciales proporcionadas
if ($resultado->num_rows > 0) {
    // Iniciar sesión
    session_start();
    
    // Obtener la fila de resultados como un array asociativo
    $fila = $resultado->fetch_assoc();
    
    // Guardar el tipo de permiso en una variable de sesión
    $_SESSION["tipo_permiso"] = $fila["tipo_permiso"];
        if($fila["tipo_permiso"]==="Administrador"){
    // Redirigir a la página de inicio
    header("Location: inicio.php");
    exit(); // Es importante terminar el script después de redirigir
} else if (($fila["tipo_permiso"]==="Docente")) {
    header("Location: inicio2.php");
} 
}else {
    // Credenciales incorrectas, mostrar mensaje de error
    echo "Nombre de usuario o contraseña incorrectos.";
}
    


// Cerrar la conexión a la base de datos
$conexion->close();
?>

