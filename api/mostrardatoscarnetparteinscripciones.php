<?php
    include "../components/conexion.php";
    include "../settings/configuraciones.php";

    $dbConn = connect($db);

    if (isset($_GET['numeroIdentificacion'])) {
        $numeroIdentificacion = $_GET['numeroIdentificacion'];
    
        $sql = "SELECT i.*, c.titulo AS nombreCarrera
                FROM inscripciones i
                INNER JOIN estudiantes e ON e.id = i.estudiantes_id
                INNER JOIN carreras c ON c.id = i.Carrera_id
                WHERE e.numeroIdentificacion = :numeroIdentificacion" ;
        
        $statement = $dbConn->prepare($sql);
        $statement->bindValue(':numeroIdentificacion', $numeroIdentificacion);
        $statement->execute();
    
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode($result);
        exit();
    }


    //Ruta http://localhost/proyectoFinal/api/mostrardatoscarnetparteinscripciones.php?numeroIdentificacion=1103739024
?>