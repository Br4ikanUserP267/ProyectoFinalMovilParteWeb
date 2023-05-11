<?php
include "../components/conexion.php";
include "../settings/configuraciones.php";

$dbConn = connect($db);

// Listar todas las categorias o una en específico
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        // Mostrar una categoria específica
        $sql = $dbConn->prepare("SELECT * FROM categorias WHERE id=:id");
        $sql->bindValue(':id', $_GET['id']);
        $sql->execute();
        header("HTTP/1.1 200 OK");
        echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
        exit();
    } else {
        // Mostrar todas las categorias
        $sql = $dbConn->prepare("SELECT * FROM categorias");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode($sql->fetchAll());
        exit();
    }
}

// Crear una nueva categoria
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = $_POST;

    // Verificar que las variables requeridas no estén vacías
    if (!empty($input['nombre'])) {
        $sql = "INSERT INTO categorias (nombre) VALUES (:nombre)";
        $statement = $dbConn->prepare($sql);
        $statement->bindParam(':nombre', $input['nombre']);
        $statement->execute();
        $categoriaId = $dbConn->lastInsertId();

        if ($categoriaId) {
            $input['id'] = $categoriaId;
            header("HTTP/1.1 200 OK");
            echo json_encode($input);
            exit();
        }
    } else {
        header("HTTP/1.1 400 Bad Request");
        exit();
    }
}

// Borrar una categoria
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    try {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $statement = $dbConn->prepare("DELETE FROM categorias WHERE id=:id");
        $statement->bindValue(':id', $id);
        $statement->execute();
        header("HTTP/1.1 200 OK");
        exit();
    } catch (PDOException $ex) {
        header("HTTP/1.1 500 Internal Server Error");
        exit();
    }
}

// Actualizar una categoria
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"), $input);
    $categoriaId = filter_var($input['id'], FILTER_SANITIZE_NUMBER_INT);

    // Verificar que al menos un campo a actualizar esté presente
    if (count($input) > 1) {
        $fields = getParams($input);

        $sql = "UPDATE categorias SET $fields WHERE id=:id";

        $statement = $dbConn->prepare($sql);
        $statement->bindValue(':id', $categoriaId);
        bindAllValues($statement, $input);

        $statement->execute();
        header("HTTP/1.1 200 OK");
        exit();
    } else {
        header("HTTP/1.1 400 Bad Request");
        exit();
    }
}
?>
