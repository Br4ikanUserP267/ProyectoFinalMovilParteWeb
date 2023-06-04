<?php
include "../components/conexion.php";
include "../settings/configuraciones.php";

$dbConn = connect($db);

// Listar todas las relaciones entre autores y libros
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
    $sql = "SELECT * FROM autores_has_libros";
    $statement = $dbConn->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    header("HTTP/1.1 200 OK");
    echo json_encode($result);
    exit();
}

// Crear una nueva relación entre autor y libro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si se recibieron los datos esperados
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, true);
    print_r($input);
   
    if (isset($input['Autores_idAutores']) && isset($input['Libros_id']) && isset($input['fecha'])) {
        $Autores_id = $input['Autores_idAutores'];
        $Libros_id = $input['Libros_id'];
        $fecha = $input['fecha'];

        // Insertar los datos en la base de datos
        $sql = "INSERT INTO autores_has_libros (Autores_idAutores, Libros_id, fecha)
                VALUES (:Autores_idAutores, :Libros_id, :fecha)";

        $statement = $dbConn->prepare($sql);
        $statement->bindValue(':Autores_idAutores', $Autores_id);
        $statement->bindValue(':Libros_id', $Libros_id);
        $statement->bindValue(':fecha', $fecha);
        $statement->execute();

        // Obtener el ID de la relación recién creada
        $relation_id = $dbConn->lastInsertId();

        // Verificar si se insertaron correctamente los datos
        if ($relation_id) {
            header("HTTP/1.1 201 Created");
            header("Location: http://localhost/proyectoFinal/api/autores_has_libros.php/" . $relation_id);
            exit();
        } 
    } else {
        header("HTTP/1.1 400 Bad Request");
        echo "Faltan datos en la solicitud";
        exit();
    }
}



// Borrar una relación entre autor y libro
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    if (isset($_GET['Autores_id']) && isset($_GET['Libros_id'])) {
        $Autores_id = $_GET['Autores_id'];
        $Libros_id = $_GET['Libros_id'];

        $sql = "DELETE FROM autores_has_libros WHERE Autores_idAutores = :Autores_idAutores AND Libros_id = :Libros_id";
        $statement = $dbConn->prepare($sql);
        $statement->bindValue(':Autores_idAutores', $Autores_id);
        $statement->bindValue(':Libros_id', $Libros_id);
        $statement->execute();

        header("HTTP/1.1 200 OK");
        echo "La relación entre autor y libro ha sido eliminada exitosamente";
        exit();
    } else {
        header("HTTP/1.1 400 Bad Request");
        echo "Se deben proveer los IDs de autor y libro válidos para eliminar una relación";
        exit();
    }
}
?>
