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
// Verificar que el método de solicitud sea POST

// Verificar que el método de solicitud sea POST
// Verificar que el método de solicitud sea POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del autor de la petición
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $biografia = $_POST['biografia'];
    $fechanacimiento = $_POST['fechanacimiento'];

    // Verificar si se cargó correctamente la imagen
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        // Generar un nombre único para la imagen
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        // Directorio donde se guardarán las imágenes
        $directorioImagenes = 'autor_images/';

        // Verificar si el directorio no existe y crearlo
        if (!is_dir($directorioImagenes)) {
            mkdir($directorioImagenes);
        }

        // Mover la imagen al directorio especificado
        move_uploaded_file($_FILES['foto']['tmp_name'], $directorioImagenes . $nombreImagen);

        // Guardar la ruta de la imagen en la variable $foto
        $foto = $directorioImagenes . $nombreImagen;
    } else {
        // Si no se cargó una imagen, asignar una cadena vacía a la ruta de la foto
        $foto = '';
    }

    // Insertar el autor en la base de datos
    $sql = "INSERT INTO autores (nombres, apellidos, biografia, foto, fechanacimiento) 
            VALUES (:nombres, :apellidos, :biografia, :foto, :fechanacimiento)";

    $statement = $dbConn->prepare($sql);
    $statement->bindValue(':nombres', $nombres);
    $statement->bindValue(':apellidos', $apellidos);
    $statement->bindValue(':biografia', $biografia);
    $statement->bindValue(':foto', $foto);
    $statement->bindValue(':fechanacimiento', $fechanacimiento);
    $statement->execute();
    $autorId = $dbConn->lastInsertId();

    // Devolver una respuesta con el ID del autor insertado
    header("HTTP/1.1 201 Created");
    header("Content-Type: application/json");
    echo json_encode(array('id' => $autorId));
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