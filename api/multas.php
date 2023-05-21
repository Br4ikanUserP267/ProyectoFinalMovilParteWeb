<?php
include "../components/conexion.php";
include "../settings/configuraciones.php";

$dbConn = connect($db);

// Obtener todas las multas
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT * FROM multas";
    $statement = $dbConn->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    header("HTTP/1.1 200 OK");
    echo json_encode($result);
    exit();
}

// Crear una nueva multa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fecha = $_POST['fecha'];
    $motivo_id = $_POST['motivo_id'];
    $monto = $_POST['monto'];
    $Prestamos_id = $_POST['Prestamos_id'];

    $sql = "INSERT INTO multas (fecha, motivo_id, monto, Prestamos_id)
            VALUES (:fecha, :motivo_id, :monto, :Prestamos_id)";

    $statement = $dbConn->prepare($sql);
    $statement->bindValue(':fecha', $fecha);
    $statement->bindValue(':motivo_id', $motivo_id);
    $statement->bindValue(':monto', $monto);
    $statement->bindValue(':Prestamos_id', $Prestamos_id);

    $statement->execute();
    $multa_id = $dbConn->lastInsertId();

    header("HTTP/1.1 201 Created");
    header("Location: /multas/$multa_id");
    exit();
}
?>