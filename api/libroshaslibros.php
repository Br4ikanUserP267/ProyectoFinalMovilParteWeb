<?php
include "../components/conexion.php";
include "../settings/configuraciones.php";

$dbConn = connect($db);

// Obtener todos los autores_has_libros
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT * FROM autores_has_libros";
    $statement = $dbConn->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    header("HTTP/1.1 200 OK");
    echo json_encode($result);
    exit();
}

// Crear una nueva relación entre autor y libro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Autores_id = $_POST['Autores_id'];
    $Libros_id = $_POST['Libros_id'];
    $fecha = $_POST['fecha'];

    $sql = "INSERT INTO autores_has_libros (Autores_id, Libros_id, fecha)
            VALUES (:Autores_id, :Libros_id, :fecha)";

    $statement = $dbConn->prepare($sql);
    $statement->bindValue(':Autores_id', $Autores_id);
    $statement->bindValue(':Libros_id', $Libros_id);
    $statement->bindValue(':fecha', $fecha);

    $statement->execute();
    $relation_id = $dbConn->lastInsertId();

    header("HTTP/1.1 201 Created");
    header("Location: /autores_has_libros/$relation_id");
    exit();
}

// Borrar una relación entre autor y libro
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    if (isset($_GET['Autores_id']) && isset($_GET['Libros_id'])) {
        $Autores_id = $_GET['Autores_id'];
        $Libros_id = $_GET['Libros_id'];

        $sql = "DELETE FROM autores_has_libros WHERE Autores_id = :Autores_id AND Libros_id = :Libros_id";
        $statement = $dbConn->prepare($sql);
        $statement->bindValue(':Autores_id', $Autores_id);
        $statement->bindValue(':Libros_id', $Libros_id);
        $statement->execute();

        header("HTTP/1.1 200 OK");
        echo "La relación entre autor y libro ha sido eliminada exitosamente";
        exit();
    } else {
        header("HTTP/1.1 400 Bad Request");
        echo "Se deben proveer los IDs de autor y libro válidos para eliminar una relación";
        exit();
    }
}
?>
