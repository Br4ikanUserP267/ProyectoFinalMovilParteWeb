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
    $input = json_decode(file_get_contents('php://input'), true);


    // Check that the required variables are set and not empty
    $requiredFields = array('descripcion', 'fecha', 'Semestre_numero', 'Carrera_id', 'estudiantes_id');
    $missingFields = array_diff($requiredFields, array_keys($input));
    if (!empty($missingFields)) {
        $missingFieldsStr = implode(", ", $missingFields);
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(array("message" => "Faltan los siguientes campos requeridos: " . $missingFieldsStr));
        exit();
    }

    // Prepare the SQL statement
    $sql = 
    "INSERT INTO inscripciones (descripcion, fecha, Semestre_numero, Carrera_id, estudiantes_id) 
    VALUES (:descripcion, :fecha, :Semestre_numero, :Carrera_id, :estudiantes_id)";
    $statement = $dbConn->prepare($sql);

    // Bind the parameters to the prepared statement
    $statement->bindParam(':descripcion', $input['descripcion']);
    $statement->bindParam(':fecha', $input['fecha']);
    $statement->bindParam(':Semestre_numero', $input['Semestre_numero']);
    $statement->bindParam(':Carrera_id', $input['Carrera_id']);
    $statement->bindParam(':estudiantes_id', $input['estudiantes_id']);

    // Execute the statement
    if ($statement->execute()) {
        $inscripcionId = $dbConn->lastInsertId();
        $input['id'] = $inscripcionId;
        header("HTTP/1.1 200 OK");
        echo json_encode($input);
        exit();
    } else {
        $errorInfo = $statement->errorInfo();
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(array("message" => "Error al ejecutar la consulta SQL: " . $errorInfo[2]));
        exit();
    }
} else {
    header("HTTP/1.1 400 Bad Request");
    exit();
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
