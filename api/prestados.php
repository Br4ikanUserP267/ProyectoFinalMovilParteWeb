<?php

include "../components/conexion.php";
include "../settings/configuraciones.php";



$dbConn = connect($db);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id_estudiante'])) {
        // Mostrar lista de préstamos para un estudiante específico con nombres de libros y prestado = 1
        $sql = $dbConn->prepare("SELECT prestamos.*, libros.nombre AS nombre_libro
        FROM prestamos
        INNER JOIN prestamos_has_libros ON prestamos.id = prestamos_has_libros.Prestamos_id
        INNER JOIN libros ON libros.id = prestamos_has_libros.Libros_id
        WHERE prestamos.Estudiantes_id = :estudianteId AND prestamos.prestado = 1");
        $sql->bindValue(':estudianteId', $_GET['id_estudiante']);
        $sql->execute();
        $prestamos = $sql->fetchAll(PDO::FETCH_ASSOC);

        // Eliminar el encabezado "prestamos" del resultado JSON
        $response = $prestamos;

        header("HTTP/1.1 200 OK");
        echo json_encode($response);
        exit();
    }
}



?>