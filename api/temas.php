<?php
include "../components/conexion.php";
include "../settings/configuraciones.php";

$dbConn = connect($db);

// List all temas or a specific one
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        // Show a specific tema
        $sql = $dbConn->prepare("SELECT * FROM temas WHERE id=:id");
        $sql->bindValue(':id', $_GET['id']);
        $sql->execute();
        header("HTTP/1.1 200 OK");
        echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
        exit();
    } else {
        // Show all temas
        $sql = $dbConn->prepare("SELECT * FROM temas");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode($sql->fetchAll());
        exit();
    }
}

// Create a new tema
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = $_POST;

    // Check that the required variables are set and not empty
    if (!empty($input['nombre']) && !empty($input['Categorias_id'])) {
        $sql = "INSERT INTO temas (nombre, Categorias_id) VALUES (:nombre, :categoriasId)";
        $statement = $dbConn->prepare($sql);
        $statement->bindValue(':nombre', $input['nombre']);
        $statement->bindValue(':categoriasId', $input['Categorias_id']);
        $statement->execute();
        $temaId = $dbConn->lastInsertId();

        if ($temaId) {
            $input['id'] = $temaId;
            header("HTTP/1.1 200 OK");
            echo json_encode($input);
            exit();
        }
    } else {
        header("HTTP/1.1 400 Bad Request");
        exit();
    }
}

// Delete a tema
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    try {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $statement = $dbConn->prepare("DELETE FROM temas WHERE id=:id");
        $statement->bindValue(':id', $id);
        $statement->execute();
        header("HTTP/1.1 200 OK");
        exit();
    } catch (PDOException $ex) {
        header("HTTP/1.1 500 Internal Server Error");
        exit();
    }
}

// Update a tema
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"), $input);
    $temaId = filter_var($input['id'], FILTER_SANITIZE_NUMBER_INT);
    $nombre = filter_var($input['nombre'], 'FILTER_SANITIZE_STRING');
    $categoriasId = filter_var($input['Categorias_id'], FILTER_SANITIZE_NUMBER_INT);

    $sql = "UPDATE temas SET nombre=:nombre, Categorias_id=:categoriasId WHERE id=:id";

    $statement = $dbConn->prepare($sql);
    $statement->bindValue(':id', $temaId);
    $statement->bindValue(':nombre', $nombre);
    $statement->bindValue(':categoriasId', $categoriasId);

    $statement->execute();
    header("HTTP/1.1 200 OK");
    exit();
}
?>
