<?php
    include "../components/conexion.php";
    include "../settings/configuraciones.php";

    $dbConn = connect($db);

    
    //listar todos los usuarios o solo uno
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        if (isset($_GET['id']))
        {
            $id = $_GET['id'];
    
            $sql = "SELECT * FROM estudiantes e INNER JOIN direccionesestudiantes d ON e.id = d.estudiantes_id WHERE e.id = :id";
            $statement = $dbConn->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();
    
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            header("HTTP/1.1 200 OK");
            echo json_encode($result);
            exit();
        }
        else {
            $sql = "SELECT * FROM estudiantes e INNER JOIN direccionesestudiantes d ON e.id = d.estudiantes_id";
            $statement = $dbConn->prepare($sql);
            $statement->execute();
    
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            header("HTTP/1.1 200 OK");
            echo json_encode($result);
            exit();
        }
    }
    

    // Crear un nuevo estudiante 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtener los datos del estudiante de la petición
        $estudiante = json_decode(file_get_contents("php://input"), true);
    
        // Insertar el estudiante en la base de datos
        $sql = "INSERT INTO estudiantes (tipoIdentificacion, numeroIdentificacion, nombres, apellidos, celular, fechanacimiento, tiposagre, ciudadnacimiento, paisnacimiento, foto, correo) 
        VALUES (:tipoIdentificacion, :numeroIdentificacion, :nombres, :apellidos, :celular, :fechanacimiento, :tiposagre, :ciudadnacimiento, :paisnacimiento, :foto, :correo)";

        $statement = $dbConn->prepare($sql);
        $statement->bindValue(':tipoIdentificacion', $estudiante['tipoIdentificacion']);
        $statement->bindValue(':numeroIdentificacion', $estudiante['numeroIdentificacion']);
        $statement->bindValue(':nombres', $estudiante['nombres']);
        $statement->bindValue(':apellidos', $estudiante['apellidos']);
        $statement->bindValue(':celular', $estudiante['celular']);
        $statement->bindValue(':fechanacimiento', $estudiante['fechanacimiento']);
        $statement->bindValue(':tiposagre', $estudiante['tiposagre']);
        $statement->bindValue(':ciudadnacimiento', $estudiante['ciudadnacimiento']);
        $statement->bindValue(':paisnacimiento', $estudiante['paisnacimiento']);
        $statement->bindValue(':foto', $estudiante['foto']);
        $statement->bindValue(':correo', $estudiante['correo']);

        $statement->execute();
        $estudiante_id = $dbConn->lastInsertId(); // obtener el ID del estudiante insertado
    
        // Insertar la dirección del estudiante en la base de datos
        $direccion = $estudiante['direccion'];
        $sql = "INSERT INTO direccionesestudiantes (pais, ciudad, calle, numero, barrio, estudiantes_id) 
                VALUES (:pais, :ciudad, :calle, :numero, :barrio, :estudiantes_id)";
        $statement = $dbConn->prepare($sql);
        $statement->bindValue(':pais', $direccion['pais']);
        $statement->bindValue(':ciudad', $direccion['ciudad']);
        $statement->bindValue(':calle', $direccion['calle']);
        $statement->bindValue(':numero', $direccion['numero']);
        $statement->bindValue(':barrio', $direccion['barrio']);
        $statement->bindValue(':estudiantes_id', $estudiante_id);
        $statement->execute();
    
        // Devolver una respuesta con el ID del estudiante insertado
        header("HTTP/1.1 201 Created");
        header("Location: /estudiantes/$estudiante_id");
        exit();
    
    
    }
    



    //Borrar
    if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
    {
        if (isset($_GET['id']))
        {
            $id = $_GET['id'];

            // Verificar si el estudiante tiene una dirección registrada
            $sql = "SELECT * FROM direccionesestudiantes WHERE estudiantes_id = :id";
            $statement = $dbConn->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Eliminar la dirección del estudiante
                $sql = "DELETE FROM direccionesestudiantes WHERE estudiantes_id = :id";
                $statement = $dbConn->prepare($sql);
                $statement->bindValue(':id', $id);
                $statement->execute();
            }

            // Eliminar al estudiante
            $sql = "DELETE FROM estudiantes WHERE id = :id";
            $statement = $dbConn->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();

            header("HTTP/1.1 200 OK");
            echo "El estudiante ha sido eliminado exitosamente";
            exit();
        }
        else {
            header("HTTP/1.1 400 Bad Request");
            echo "Se debe proveer un id válido para eliminar un estudiante";
            exit();
        }
    }






    //Actualizar
    if ($_SERVER['REQUEST_METHOD'] == 'PUT')
    {
    if (isset($_GET['id']))
    {
        $id = $_GET['id'];

        parse_str(file_get_contents("php://input"), $put_vars);

        $sql = "UPDATE estudiantes SET 
                tipoIdentificacion = :tipoIdentificacion,
                numeroIdentificacion = :numeroIdentificacion,
                nombres = :nombres,
                apellidos = :apellidos,
                celular = :celular,
                fechanacimiento = :fechanacimiento,
                tiposagre = :tiposagre,
                ciudadnacimiento = :ciudadnacimiento,
                paisnacimiento = :paisnacimiento,
                foto = :foto 
                WHERE id = :id";
        $statement = $dbConn->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->bindValue(':tipoIdentificacion', $put_vars['tipoIdentificacion']);
        $statement->bindValue(':numeroIdentificacion', $put_vars['numeroIdentificacion']);
        $statement->bindValue(':nombres', $put_vars['nombres']);
        $statement->bindValue(':apellidos', $put_vars['apellidos']);
        $statement->bindValue(':celular', $put_vars['celular']);
        $statement->bindValue(':fechanacimiento', $put_vars['fechanacimiento']);
        $statement->bindValue(':tiposagre', $put_vars['tiposagre']);
        $statement->bindValue(':ciudadnacimiento', $put_vars['ciudadnacimiento']);
        $statement->bindValue(':paisnacimiento', $put_vars['paisnacimiento']);
        $statement->bindValue(':foto', $put_vars['foto']);
        $statement->execute();

        header("HTTP/1.1 200 OK");
        echo "El estudiante ha sido actualizado exitosamente";
        exit();
    }
    else {
        header("HTTP/1.1 400 Bad Request");
        echo "Se debe proveer un id válido para actualizar un estudiante";
        exit();
    }
}




?>
