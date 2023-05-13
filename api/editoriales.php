<?php
        include "../components/conexion.php";
        include "../settings/configuraciones.php";

        $dbConn = connect($db);

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (!isset($_GET['id'])) {
                // Retrieve list of all editorials
                $sql = "SELECT * FROM editoriales";
                $statement = $dbConn->prepare($sql);
                $statement->execute();
            
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                header("HTTP/1.1 200 OK");
                echo json_encode($result);
                exit();
            }
        }
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($_GET['id'])) {
                // Retrieve editorial by ID
                $id = $_GET['id'];
            
                $sql = "SELECT * FROM editoriales WHERE id = :id";
                $statement = $dbConn->prepare($sql);
                $statement->bindValue(':id', $id);
                $statement->execute();
            
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                if ($result) {
                    header("HTTP/1.1 200 OK");
                    echo json_encode($result);
                    exit();
                } else {
                    header("HTTP/1.1 404 Not Found");
                    exit();
                }
            }
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Check if all required fields are provided
            if (isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['numerocontacto'])) {
                $nombre = $_POST['nombre'];
                $correo = $_POST['correo'];
                $numerocontacto = $_POST['numerocontacto'];
            
                // Insert new editorial into the database
                $sql = "INSERT INTO editoriales (nombre, correo, numerocontacto) VALUES (:nombre, :correo, :numerocontacto)";
                $statement = $dbConn->prepare($sql);
                $statement->bindValue(':nombre', $nombre);
                $statement->bindValue(':correo', $correo);
                $statement->bindValue(':numerocontacto', $numerocontacto);
                $statement->execute();
            
                header("HTTP/1.1 201 Created");
                exit();
            } else {
                header("HTTP/1.1 400 Bad Request");
                exit();
            }
        }
        
        

?>