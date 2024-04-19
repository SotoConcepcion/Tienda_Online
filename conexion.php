<?php

$servername = "localhost";
$username = "root";  // Reemplaza con tu nombre de usuario de MySQL
$password = "";  // Reemplaza con tu contraseña de MySQL
$dbname = "tienda_c";  // Reemplaza con el nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Establecer el conjunto de caracteres a UTF-8 (opcional)
$conn->set_charset("utf8");

?>
