<?php 

$servername = "localhost";
$username = "root";
$password = "";
$database = "registros";

$conn = new mysqli($servername, $username, $password, $database);
$conn->set_charset("utf8mb4");

if ($conn->connect_errno){
    die("conexion fallida". $conn->connect_errno);
} else {
    //echo "conectado";
}

?>