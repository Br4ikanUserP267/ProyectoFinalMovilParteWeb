<?php
include "../components/conexion.php";
include "../settings/configuraciones.php";

$dbConn = connect($db);

// Verificar si se recibió el valor de prestamoId en $_POST
if (isset($_POST['prestamoId'])) {
    // Obtener el ID del préstamo enviado por POST
    $prestamoId = $_POST['prestamoId'];

    // Llamar al procedimiento almacenado
    $sql = "CALL CambiarEstadoPrestamo($prestamoId)";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();

    // Verificar el éxito de la operación
    if ($stmt->rowCount() > 0) {
        $response = array("status" => "success");
    } else {
        $response = array("status" => "error", "message" => "No se pudo cambiar el estado del préstamo");
    }
} else {
    $response = array("status" => "error", "message" => "ID de préstamo no especificado");
}

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
