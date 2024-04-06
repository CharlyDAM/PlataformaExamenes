<?php //Carlos Jordá Cernuda
//datos de conexión al servidor SQL de BBDD
$servername = "localhost";
$username = "root";
$password = "zero_krawen83";
$database = "bd_plataforma_examenes";


// Obtener las credenciales del formulario de inicio de sesión
$usuario = $_POST['username'];
$contraseña = $_POST['password'];

//Creamos conexión siempre usando el mismo orden de los parametros
$conexion = new mysqli($servername, $username,$password,$database);

// Verificar si la conexión fue exitosa
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}


// Consulta SQL para verificar el usuario y la contraseña en la tabla usuarios
$consulta = "SELECT * FROM usuarios WHERE nombre = '$usuario' AND contraseña = '$contraseña'";
$resultado = $conexion->query($consulta);

// Verificar si se encontró un usuario con las credenciales proporcionadas
if ($resultado->num_rows > 0) {
    // Inicio de sesión exitoso, redirigir a la página de inicio
    header("Location:inicio.html");
} else {
    // Credenciales incorrectas, mostrar mensaje de error
    echo "Nombre de usuario o contraseña incorrectos.";
    
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>