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
$origen = isset($_POST['origen']) ? trim($_POST['origen']) : '';
$destino = isset($_POST['destino']) ? trim($_POST['destino']) : '';
$fecha = isset($_POST['fecha']) ? trim($_POST['fecha']) : '';
$plazas_disponibles = isset($_POST['plazas_disponibles']) ? intval($_POST['plazas_disponibles']) : 0;
$precio = isset($_POST['precio']) ? floatval($_POST['precio']) : 0.0;

// Validar y limpiar datos
if (!empty($origen) && !empty($destino) && !empty($fecha) && $plazas_disponibles > 0 && $precio > 0.0) {
    // Insertar datos en la tabla VUELO usando consultas preparadas
    $stmt = $conn->prepare("INSERT INTO VUELO (origen, destino, fecha, plazas_disponibles, precio) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdi", $origen, $destino, $fecha, $plazas_disponibles, $precio);
    
    if ($stmt->execute() === TRUE) {
        echo "Vuelo agregado exitosamente";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Todos los campos son obligatorios y deben tener valores válidos.";
}

$conn->close();
?>