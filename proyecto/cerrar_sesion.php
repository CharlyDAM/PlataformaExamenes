<?php
// Inicia la sesión si no está iniciada
    session_start();

    // Elimina todas las variables de sesión
    $_SESSION = array();
   

    // Finalmente, destruye la sesión
    session_destroy();

    // Redirige al usuario a la página index.html
    header("Location: index.php");
    exit();
?>