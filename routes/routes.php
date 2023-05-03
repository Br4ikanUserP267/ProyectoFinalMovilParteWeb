<?php

// Incluimos la clase de conexión
require("../components/conexion.php");


// Establecemos los headers de la respuesta HTTP para permitir solicitudes desde cualquier origen (CORS)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");



// Verificamos el método de la solicitud y la ruta solicitada
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_SERVER['REQUEST_URI'] == '/usuarios') {
        // Lógica para obtener la lista de usuarios
        // Creamos la conexión a la base de datos
        echo "si sirve usuarios";

        $conexion = new ConectarMySQL();
        
        // Preparamos la consulta SQL para obtener todos los usuarios
        $sql = "SELECT * FROM usuarios";

        // Ejecutamos la consulta y obtenemos el resultado
        $resultado = $conexion->ejecutarConsulta($sql);

        // Creamos un array para almacenar los resultados de la consulta
        $usuarios = array();

        // Recorremos el resultado de la consulta y lo almacenamos en el array
        while ($fila = $resultado->fetch_assoc()) {
            $usuarios[] = $fila;
        }

        // Devolvemos la lista de usuarios en formato JSON
        header('Content-Type: application/json');
        echo json_encode($usuarios);
    }


    
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_SERVER['REQUEST_URI'] == '/usuarios') {
        // Lógica para crear un nuevo usuario

        // Obtenemos los datos del nuevo usuario desde el cuerpo de la solicitud
        $datos = json_decode(file_get_contents('php://input'), true);

        // Validamos que se hayan proporcionado todos los campos requeridos
        if (!isset($datos['numeroIdentificacion']) || !isset($datos['contrasena']) || !isset($datos['tipoUsuario'])) {
            http_response_code(400);
            echo json_encode(array('mensaje' => 'No se proporcionaron todos los campos requeridos'));
            exit;
        }

        // Creamos la conexión a la base de datos
        $conexion = new ConectarMySQL();

        // Preparamos la consulta SQL para crear un nuevo usuario
        $sql = "INSERT INTO usuarios (numeroIdentificacion, contrasena, tipoUsuario) VALUES ('{$datos['numeroIdentificacion']}', '{$datos['contrasena']}', '{$datos['tipoUsuario']}')";

        // Ejecutamos la consulta y verificamos si se creó el usuario
        if ($conexion->ejecutarConsulta($sql)) {

            $id = $conexion->getConexion()->insert_id;
            // Devolvemos el ID del nuevo usuario en formato JSON
            header('Content-Type: application/json');
            echo json_encode(array('id' => $id));

        } else {
            // Si hubo un error al crear el usuario, devolvemos un mensaje de error en formato JSON
            http_response_code(500);
            echo json_encode(array('mensaje' => 'Hubo un error al crear el usuario'));
                }
            }
        } else {
            // Si se realizó una solicitud con un método no válido, devolvemos un mensaje de error en formato JSON
            http_response_code(405);
            echo json_encode(array('mensaje' => 'Método no permitido'));
        }




?>