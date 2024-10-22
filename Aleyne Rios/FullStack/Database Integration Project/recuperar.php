<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <title>Recuperar Contraseña</title>
</head>
<body>
    <div class="container">
        <div class="form-container sign-in">
            <form method="POST" action="">
                <h1>Recuperar Contraseña</h1>
                <input type="email" name="email" placeholder="Correo Electrónico" required>
                <button type="submit">Enviar Token</button>
            </form>
        </div>

        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-right">
                    <h1>¡Qué tal, Amigo!</h1>
                    <p>Si recuerdas tu contraseña, solo ingresa</p>
                    <button class="hidden" id="login">Iniciar Sesión</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    const loginButton = document.getElementById('login');

    loginButton.addEventListener('click', function() {
        window.location.href = 'index.php';
    });
    </script>

</body>
</html>
