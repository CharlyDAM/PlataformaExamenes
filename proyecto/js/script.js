document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('login-form');
    const errorMessage = document.getElementById('error-message');

    loginForm.addEventListener('submit', function(event) {
        event.preventDefault();
        
        const username = document.getElementById('nombre').value;
        const password = document.getElementById('contraseña').value;

        // Aquí puedes agregar la lógica para validar el usuario y la contraseña
        // Por ejemplo, podrías hacer una solicitud AJAX a tu backend PHP para verificar las credenciales

        // Ejemplo básico de validación
        if (username === 'nombre' && password === 'contraseña') {
            // Si las credenciales son válidas, redirige a la página de inicio
            window.location.href = 'inicio.html';
        } else {
            // Si las credenciales son inválidas, muestra un mensaje de error
            errorMessage.textContent = 'Usuario o contraseña incorrectos';
        }
    });
});
