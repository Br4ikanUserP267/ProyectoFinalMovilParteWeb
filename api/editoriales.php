<?php
include "../components/conexion.php";
include "../settings/configuraciones.php";

$dbConn = connect($db);

// Obtener todos los registros de las tablas
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $query = "SELECT * FROM editoriales";
        $stmt = $dbConn->prepare($query);
        $stmt->execute();
        $editoriales = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Obtener las direcciones de cada editorial
        foreach ($editoriales as &$editorial) {
            $query = "SELECT * FROM direcciones WHERE id_editorial = :id_editorial";
            $stmt = $dbConn->prepare($query);
            $stmt->bindParam(':id_editorial', $editorial['id']);
            $stmt->execute();
            $direcciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Agregar las direcciones al resultado de cada editorial
            $editorial['direcciones'] = $direcciones;
        }

        echo json_encode($editoriales);
    }


// Crear una nueva editorial, dirección y relación
// Crear una nueva editorial, dirección y relación
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos enviados en la solicitud
    $data = json_decode(file_get_contents("php://input"), true);
    $nombre = $data['nombre'];
    $correo = $data['correo'];
    $numerocontacto = $data['numerocontacto'];
    $direcciones = $data['direcciones'];

    // Insertar la nueva editorial en la tabla "editoriales"
    $query = "INSERT INTO editoriales (nombre, correo, numerocontacto) VALUES (:nombre, :correo, :numerocontacto)";
    $stmt = $dbConn->prepare($query);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':numerocontacto', $numerocontacto);
    $stmt->execute();

    // Obtener el ID de la nueva editorial insertada
    $editorialId = $dbConn->lastInsertId();

    // Insertar las nuevas direcciones en la tabla "direcciones" relacionadas con la editorial
    $query = "INSERT INTO direcciones (pais, ciudad, direccion, departamento, id_editorial) VALUES (:pais, :ciudad, :direccion, :departamento, :id_editorial)";
    $stmt = $dbConn->prepare($query);

    foreach ($direcciones as $direccion) {
        $pais = $direccion['pais'];
        $ciudad = $direccion['ciudad'];
        $direccionCompleta = $direccion['direccion'];
        $departamento = $direccion['departamento'];

        $stmt->bindParam(':pais', $pais);
        $stmt->bindParam(':ciudad', $ciudad);
        $stmt->bindParam(':direccion', $direccionCompleta);
        $stmt->bindParam(':departamento', $departamento);
        $stmt->bindParam(':id_editorial', $editorialId);
        $stmt->execute();
    }

    // Devolver la respuesta con el ID de la nueva editorial creada
    $response = array('editorialId' => $editorialId);
    echo json_encode($response);
}


// Eliminar una editorial por su ID
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Obtener el ID de la editorial a eliminar
    $id_editorial = $_GET['id'];

    // Eliminar las direcciones relacionadas con la editorial
    $query = "DELETE FROM direcciones WHERE id_editorial = :id_editorial";
    $stmt = $dbConn->prepare($query);
    $stmt->bindParam(':id_editorial', $id_editorial);
    $stmt->execute();

    // Eliminar la editorial
    $query = "DELETE FROM editoriales WHERE id = :id_editorial";
    $stmt = $dbConn->prepare($query);
    $stmt->bindParam(':id_editorial', $id_editorial);
    $stmt->execute();

    // Devolver la respuesta
    $response = array('message' => 'Editorial eliminada correctamente');
    echo json_encode($response);
}
// Actualizar una editorial por su ID
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    // Obtener los datos enviados en la solicitud
    $data = json_decode(file_get_contents("php://input"), true);
    $id_editorial = $data['id'];
    $nombre = $data['nombre'];
    $correo = $data['correo'];
    $numerocontacto = $data['numerocontacto'];
    $direcciones = $data['direcciones'];

    // Actualizar la editorial en la tabla "editoriales"
    $query = "UPDATE editoriales SET nombre = :nombre, correo = :correo, numerocontacto = :numerocontacto WHERE id = :id_editorial";
    $stmt = $dbConn->prepare($query);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':numerocontacto', $numerocontacto);
    $stmt->bindParam(':id_editorial', $id_editorial);
    $stmt->execute();

    // Eliminar las direcciones relacionadas con la editorial
    $query = "DELETE FROM direcciones WHERE id_editorial = :id_editorial";
    $stmt = $dbConn->prepare($query);
    $stmt->bindParam(':id_editorial', $id_editorial);
    $stmt->execute();

    // Insertar las nuevas direcciones en la tabla "direcciones" relacionadas con la editorial
    $query = "INSERT INTO direcciones (pais, ciudad, direccion, departamento, id_editorial) VALUES (:pais, :ciudad, :direccion, :departamento, :id_editorial)";
    $stmt = $dbConn->prepare($query);

    foreach ($direcciones as $direccion) {
        $pais = $direccion['pais'];
        $ciudad = $direccion['ciudad'];
        $direccionCompleta = $direccion['direccion'];
        $departamento = $direccion['departamento'];

        $stmt->bindParam(':pais', $pais);
        $stmt->bindParam(':ciudad', $ciudad);
        $stmt->bindParam(':direccion', $direccionCompleta);
        $stmt->bindParam(':departamento', $departamento);
        $stmt->bindParam(':id_editorial', $id_editorial);
        $stmt->execute();
    }

    // Devolver la respuesta
    $response = array('message' => 'Editorial actualizada correctamente');
    echo json_encode($response);
}


// Resto del código...
?>
