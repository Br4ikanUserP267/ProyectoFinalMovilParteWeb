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
        $input['numeroIdentificacion'] = $userId;
        header("HTTP/1.1 200 OK");
        echo json_encode($input);
        exit();
    }
}

//Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
    $id = $_GET['numeroIdentificacion'];
    $statement = $dbConn->prepare("DELETE FROM usuarios WHERE numeroIdentificacion=:numeroIdentificacion");
    $statement->bindValue(':numeroIdentificacion', $id);
    $statement->execute();
    header("HTTP/1.1 200 OK");
    exit();
}

//Actualizar
if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    $input = $_GET;
    $userId = $input['numeroIdentificacion'];
    $fields = getParams($input);

    $sql = "
          UPDATE usuarios
          SET $fields
          WHERE numeroIdentificacion='$userId'
           ";

    $statement = $dbConn->prepare($sql);
    bindAllValues($statement, $input);

    $statement->execute();
    header("HTTP/1.1 200 OK");
    exit();
}

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

?>
