<?php

// Obtener los datos del formulario
$tipoIdentificacion = $_POST['tipoIdentificacion'];
$numeroIdentificacion = $_POST['numeroIdentificacion'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$celular = $_POST['celular'];
$fechanacimiento = $_POST['fechanacimiento'];
$paisnacimiento = $_POST['paisnacimiento']; // Nuevo campo agregado
$foto = $_FILES['foto'];
$tipoSangre = $_POST['tipoSangre'];
$ciudad = $_POST['ciudad'];
$calle = $_POST['calle'];
$numero = $_POST['numero'];
$barrio = $_POST['barrio'];
$pais = $_POST['pais'];


// Crear arreglo con los datos a enviar a la API
$data = array(
    'tipo_identificacion' => $tipoIdentificacion,
    'numero_identificacion' => $numeroIdentificacion,
    'nombres' => $nombres,
    'apellidos' => $apellidos,
    'celular' => $celular,
    'fecha_nacimiento' => $fechanacimiento,
    'pais_nacimiento' => $paisnacimiento, // Nuevo campo agregado
    'tipo_sangre' => $tipoSangre,
    'ciudad' => $ciudad,
    'calle' => $calle,
    'numero' => $numero,
    'barrio' => $barrio,
    'pais' => $pais
);

// Enviar los datos a la API
// ...

// Convertir el array a formato JSON
$jsonData = json_encode($data);

// Endpoint de la API
$apiUrl = 'http://localhost/proyectoFinal/api/estudiantes.php';

// Configuración de la petición curl
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Enviar la petición
$response = curl_exec($ch);

// Cerrar la conexión curl
curl_close($ch);

// Mostrar la respuesta de la API
echo $response;

?>
?>
