<?php
include "../components/conexion.php";
include "../settings/configuraciones.php";

$dbConn = connect($db);

// Obtener todos los registros de la tabla "prestamos"
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $query = "SELECT p.*, l.* FROM prestamos p
              INNER JOIN prestamos_has_libros pl ON p.id = pl.Prestamos_id
              INNER JOIN libros l ON pl.Libros_id = l.id";
    $stmt = $dbConn->prepare($query);
    $stmt->execute();
    $prestamos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($prestamos);
}


// Crear un nuevo préstamo
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos enviados en la solicitud
    $data = json_decode(file_get_contents("php://input"), true);
    $libroId = $data['Libros_id'];
    $fechaInicio = $data['fechaInicio'];
    $fechaFinal = $data['fechaFinal'];
    $prestado = $data['prestado'];
    $estudianteId = $data['Estudiantes_id'];

    // Insertar el nuevo préstamo en la tabla "prestamos"
    $query = "INSERT INTO prestamos (fechaInicio, fechaFinal, prestado, Estudiantes_id) VALUES (:fechaInicio, :fechaFinal, :prestado, :estudianteId)";
    $stmt = $dbConn->prepare($query);
    $stmt->bindParam(':fechaInicio', $fechaInicio);
    $stmt->bindParam(':fechaFinal', $fechaFinal);
    $stmt->bindParam(':prestado', $prestado);
    $stmt->bindParam(':estudianteId', $estudianteId);
    $stmt->execute();

    // Obtener el ID del nuevo préstamo insertado
    $prestamoId = $dbConn->lastInsertId();

    // Insertar la relación entre el préstamo y el libro en la tabla "prestamos_has_libros"
    $query = "INSERT INTO prestamos_has_libros (Prestamos_id, Libros_id) VALUES (:prestamoId, :libroId)";
    $stmt = $dbConn->prepare($query);
    $stmt->bindParam(':prestamoId', $prestamoId);
    $stmt->bindParam(':libroId', $libroId);
    $stmt->execute();

    // Devolver la respuesta con el ID del nuevo préstamo creado
    $response = array('prestamoId' => $prestamoId);
    echo json_encode($response);
}










?>