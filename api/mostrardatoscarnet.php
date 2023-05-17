<?php
  include "../components/conexion.php";
    include "../settings/configuraciones.php";

    $dbConn = connect($db);
    if (isset($_GET['numeroIdentificacion'])) {
        $numeroIdentificacion = $_GET['numeroIdentificacion'];
    
        $sql = "SELECT e.*, d.* 
            FROM estudiantes e
            INNER JOIN direccionesestudiantes d ON e.id = d.estudiantes_id
            WHERE e.numeroIdentificacion = :numeroIdentificacion";
        
        $statement = $dbConn->prepare($sql);
        $statement->bindValue(':numeroIdentificacion', $numeroIdentificacion);
        $statement->execute();
    
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode($result);
        exit();
    }

    //la ruta 

    // http://localhost/proyectoFinal/api/mostrardatoscarnet.php?numeroIdentificacion=1103739024   
    
    




  





?>
