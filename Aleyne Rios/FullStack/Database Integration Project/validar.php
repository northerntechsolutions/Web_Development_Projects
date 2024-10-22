<?php
include "conection.php";

function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'login') {
        //Inicio de sesión
        $email = sanitizeInput($_POST['email']);
        $password = sanitizeInput($_POST['password']);

        //Validaciones
        if (empty($email) || empty($password)) {
            $message = "Todos los campos son obligatorios.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = "El formato del correo electrónico no es válido.";
        } else {
        
            $stmt = $conn->prepare("SELECT * FROM users WHERE correo=? LIMIT 1");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            
            if ($result->num_rows > 0) {
                $row = $result->fetch_array(MYSQLI_ASSOC);

                // Verificar la contraseña ingresada
                if (password_verify($password, $row['pass'])) {
                    $message = "Inicio de sesión exitoso.";
                } else {
                    $message = "Contraseña incorrecta.";
                }
            } else {
                $message = "Usuario no encontrado.";
            }

            $stmt->close();
        }
    }
}

$conn->close();
echo $message;
?>
