<?php
    include "../components/conexion.php";
    include "../settings/configuraciones.php";

    $dbConn = connect($db);

    
    //listar todos los carreras o solo uno
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        if (isset($_GET['id']))
        {
            //Mostrar un usuario
            $sql = $dbConn->prepare("SELECT * FROM carreras WHERE id=:id");
            $sql->bindValue(':id', $_GET['id']);
            $sql->execute();
            header("HTTP/1.1 200 OK");
            echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
            exit();
        }
        else {
            //Mostrar lista de carreras
            $sql = $dbConn->prepare("SELECT * FROM carreras");
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            header("HTTP/1.1 200 OK");
            echo json_encode($sql->fetchAll());
            exit();
        }
    }


    // Crear un nuevo usuario
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $input = $_POST;
        
    
        // Check that the required variables are set and not empty
        if (!empty($input['titulo']) && !empty($input['descripcion'])) {
            $sql = "INSERT INTO carreras (titulo, descripcion) VALUES (:titulo, :descripcion)";
            $statement = $dbConn->prepare($sql);
            bindAllValues($statement, $input);
            $statement->execute();
            $userId = $dbConn->lastInsertId();
    
            if ($userId) {
                $input['id'] = $userId;
                header("HTTP/1.1 200 OK");
                echo json_encode($input);
                exit();
            }
        } else {
            header("HTTP/1.1 400 Bad Request");
            exit();
        }
    }
    



    //Borrar
    if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
    {
        try {
            $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
            $statement = $dbConn->prepare("DELETE FROM carreras WHERE id=:id");
            $statement->bindValue(':id', $id);
            $statement->execute();
            header("HTTP/1.1 200 OK");
            exit();
        } catch (PDOException $ex) {
            header("HTTP/1.1 500 Internal Server Error");
            exit();
        }
    }
    


    //Actualizar
    if ($_SERVER['REQUEST_METHOD'] == 'PUT')
    {
        parse_str(file_get_contents("php://input"), $input);
        $userId = filter_var($input['id'], FILTER_SANITIZE_NUMBER_INT);
        $fields = getParams($input);

        $sql = "UPDATE carreras
                SET $fields
                WHERE id=:id";

        $statement = $dbConn->prepare($sql);
        $statement->bindValue(':id', $userId);
        bindAllValues($statement, $input);

        $statement->execute();
        header("HTTP/1.1 200 OK");
        exit();
    }





?>
