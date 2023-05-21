<?php
    include "../components/conexion.php";
    include "../settings/configuraciones.php";

    $dbConn = connect($db);
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $sql = "SELECT * FROM motivos";
        $statement = $dbConn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode($result);
        exit();
    }

    // Obtener un registro por su ID
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM motivos WHERE id = :id";
        $statement = $dbConn->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            header("HTTP/1.1 200 OK");
            echo json_encode($result);
        } else {
            header("HTTP/1.1 404 Not Found");
        }
        exit();
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verificar que se hayan enviado los datos requeridos
        if (isset($_POST['descripcion'])) {
            $descripcion = $_POST['descripcion'];
            
            // Insertar el nuevo registro en la base de datos
            $sql = "INSERT INTO motivos (descripcion) VALUES (:descripcion)";
            $statement = $dbConn->prepare($sql);
            $statement->bindValue(':descripcion', $descripcion);
            
            if ($statement->execute()) {
                $response = [
                    'status' => 'success',
                    'message' => 'Registro creado exitosamente.'
                ];
                header("HTTP/1.1 201 Created");
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'No se pudo crear el registro.'
                ];
                header("HTTP/1.1 500 Internal Server Error");
            }
            
            echo json_encode($response);
            exit();
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Datos insuficientes para crear el registro.'
            ];
            header("HTTP/1.1 400 Bad Request");
            echo json_encode($response);
            exit();
        }
    }
    
    
?>
