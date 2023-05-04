<?php
include "../components/conexion.php";
include "../settings/configuraciones.php";

$dbConn = connect($db);

/*
  listar todos los usuarios o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['numeroIdentificacion']))
    {
        //Mostrar un usuario
        $sql = $dbConn->prepare("SELECT * FROM usuarios WHERE numeroIdentificacion=:numeroIdentificacion");
        $sql->bindValue(':numeroIdentificacion', $_GET['numeroIdentificacion']);
        $sql->execute();
        header("HTTP/1.1 200 OK");
        echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
        exit();
    }
    else {
        //Mostrar lista de usuarios
        $sql = $dbConn->prepare("SELECT * FROM usuarios");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode($sql->fetchAll());
        exit();
    }
}


// Crear un nuevo usuario
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $input = $_POST;
    // Check that the required variables are set and not empty
    if(!empty($input['numeroIdentificacion']) && !empty($input['contrasena']) && !empty($input['tipousuario'])) {
            
            $sql = "INSERT INTO usuarios
                (numeroIdentificacion, contrasena, tipousuario)
                VALUES
                (:numeroIdentificacion, :contrasena, :tipousuario)";
            $statement = $dbConn->prepare($sql);
            bindAllValues($statement, $input);
            $statement->execute();
            $userId = $dbConn->lastInsertId();
            
            if($userId)
            {
                $input['id'] = $userId;
                header("HTTP/1.1 200 OK");
                echo json_encode($input);
                exit();
            }
        }


}




//Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
    $id = filter_var($_GET['numeroIdentificacion'], FILTER_SANITIZE_NUMBER_INT);
    $statement = $dbConn->prepare("DELETE FROM usuarios WHERE numeroIdentificacion=:numeroIdentificacion");
    $statement->bindValue(':numeroIdentificacion', $id);
    $statement->execute();
    header("HTTP/1.1 200 OK");
    exit();
}

//Actualizar
if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    parse_str(file_get_contents("php://input"), $input);
    $userId = filter_var($input['numeroIdentificacion'], FILTER_SANITIZE_NUMBER_INT);
    $fields = getParams($input);

    $sql = "UPDATE usuarios
            SET $fields
            WHERE numeroIdentificacion=:numeroIdentificacion";

    $statement = $dbConn->prepare($sql);
    $statement->bindValue(':numeroIdentificacion', $userId);
    bindAllValues($statement, $input);

    $statement->execute();
    header("HTTP/1.1 200 OK");
    exit();
}





?>
