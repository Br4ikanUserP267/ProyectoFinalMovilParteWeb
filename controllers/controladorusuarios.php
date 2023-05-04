<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Procesar los datos recibidos desde el cliente
  $numeroIdentificacion = $_POST['numeroIdentificacion'];
  $contrasena = $_POST['contrasena'];
  $tipousuario = $_POST['tipousuario'];

  // Llamar a la API para almacenar los datos en la base de datos
  $api_url = 'http://localhost/proyectoFinal/api/usuarios.php';
  $data = array(
    'numeroIdentificacion' => $numeroIdentificacion,
    'contrasena' => $contrasena,
    'tipousuario' => $tipousuario
  );

  $options = array(
    'http' => array(
      'method'  => 'POST',
      'header'  => 'Content-Type: application/x-www-form-urlencoded',
      'content' => http_build_query($data)
    )
  );

  
  $context  = stream_context_create($options);
  $result = file_get_contents($api_url, false, $context);
  if ($result === FALSE) {
    // Si hubo un error al llamar a la API, mostrar un mensaje de error
    echo json_encode(['message' => 'Error al guardar los datos en la base de datos']);
  } else {
    // Si todo salió bien, mostrar un mensaje de éxito
    echo json_encode(['message' => 'Datos guardados exitosamente']);
  }
} else {
  // Si la petición no es POST, retornar un error 405 Method Not Allowed
  http_response_code(405);
  echo json_encode(['message' => 'Método no permitido']);
}






?>
