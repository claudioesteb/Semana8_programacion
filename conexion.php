<?php
   $servidor = "localhost";
   $nombreusuario = "root";
   $password = "";
   $dbname = "agencia"; // Nombre de la base de datos

   // Crear conexión
   $conn = new mysqli($servidor, $nombreusuario, $password,$dbname);

   // Verificar conexión
   if ($conn->connect_error) {
       die("Conexión fallida: " . $conn->connect_error);
   }

   // Crear tabla VUELO
   $sql = "CREATE TABLE VUELO (
       id_vuelo INT AUTO_INCREMENT PRIMARY KEY,
       origen VARCHAR(100),
       destino VARCHAR(100),
       fecha DATE,
       plazas_disponibles INT,
       precio DECIMAL(10, 2)
   )";

   if ($conn->query($sql) === TRUE) {
       echo "Tabla VUELO creada correctamente...<br>";
   } else {
       die("Error al crear tabla VUELO: " . $conn->error . "<br>");
   }

   // Crear tabla HOTEL
   $sql = "CREATE TABLE HOTEL (
       id_hotel INT AUTO_INCREMENT PRIMARY KEY,
       nombre VARCHAR(100),
       ubicacion VARCHAR(100),
       habitaciones_disponibles INT,
       tarifa_noche DECIMAL(10, 2)
   )";

   if ($conn->query($sql) === TRUE) {
       echo "Tabla HOTEL creada correctamente...<br>";
   } else {
       die("Error al crear tabla HOTEL: " . $conn->error . "<br>");
   }

   // Crear tabla RESERVA
   $sql = "CREATE TABLE RESERVA (
       id_reserva INT AUTO_INCREMENT PRIMARY KEY,
       id_cliente INT,
       fecha_reserva DATE,
       id_vuelo INT,
       id_hotel INT,
       FOREIGN KEY (id_vuelo) REFERENCES VUELO(id_vuelo),
       FOREIGN KEY (id_hotel) REFERENCES HOTEL(id_hotel)
   )";

   if ($conn->query($sql) === TRUE) {
       echo "Tabla RESERVA creada correctamente...<br>";
   } else {
       die("Error al crear tabla RESERVA: " . $conn->error . "<br>");
   }

   // Cerrar conexión
   $conn->close();
?>