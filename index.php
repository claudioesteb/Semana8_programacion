<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agencia"; // Nombre de la base de datos
// Crear conexión
$conn = new mysqli($servername, $username, $password);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Crear base de datos
$sql = "CREATE DATABASE agencia";
if ($conn->query($sql) === TRUE) {
    echo "Base de datos creada exitosamente";
} else {
    echo "Error creando la base de datos: " . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
