<?php
$servidor = "localhost";
$nombreusuario = "root";
$password = "";
$dbname = "agencia"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servidor, $nombreusuario, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$ubicacion = isset($_POST['ubicacion']) ? trim($_POST['ubicacion']) : '';
$habitaciones_disponibles = isset($_POST['habitaciones_disponibles']) ? intval($_POST['habitaciones_disponibles']) : 0;
$tarifa_noche = isset($_POST['tarifa_noche']) ? floatval($_POST['tarifa_noche']) : 0.0;

// Validar y limpiar datos
if (!empty($nombre) && !empty($ubicacion) && $habitaciones_disponibles > 0 && $tarifa_noche > 0.0) {
    // Insertar datos en la tabla HOTEL usando consultas preparadas
    $stmt = $conn->prepare("INSERT INTO HOTEL (nombre, ubicacion, habitaciones_disponibles, tarifa_noche) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $nombre, $ubicacion, $habitaciones_disponibles, $tarifa_noche);
    
    if ($stmt->execute() === TRUE) {
        echo "Hotel agregado exitosamente";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Todos los campos son obligatorios y deben tener valores válidos.";
}

$conn->close();
?>
