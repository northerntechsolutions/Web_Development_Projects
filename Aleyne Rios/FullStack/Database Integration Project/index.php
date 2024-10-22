<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <title>Página de Inicio de Sesión | Registro</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="POST" action="agregar.php" id="register-form"> 
                <h1>CREAR CUENTA</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                </div>
                <span>o usa tu correo para registrarte</span>
                <input type="hidden" name="action" value="register">
                <input type="text" name="name" placeholder="Nombre" required>
                <input type="text" name="lastname" placeholder="Apellido" required>
                <input type="email" name="email" placeholder="Correo Electrónico" required>
                <div class="password-container">
                    <input type="password" name="password" placeholder="Contraseña" required>
                    <i class="fa-solid fa-eye toggle-password" id="toggle-password-register"></i>
                </div>
                <button type="submit">Registrarse</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="POST" action="validar.php" id="login-form">
                <h1>INICIAR SESIÓN</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                </div>
                <span>o usa tu correo y contraseña</span>
                <input type="hidden" name="action" value="login">
                <input type="email" name="email" placeholder="Correo Electrónico" required>
                <div class="password-container">
                    <input type="password" name="password" placeholder="Contraseña" required>
                    <i class="fa-solid fa-eye toggle-password" id="toggle-password-register"></i>
                </div>
                <a href="recuperar.php">¿Olvidaste tu contraseña?</a>
                <button type="submit">Iniciar Sesión</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>¡Bienvenido de nuevo, amigo!</h1>
                    <p>Ingresa tus datos personales para usar todas las funciones del sitio</p>
                    <button class="hidden" id="login">Iniciar Sesión</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>¡Hola, amigo!</h1>
                    <p>Regístrate con tus datos personales para usar todas las funciones del sitio</p>
                    <button class="hidden" id="register">Registrarse</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        //mostrar y ocultar contraseña
        $('.toggle-password').on('click', function() {
            const input = $(this).siblings('input');
            const type = input.attr('type') === 'password' ? 'text' : 'password';
            input.attr('type', type);
            $(this).toggleClass('fa-eye fa-eye-slash');
        });

        //Enviar los datos al archivo agregar.php
        $('#register-form').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: 'agregar.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    alert(response); 
                    if (response === 'Registro exitoso.') {
                        $('#register-form')[0].reset();
                    }
                },
                error: function() {
                    alert('Error al enviar el formulario de registro.');
                }
            });
        });

        //Enviar los datos al archivo validar.php
        $('#login-form').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: 'validar.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    alert(response);
                    if (response === 'Inicio de sesión exitoso.') {
                        $('#login-form')[0].reset();
                    } else {
                        $('input[name="password"]').val('');
                    }
                },
                error: function() {
                    alert('Error al enviar el formulario de inicio de sesión.');
                }
            });
        });
    });
    </script>

</body>
</html>
