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
$id_cliente = isset($_POST['id_cliente']) ? $_POST['id_cliente'] : null;
$fecha_reserva = isset($_POST['fecha_reserva']) ? $_POST['fecha_reserva'] : null;
$id_vuelo = isset($_POST['id_vuelo']) ? $_POST['id_vuelo'] : null;
$id_hotel = isset($_POST['id_hotel']) ? $_POST['id_hotel'] : null;

// Validar y limpiar datos (ejemplo simple)
if (!empty($id_cliente) && !empty($fecha_reserva) && !empty($id_vuelo) && !empty($id_hotel)) {
    // Verificar si el id_vuelo existe en la tabla VUELO
    $check_vuelo_query = "SELECT id_vuelo FROM VUELO WHERE id_vuelo = ?";
    $stmt_check_vuelo = $conn->prepare($check_vuelo_query);
    $stmt_check_vuelo->bind_param("i", $id_vuelo);
    $stmt_check_vuelo->execute();
    $stmt_check_vuelo->store_result();

    if ($stmt_check_vuelo->num_rows > 0) {
        // El id_vuelo existe, procede a insertar la reserva
        $insert_reserva_query = "INSERT INTO RESERVA (id_cliente, fecha_reserva, id_vuelo, id_hotel) VALUES (?, ?, ?, ?)";
        $stmt_insert_reserva = $conn->prepare($insert_reserva_query);
        $stmt_insert_reserva->bind_param("isii", $id_cliente, $fecha_reserva, $id_vuelo, $id_hotel);

        if ($stmt_insert_reserva->execute() === TRUE) {
            echo "Reserva agregada exitosamente";
        } else {
            echo "Error al agregar reserva: " . $stmt_insert_reserva->error;
        }

        $stmt_insert_reserva->close();
    } else {
        echo "El id_vuelo especificado no existe en la tabla VUELO";
    }

    $stmt_check_vuelo->close();
} else {
    echo "Todos los campos son obligatorios.";
}

$conn->close();
?>