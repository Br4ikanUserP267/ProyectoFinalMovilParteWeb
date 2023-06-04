<?php
include "../components/conexion.php";
include "../settings/configuraciones.php";

$dbConn = connect($db);

// Obtener todos los libros
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT libros.*, CONCAT(categorias.id, '.', temas.id) AS ubicacion FROM libros
            INNER JOIN temas ON libros.temas_id = temas.id
            INNER JOIN categorias ON temas.Categorias_id = categorias.id";
    $statement = $dbConn->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    header("HTTP/1.1 200 OK");
    echo json_encode($result);
    exit();
}



// Crear un nuevo libro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $Editoriales_id = $_POST['Editoriales_id'];
    $imagen = $_FILES['imagen'];
    $temas_id = $_POST['temas_id'];
    $valor = $_POST['valor'];
    $disponibilidad = $_POST['disponibilidad'];
    $numerounidades = $_POST['numerounidades'];
    $resumen = $_POST['resumen'];
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
    $carpetaImagenes = 'libro_images/';

    if (!is_dir($carpetaImagenes)) {
        mkdir($carpetaImagenes);
    }

    move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

    $rutaImagen = $carpetaImagenes . $nombreImagen;

    $sql = "INSERT INTO libros (nombre, Editoriales_id, imagen, temas_id, valor, disponibilidad, numerounidades,resumen)
            VALUES (:nombre, :Editoriales_id, :imagen, :temas_id, :valor, :disponibilidad, :numerounidades,:resumen)";

    $statement = $dbConn->prepare($sql);
    $statement->bindValue(':nombre', $nombre);
    $statement->bindValue(':Editoriales_id', $Editoriales_id);
    $statement->bindValue(':imagen', $rutaImagen);
    $statement->bindValue(':temas_id', $temas_id);
    $statement->bindValue(':valor', $valor);
    $statement->bindValue(':disponibilidad', $disponibilidad);
    $statement->bindValue(':numerounidades', $numerounidades);
    $statement->bindValue(':resumen', $resumen);

    $statement->execute();
    $libro_id = $dbConn->lastInsertId();

    header("HTTP/1.1 201 Created");
    header("Location: /libros/$libro_id");
    exit();
}


// Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "DELETE FROM libros WHERE id = :id";
        $statement = $dbConn->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        header("HTTP/1.1 200 OK");
        echo "El libro ha sido eliminado exitosamente";
        exit();
    } else {
        header("HTTP/1.1 400 Bad Request");
        echo "Se debe proveer un ID válido para eliminar un libro";
        exit();
    }
}

?>
