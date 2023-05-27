<?php
// Obtener los datos del usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $numeroIdentificacion = $_POST['usuario'];
  $contrasena = $_POST['password'];

  // Conectar a la API de usuarios
  $url = 'http://localhost/proyectoFinal/api/usuarios.php';
  $data = file_get_contents($url);
  $usuarios = json_decode($data);

  // Verificar si se pudo obtener la lista de usuarios
  if ($usuarios !== null) {
      // Buscar el usuario en la lista de usuarios
      $encontrado = false;
      $tipousuario = '';

      foreach ($usuarios as $usuario) {
          if ($usuario->numeroIdentificacion == $numeroIdentificacion && $usuario->contrasena == $contrasena) {
              $encontrado = true;
              $tipousuario = $usuario->tipousuario;
              break;
          }
      }

      if ($encontrado) {
          // Iniciar sesión y redirigir a la página correspondiente según el tipo de usuario
          session_start();
          $_SESSION['numeroIdentificacion'] = $numeroIdentificacion;
          $_SESSION['tipousuario'] = $tipousuario;

          if ($tipousuario == 'b') {
              header("Location: bibliotecario.php");
              exit();
          } elseif ($tipousuario == 'a') {
              header("Location: administrador.php");
              exit();
          } elseif ($tipousuario == 'e') {
              header("Location: estudiante.php");
              exit();
          }
      } else {
          $errorMessage = "Usuario o contraseña incorrectos";
      }
  } else {
      $errorMessage = "Error al obtener la lista de usuarios";
  }
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">

    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <title>Inicio de sesion</title>
</head>
<body>
<section class="vh-100">
        <div class="container-fluid h-custom">
          <div class="row d-flex justify-content-center align-items-center h-100">
           
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
              <form method="POST" action="index.php">
                <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                  <p class="lead fw-normal mb-0 me-3">Inicio de sesion</p>
            
                </div>
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <label class="form-label" >Usuario</label>
                  <input type="text" id="usuario"  name="usuario" class="form-control form-control-lg"
                    placeholder="Usuario" required />
                  
                </div>
      
                <!-- Password input -->
                <div class="form-outline mb-3">
                    <label class="form-label"  >Contraseña</label>
                  <input type="password" id="password" name = "password" class="form-control form-control-lg"
                    placeholder="Contraseña" required/>

                    <!--Joa pri por si te la encuentras por ahi dile que me tiene mal *procede a ponerse sentimental*-->
                  
                </div>
                
      
                <div class="d-flex justify-content-between align-items-center">
                  <!-- Checkbox -->
                  <div class="form-check mb-0">
                    <button type="submit" class="btn btn-primary">Ingresar</button>

         
                  </div>
                
                </div>
      
              
      
              </form>
            </div>
          </div>
        </div>
                <!-- Copyright -->
          
          <!-- Copyright -->
      
          <!-- Right -->
         
      </section>
                <!-- Copyright -->
          
          <!-- Copyright -->
      
          <!-- Right -->
         
      </section>
      <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    
    
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
  
</body>
</html>




