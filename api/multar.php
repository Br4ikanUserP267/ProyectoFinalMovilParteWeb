<?php
include "../components/conexion.php";
include "../settings/configuraciones.php";

$dbConn = connect($db);

// Listar todas las multas o una específica
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        // Mostrar una multa específica
        $sql = $dbConn->prepare("SELECT * FROM multas WHERE id=:id");
        $sql->bindValue(':id', $_GET['id']);
        $sql->execute();
        $multa = $sql->fetch(PDO::FETCH_ASSOC);

        $response = array(
            'multa' => $multa
        );

        header("HTTP/1.1 200 OK");
        echo json_encode($response);
        exit();
    } else {
        // Mostrar todas las multas
        $sql = $dbConn->prepare("SELECT * FROM multas");
        $sql->execute();
        $multas = $sql->fetchAll(PDO::FETCH_ASSOC);

        $response = array(
            'multas' => $multas
        );

        header("HTTP/1.1 200 OK");
        echo json_encode($response);
        exit();
    }
}

// Crear una nueva multa
// Crear una nueva multa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener la fecha actual del sistema
    $fechaActual = date("Y-m-d");

    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, true);

    // Verificar que los campos requeridos estén establecidos y no estén vacíos
    $requiredFields = ['Prestamos_id', 'motivos_multa'];
    $missingFields = [];

    foreach ($requiredFields as $field) {
        if (empty($input[$field])) {
            $missingFields[] = $field;
        }
    }

    if (empty($missingFields)) {
        // Obtener el motivo_id según el motivo_multa
        $motivosMulta = $input['motivos_multa'];
        $sql = $dbConn->prepare("SELECT id FROM motivos_multa WHERE motivo=:motivo");
        $sql->bindValue(':motivo', $motivosMulta);
        $sql->execute();
        $motivo = $sql->fetch(PDO::FETCH_ASSOC);

        if (!$motivo) {
            header("HTTP/1.1 404 Not Found");
            exit();
        }

        // Calcular el monto como el 4% de 1,000,000
        $monto = 0.04 * 1000000;

        // Establecer la conexión a la base de datos
        $dbConn = connect($db);

        // Insertar la nueva multa en la base de datos
        $sql = "INSERT INTO multas (fecha, motivo_id, monto, Prestamos_id) VALUES (:fecha, :motivoId, :monto, :prestamoId)";
        $statement = $dbConn->prepare($sql);
        $statement->bindValue(':fecha', $fechaActual);
        $statement->bindValue(':motivoId', $motivo['id']);
        $statement->bindValue(':monto', $monto);
        $statement->bindValue(':prestamoId', $input['Prestamos_id']);
        $statement->execute();
        $multaId = $dbConn->lastInsertId();

        if ($multaId) {
            $input['id'] = $multaId;

            $response = array(
                'status' => 'success',
                'message' => 'Multa creada exitosamente',
                'data' => $input
            );
            header("HTTP/1.1 200 OK");
            echo json_encode($response);
            exit();
        } else {
            // Si falla la inserción en la base de datos
            $response = array(
                'status' => 'error',
                'message' => 'Error al insertar la multa en la base de datos'
            );
            header("HTTP/1.1 500 Internal Server Error");
            echo json_encode($response);
            exit();
        }
    } else {
        // Si faltan campos requeridos o están vacíos
        $response = array(
            'status' => 'error',
            'message' => 'Faltan datos requeridos para crear la multa',
            'missingFields' => $missingFields
        );
        header("HTTP/1.1 400 Bad Request");
        echo json_encode($response);
        exit();
    }
}

?>