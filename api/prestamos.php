<?php
include "../components/conexion.php";
include "../settings/configuraciones.php";

$dbConn = connect($db);

// Obtener todos los préstamos y los registros de préstamos_has_libros relacionados
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT p.*, r.Libros_id, r.fecha
            FROM prestamos p
            INNER JOIN prestamos_has_libros r ON p.id = r.Prestamos_id";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Organizar los datos en una estructura de respuesta
    $response = array();
    foreach ($data as $row) {
        $prestamoId = $row['id'];
        if (!isset($response[$prestamoId])) {
            // Agregar información del préstamo
            $response[$prestamoId] = array(
                'id' => $row['id'],
                'fechaInicio' => $row['fechaInicio'],
                'fechaFinal' => $row['fechaFinal'],
                'prestado' => $row['prestado'],
                'Estudiantes_id' => $row['Estudiantes_id'],
                'registros' => array()
            );
        }

        // Agregar información del registro de préstamo_has_libros
        $response[$prestamoId]['registros'][] = array(
            'Libros_id' => $row['Libros_id'],
            'fecha' => $row['fecha']
        );
    }

    header("HTTP/1.1 200 OK");
    echo json_encode(array_values($response));
    exit();
}

// Crear un nuevo préstamo y los registros de préstamo_has_libros relacionados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = $_POST;
    // Verificar que las variables requeridas estén establecidas y no estén vacías
    if (!empty($input['fechaInicio']) && !empty($input['fechaFinal']) && isset($input['prestado']) && isset($input['Estudiantes_id']) && isset($input['registros'])) {
        $registros = json_decode($input['registros'], true);

        // Insertar el préstamo
        $sql = "INSERT INTO prestamos (fechaInicio, fechaFinal, prestado, Estudiantes_id)
                VALUES (:fechaInicio, :fechaFinal, :prestado, :Estudiantes_id)";
        $statement = $dbConn->prepare($sql);
        bindAllValues($statement, $input);
        $statement->execute();
        $prestamoId = $dbConn->lastInsertId();

        if ($prestamoId) {
            // Insertar los registros de préstamo_has_libros
            $sql = "INSERT INTO prestamos_has_libros (Prestamos_id, Libros_id, fecha)
                    VALUES (:Prestamos_id, :Libros_id, :fecha)";
            $statement = $dbConn->prepare($sql);
            $statement->bindValue(':Prestamos_id', $prestamoId);
            foreach ($registros as $registro) {
                $statement->bindValue(':Libros_id', $registro['Libros_id']);
                $statement->bindValue(':fecha', $registro['fecha']);
                $statement->execute();
            }

            $input['id'] = $prestamoId;
            header("HTTP/1.1 200 OK");
            echo json_encode($input);
            exit();
        }
    }
}

// Actualizar un préstamo y los registros de préstamo_has_libros relacionados
// Actualizar un préstamo y los registros de préstamo_has_libros relacionados
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"), $input);
    $prestamoId = filter_var($input['id'], FILTER_SANITIZE_NUMBER_INT);
    // Verificar que el ID del préstamo esté establecido
    if (!empty($prestamoId)) {
        // Actualizar el préstamo
        $sql = "UPDATE prestamos SET fechaInicio = :fechaInicio, fechaFinal = :fechaFinal, prestado = :prestado, Estudiantes_id = :Estudiantes_id WHERE id = :id";
        $statement = $dbConn->prepare($sql);
        $statement->bindValue(':id', $prestamoId);
        $statement->bindValue(':fechaInicio', $input['fechaInicio']);
        $statement->bindValue(':fechaFinal', $input['fechaFinal']);
        $statement->bindValue(':prestado', $input['prestado']);
        $statement->bindValue(':Estudiantes_id', $input['Estudiantes_id']);
        $statement->execute();

        // Actualizar los registros de préstamo_has_libros
        if (isset($input['registros'])) {
            $registros = json_decode($input['registros'], true);

            // Eliminar los registros existentes
            $sql = "DELETE FROM prestamos_has_libros WHERE Prestamos_id = :Prestamos_id";
            $statement = $dbConn->prepare($sql);
            $statement->bindValue(':Prestamos_id', $prestamoId);
            $statement->execute();

            // Insertar los nuevos registros
            $sql = "INSERT INTO prestamos_has_libros (Prestamos_id, Libros_id, fecha)
                    VALUES (:Prestamos_id, :Libros_id, :fecha)";
            $statement = $dbConn->prepare($sql);
            $statement->bindValue(':Prestamos_id', $prestamoId);
            foreach ($registros as $registro) {
                $statement->bindValue(':Libros_id', $registro['Libros_id']);
                $statement->bindValue(':fecha', $registro['fecha']);
                $statement->execute();
            }
        }

        header("HTTP/1.1 200 OK");
        exit();
    }
}


// Borrar un préstamo y los registros de préstamo_has_libros relacionados
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    try {
        $prestamoId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        // Verificar que el ID del préstamo esté establecido
        if (!empty($prestamoId)) {
            // Eliminar el préstamo
            $statement = $dbConn->prepare("DELETE FROM prestamos WHERE id = :id");
            $statement->bindValue(':id', $prestamoId);
            $statement->execute();

            // Eliminar los registros de préstamo_has_libros relacionados
            $statement = $dbConn->prepare("DELETE FROM prestamos_has_libros WHERE Prestamos_id = :Prestamos_id");
            $statement->bindValue(':Prestamos_id', $prestamoId);
            $statement->execute();

            header("HTTP/1.1 200 OK");
            exit();
        }
    } catch (PDOException $ex) {
        header("HTTP/1.1 500 Internal Server Error");
        exit();
    }
}

?>
