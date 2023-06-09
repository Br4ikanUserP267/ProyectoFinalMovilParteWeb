<?php
include "../components/conexion.php";
include "../settings/configuraciones.php";

$dbConn = connect($db);

// Obtener todos los libros con sus autores
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT libros.*, GROUP_CONCAT(autores.nombres SEPARATOR ', ') AS autores, editoriales.nombre AS nombre_editorial FROM libros
            INNER JOIN autores_has_libros ON libros.id = autores_has_libros.Libros_id
            INNER JOIN autores ON autores.id = autores_has_libros.Autores_idAutores
            INNER JOIN editoriales ON libros.Editoriales_id = editoriales.id
            GROUP BY libros.id";
    $statement = $dbConn->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    header("HTTP/1.1 200 OK");
    echo json_encode($result);
    exit();
}

// Resto del código de la API
// ...
?>

