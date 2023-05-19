<?php
include "../components/conexion.php";
include "../settings/configuraciones.php";

$dbConn = connect($db);

// Se pasa por el método post ** no por fuera

// Listar todos los autores o solo uno
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM autores WHERE id = :id";
        $statement = $dbConn->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode($result);
        exit();
    } else {
        $sql = "SELECT * FROM autores";
        $statement = $dbConn->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode($result);
        exit();
    }
}

// Crear un nuevo autor
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $autor = $_POST;

    $imagen = $_FILES['foto'];

    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
    $carpetaImagenes = 'autor_images/';

    if (!is_dir($carpetaImagenes)) {
        mkdir($carpetaImagenes);
    }

    move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

    $autor['foto'] = $carpetaImagenes . $nombreImagen;

    $sql = "INSERT INTO autores (nombres, apellidos, biografia, foto) 
            VALUES (:nombres, :apellidos, :biografia, :foto)";

    $statement = $dbConn->prepare($sql);
    $statement->bindValue(':nombres', $autor['nombres']);
    $statement->bindValue(':apellidos', $autor['apellidos']);
    $statement->bindValue(':biografia', $autor['biografia']);
    $statement->bindValue(':foto', $autor['foto']);
  

    $statement->execute();
    $autor_id = $dbConn->lastInsertId();

    header("HTTP/1.1 201 Created");
    header("Location: /autores/$autor_id");
    exit();
}

// Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "DELETE FROM autores WHERE id = :id";
        $statement = $dbConn->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        header("HTTP/1.1 200 OK");
        echo "El autor ha sido eliminado exitosamente";
        exit();
    } else {
        header("HTTP/1.1 400 Bad Request");
        echo "Se debe proveer un ID válido para eliminar un autor";
        exit();
    }
}

?>