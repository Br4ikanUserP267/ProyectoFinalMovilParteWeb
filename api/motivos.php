<?php
include "../components/conexion.php";
include "../settings/configuraciones.php";

$dbConn = connect($db);


// Listar todos los motivos o solo uno
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        // Mostrar un motivo
        $sql = $dbConn->prepare("SELECT * FROM motivos WHERE id=:id");
        $sql->bindValue(':id', $_GET['id']);
        $sql->execute();
        header("HTTP/1.1 200 OK");
        echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
        exit();
    } else {
        // Mostrar lista de motivos
        $sql = $dbConn->prepare("SELECT * FROM motivos");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode($sql->fetchAll());
        exit();
    }
}


// Crear un nuevo motivo
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = $_POST;
    // Verificar que las variables requeridas estén establecidas y no estén vacías
    if (!empty($input['descripcion'])) {
        // Establecer la conexión a la base de datos
        $dbConn = connect($db);

        $sql = "INSERT INTO motivos (descripcion) VALUES (:descripcion)";
        $statement = $dbConn->prepare($sql);
        bindAllValues($statement, $input);
        $statement->execute();
        $motivoId = $dbConn->lastInsertId();

        if ($motivoId) {
            $input['id'] = $motivoId;
            $response = array(
                'status' => 'success',
                'message' => 'Motivo creado exitosamente',
                'data' => $input
            );
            header("HTTP/1.1 200 OK");
            echo json_encode($response);
            exit();
        }
    }

    // Si llegamos a este punto, significa que ha ocurrido un error
    $response = array(
        'status' => 'error',
        'message' => 'Error al crear el motivo'
    );
    header("HTTP/1.1 400 Bad Request");
    echo json_encode($response);
    exit();
}

// Borrar un motivo
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    try {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $statement = $dbConn->prepare("DELETE FROM motivos WHERE id=:id");
        $statement->bindValue(':id', $id);
        $statement->execute();
        header("HTTP/1.1 200 OK");
        exit();
    } catch (PDOException $ex) {
        header("HTTP/1.1 500 Internal Server Error");
        exit();
    }
}


// Actualizar un motivo
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"), $input);
    $motivoId = filter_var($input['id'], FILTER_SANITIZE_NUMBER_INT);
    $fields = getParams($input);

    $sql = "UPDATE motivos SET $fields WHERE id=:id";

    $statement = $dbConn->prepare($sql);
    $statement->bindValue(':id', $motivoId);
    bindAllValues($statement, $input);

    $statement->execute();
    header("HTTP/1.1 200 OK");
    exit();
}

?>
