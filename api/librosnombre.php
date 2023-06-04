<?php
include "../components/conexion.php";
include "../settings/configuraciones.php";

$dbConn = connect($db); // Conexión a la base de datos

// Verificar el método de solicitud
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Verificar si se proporcionó un ID específico
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM libros WHERE id = :id";
        $statement = $dbConn->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            header("HTTP/1.1 200 OK");
            echo json_encode($result);
        } else {
            header("HTTP/1.1 404 Not Found");
            echo "El libro con ID $id no existe";
        }
        exit();
    } else {
        $sql = "SELECT * FROM libros";
        $statement = $dbConn->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        if ($result) {
            header("HTTP/1.1 200 OK");
            echo json_encode($result);
        } else {
            header("HTTP/1.1 404 Not Found");
            echo "No se encontraron libros";
        }
        exit();
    }
}

//http://localhost/proyectoFinal/api/librosnombre.php?id=2