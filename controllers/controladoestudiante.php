
<?php


// Check if the form was submitted
if (!empty($_POST)) {


  // Set the API endpoint URL
  $api_url = 'http://localhost/proyectoFinal/api/estudiantes.php';

  // Set the request headers
  $headers = array(
    'Content-Type: application/json',
  );

  // Set the request body
  $body = json_encode([
    'tipoIdentificacion' => $_POST['tipoIdentificacion'],
    'numeroIdentificacion' => $_POST['numeroIdentificacion'],
    'nombres' => $_POST['nombres'],
    'apellidos' => $_POST['apellidos'],
    'celular' => $_POST['celular'],
    'fechanacimiento' => $_POST['fechanacimiento'],
    'tiposagre' => $_POST['tiposagre'],
    'ciudadnacimiento' => $_POST['ciudadnacimiento'],
    'paisnacimiento' => $_POST['paisnacimiento'],
    'correoelectronico' => $_POST['correoelectronico'],
    'foto' => $_POST['foto'],
    'direccion' => [
        'pais' => $_POST['pais'],
        'ciudad' => $_POST['ciudad'],
        'calle' => $_POST['calle'],
        'numero' => $_POST['numero'],
        'barrio' => $_POST['barrio']
    ]
  ]);


  // Initialize the cURL session
  $curl = curl_init();

  // Set the cURL options
  curl_setopt_array($curl, array(
    CURLOPT_URL => $api_url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $body,
    CURLOPT_HTTPHEADER => $headers,
  ));

  // Execute the cURL request
  $response = curl_exec($curl);

  // Close the cURL session
  curl_close($curl);

  // Output the API response
  echo $response;
}
?>

