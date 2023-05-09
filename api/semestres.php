<?php
include "../components/conexion.php";
include "../settings/configuraciones.php";

$dbConn = connect($db);

// List all semestres or a specific one
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        // Show a specific semestre
        $sql = $dbConn->prepare("SELECT * FROM semestre WHERE id=:id");
        $sql->bindValue(':id', $_GET['id']);
        $sql->execute();
        header("HTTP/1.1 200 OK");
        echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
        exit();
    } else {
        // Show all semestres
        $sql = $dbConn->prepare("SELECT * FROM semestre");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode($sql->fetchAll());
        exit();
    }
}

// Create a new semestre
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = $_POST;

    // Check that the required variables are set and not empty
    if (!empty($input['numero'])) {
        $sql = "INSERT INTO semestre (numero) VALUES (:numero)";
        $statement = $dbConn->prepare($sql);
        bindAllValues($statement, $input);
        $statement->execute();
        $semestreId = $dbConn->lastInsertId();

        if ($semestreId) {
            $input['id'] = $semestreId;
            header("HTTP/1.1 200 OK");
            echo json_encode($input);
            exit();
        }
    } else {
        header("HTTP/1.1 400 Bad Request");
        exit();
    }
}

// Delete a semestre
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    try {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $statement = $dbConn->prepare("DELETE FROM semestre WHERE id=:id");
        $statement->bindValue(':id', $id);
        $statement->execute();
        header("HTTP/1.1 200 OK");
        exit();
    } catch (PDOException $ex) {
        header("HTTP/1.1 500 Internal Server Error");
        exit();
    }
}

// Update a semestre
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"), $input);
    $semestreId = filter_var($input['id'], FILTER_SANITIZE_NUMBER_INT);
    $fields = getParams($input);

    $sql = "UPDATE semestre SET $fields WHERE id=:id";

    $statement = $dbConn->prepare($sql);
    $statement->bindValue(':id', $semestreId);
    bindAllValues($statement, $input);

    $statement->execute();
    header("HTTP/1.1 200 OK");
    exit();
}
?>
