<?php
include "../components/conexion.php";
include "../settings/configuraciones.php";

$dbConn = connect($db);

// Listar todos los préstamos o uno específico
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        // Mostrar un préstamo específico
        $sql = $dbConn->prepare("SELECT * FROM prestamos WHERE id=:id");
        $sql->bindValue(':id', $_GET['id']);
        $sql->execute();
        $prestamo = $sql->fetch(PDO::FETCH_ASSOC);

        // Obtener los libros asociados al préstamo con sus nombres
        $sql = $dbConn->prepare("SELECT libros.*, prestamos_has_libros.Prestamos_id FROM libros INNER JOIN prestamos_has_libros ON libros.id = prestamos_has_libros.Libros_id WHERE prestamos_has_libros.Prestamos_id = :prestamoId");
        $sql->bindValue(':prestamoId', $_GET['id']);
        $sql->execute();
        $libros = $sql->fetchAll(PDO::FETCH_ASSOC);

        $response = array(
            'prestamo' => $prestamo,
            'libros' => $libros
        );

        header("HTTP/1.1 200 OK");
        echo json_encode($response);
        exit();
    } else if (isset($_GET['estudiante_id'])) {
        // Mostrar lista de préstamos para un estudiante específico con nombres de libros
        $sql = $dbConn->prepare("SELECT prestamos.*, libros.nombre AS nombre_libro FROM prestamos INNER JOIN prestamos_has_libros ON prestamos.id = prestamos_has_libros.Prestamos_id INNER JOIN libros ON libros.id = prestamos_has_libros.Libros_id WHERE prestamos.Estudiantes_id = :estudianteId");
        $sql->bindValue(':estudianteId', $_GET['estudiante_id']);
        $sql->execute();
        $prestamos = $sql->fetchAll(PDO::FETCH_ASSOC);

        $response = array(
            'prestamos' => $prestamos
        );

        header("HTTP/1.1 200 OK");
        echo json_encode($response);
        exit();
    }else{

        $sql = $dbConn->prepare("SELECT prestamos.*, libros.nombre AS nombre_libro FROM prestamos INNER JOIN prestamos_has_libros ON prestamos.id = prestamos_has_libros.Prestamos_id INNER JOIN libros ON libros.id = prestamos_has_libros.Libros_id");
        $sql->execute();
        $prestamos = $sql->fetchAll(PDO::FETCH_ASSOC);
    
        $response = array(
            'prestamos' => $prestamos
        );
    
        header("HTTP/1.1 200 OK");
        echo json_encode($response);
        exit();
    }
}



// Crear un nuevo préstamo
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, true);
    
    // Verificar que las variables requeridas estén establecidas y no estén vacías
    $requiredFields = ['fechaInicio', 'fechaFinal', 'prestado', 'Estudiantes_id', 'libros'];
    $missingFields = [];
    
    foreach ($requiredFields as $field) {
        if (empty($input[$field])) {
            $missingFields[] = $field;
        }
    }
    
    if (empty($missingFields)) {
        // Establecer la conexión a la base de datos
        $dbConn = connect($db);

        $sql = "INSERT INTO prestamos (fechaInicio, fechaFinal, prestado, Estudiantes_id) VALUES (:fechaInicio, :fechaFinal, :prestado, :Estudiantes_id)";
        $statement = $dbConn->prepare($sql);
        $statement->bindParam(':fechaInicio', $input['fechaInicio']);
        $statement->bindParam(':fechaFinal', $input['fechaFinal']);
        $statement->bindParam(':prestado', $input['prestado']);
        $statement->bindParam(':Estudiantes_id', $input['Estudiantes_id']);
        $statement->execute();
        $prestamoId = $dbConn->lastInsertId();

        if ($prestamoId) {
            // Insertar los libros asociados al préstamo en la tabla prestamos_has_libros
            foreach ($input['libros'] as $libroId) {
                $sql = "INSERT INTO prestamos_has_libros (Prestamos_id, Libros_id, fecha) VALUES (:prestamoId, :libroId, :fecha)";
                $statement = $dbConn->prepare($sql);
                $statement->bindParam(':prestamoId', $prestamoId);
                $statement->bindParam(':libroId', $libroId);
                $statement->bindParam(':fecha', $input['fechaInicio']); // Se utiliza la fecha de inicio del préstamo
                $statement->execute();
            }

            $input['id'] = $prestamoId;
            $response = array(
                'status' => 'success',
                'message' => 'Préstamo creado exitosamente',
                'data' => $input
            );
            header("HTTP/1.1 200 OK");
            echo json_encode($response);
            exit();
        } else {
            // Si falla la inserción en la base de datos
            $response = array(
                'status' => 'error',
                'message' => 'Error al insertar el préstamo en la base de datos'
            );
            header("HTTP/1.1 500 Internal Server Error");
            echo json_encode($response);
            exit();
        }
    } else {
        // Si faltan variables requeridas o están vacías
        $response = array(
            'status' => 'error',
            'message' => 'Faltan datos requeridos para crear el préstamo',
            'missingFields' => $missingFields
        );
        header("HTTP/1.1 400 Bad Request");
        echo json_encode($response);
        exit();
    }
}




if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, true);

    // Verificar que el ID del préstamo y el nuevo estado estén establecidos
    if (isset($_GET['id']) && isset($input['prestado'])) {
        $prestamoId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $newPrestado = $input['prestado'];

        // Verificar si el préstamo existe
        $sql = $dbConn->prepare("SELECT * FROM prestamos WHERE id=:id");
        $sql->bindValue(':id', $prestamoId);
        $sql->execute();
        $prestamo = $sql->fetch(PDO::FETCH_ASSOC);

        if ($prestamo) {
            // Actualizar el estado del préstamo en la base de datos
            $sql = $dbConn->prepare("UPDATE prestamos SET prestado=:newPrestado WHERE id=:id");
            $sql->bindValue(':newPrestado', $newPrestado);
            $sql->bindValue(':id', $prestamoId);
            $sql->execute();

            header("HTTP/1.1 200 OK");
            exit();
        } else {
            header("HTTP/1.1 404 Not Found");
            exit();
        }
    } else {
        header("HTTP/1.1 400 Bad Request");
        exit();
    }
}


// Check if the request method is PUT


// Eliminar un préstamo
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    if (isset($_GET['id'])) {
        $prestamoId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

        // Verificar si el préstamo existe
        $sql = $dbConn->prepare("SELECT * FROM prestamos WHERE id=:id");
        $sql->bindValue(':id', $prestamoId);
        $sql->execute();
        $prestamo = $sql->fetch(PDO::FETCH_ASSOC);

        if ($prestamo) {
            // Eliminar los registros asociados en la tabla prestamos_has_libros
            $sql = $dbConn->prepare("DELETE FROM prestamos_has_libros WHERE Prestamos_id=:prestamoId");
            $sql->bindValue(':prestamoId', $prestamoId);
            $sql->execute();

            // Eliminar el préstamo de la tabla prestamos
            $sql = $dbConn->prepare("DELETE FROM prestamos WHERE id=:id");
            $sql->bindValue(':id', $prestamoId);
            $sql->execute();

            header("HTTP/1.1 200 OK");
            exit();
        } else {
            header("HTTP/1.1 404 Not Found");
            exit();
        }
    } else {
        header("HTTP/1.1 400 Bad Request");
        exit();
    }
}
// Resto del código...
?>
