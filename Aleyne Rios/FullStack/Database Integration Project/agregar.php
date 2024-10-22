<?php
include "conection.php";

function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'register') {
        //Registro
        $nombre = sanitizeInput($_POST['name']);
        $apellido = sanitizeInput($_POST['lastname']);
        $email = sanitizeInput($_POST['email']);
        $pass = $_POST['password'];

        //Validaciones
        if (empty($nombre) || empty($apellido) || empty($email) || empty($pass)) {
            $message = "Todos los campos son obligatorios.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = "El formato del correo electrónico no es válido.";
        } else {
    
            $stmt = $conn->prepare("SELECT * FROM users WHERE correo=? LIMIT 1");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $message = "El correo electrónico ya está registrado.";
            } else {
                
                $hashedPassword = password_hash($pass, PASSWORD_DEFAULT); //Se cifra la contraseña por seguridad.
                $stmt = $conn->prepare("INSERT INTO users (nombre, apellido, correo, pass) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $nombre, $apellido, $email, $hashedPassword); //Se envia como parametro a la base de datos.

                if ($stmt->execute()) {
                    $message = "Registro exitoso.";
                } else {
                    $message = "Error: " . $stmt->error;
                }
            }
            $stmt->close();
        }
    }
}

$conn->close();
echo $message;
?>
