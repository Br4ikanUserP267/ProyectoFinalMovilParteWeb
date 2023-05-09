<?php
include "../components/conexion.php";
include "../settings/configuraciones.php";

$dbConn = connect($db);

// List all inscripciones or a specific one
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        // Show a specific inscripcion
        $sql = $dbConn->prepare("SELECT * FROM inscripciones WHERE id=:id");
        $sql->bindValue(':id', $_GET['id']);
        $sql->execute();
        header("HTTP/1.1 200 OK");
        echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
        exit();
    } else {
        // Show all inscripciones
        $sql = $dbConn->prepare("SELECT * FROM inscripciones");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode($sql->fetchAll());
        exit();
    }
}

// Create a new inscripcion
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = $_POST;

    // Check that the required variables are set and not empty
    if (!empty($input['descripcion']) && !empty($input['fecha']) && !empty($input['Semestre_numero']) && !empty($input['Carrera_id']) && !empty($input['estudiantes_id'])) {
        $sql = "INSERT INTO inscripciones (descripcion, fecha, Semestre_numero, Carrera_id, estudiantes_id) VALUES (:descripcion, :fecha, :Semestre_numero, :Carrera_id, :estudiantes_id)";
        $statement = $dbConn->prepare($sql);
        bindAllValues($statement, $input);
        $statement->execute();
        $inscripcionId = $dbConn->lastInsertId();

        if ($inscripcionId) {
            $input['id'] = $inscripcionId;
            header("HTTP/1.1 200 OK");
            echo json_encode($input);
            exit();
        }
    } else {
        header("HTTP/1.1 400 Bad Request");
        exit();
    }
}

// Delete an inscripcion
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    try {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $statement = $dbConn->prepare("DELETE FROM inscripciones WHERE id=:id");
        $statement->bindValue(':id', $id);
        $statement->execute();
        header("HTTP/1.1 200 OK");
        exit();
    } catch (PDOException $ex) {
        header("HTTP/1.1 500 Internal Server Error");
        exit();
    }
}

// Update an inscripcion
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"), $input);
    $inscripcionId = filter_var($input['id'], FILTER_SANITIZE_NUMBER_INT);
    $fields = getParams($input);

    $sql = "UPDATE inscripciones SET $fields WHERE id=:id";

    $statement = $dbConn->prepare($sql);
    $statement->bindValue(':id', $inscripcionId);
    bindAllValues($statement, $input);

    $statement->execute();
    header("HTTP/1.1 200 OK");
    exit();
}
?>
