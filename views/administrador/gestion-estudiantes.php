<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">

    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Gestion de estudiantes</title>
</head>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
  </head>
  <body>
    <div class="container">

        <form method="POST" id="formEstudiantes" action="gestion-estudiantes.php" 
        enctype="multipart/form-data">
        
            <div class="form-group">
              <label for="tipoIdentificacion">Tipo de identificación:</label>
              <select class="form-control" id="tipoIdentificacion" name="tipoIdentificacion" required>
                  <option value="">Seleccione una opción</option>
                  <option value="CC">Cédula de ciudadanía</option>
                  <option value="TI">Tarjeta de identidad</option>
                  <option value="CE">Cédula de extranjería</option>
              </select>
    
         
          
            </div>
            <div class="form-group">
                <label for="numeroIdentificacion">Número de identificación:</label>
                <input type="text" class="form-control" id="numeroIdentificacion" name="numeroIdentificacion" required>
            </div>
            <div class="form-group">
                <label for="nombres">Nombres:</label>
                <input type="text" class="form-control" id="nombres" name="nombres" required>
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
            </div>
            <div class="form-group">
                <label for="celular">Celular:</label>
                <input type="text" class="form-control" id="celular" name="celular" required>
            </div>
            <div class="form-group">
                <label for="fechanacimiento">Fecha de nacimiento:</label>
                <input type="date" class="form-control" id="fechanacimiento" name="fechanacimiento" required>
            </div>
            <div class="form-group">
                <label for="tiposagre">Tipo de sangre:</label>
                <select class="form-control" id="tiposagre" name="tiposagre" required>
                    <option value="">Seleccione una opción</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                </select>
            </div>
            <div class="form-group">
              <label for="dapartamentoNacimiento">Departamento de nacimiento:</label>
              <input type="text" class="form-control" id="dapartamentoNacimiento" name="dapartamentoNacimiento" required>
          </div>
            <div class="form-group">
                <label for="ciudadnacimiento">Ciudad de nacimiento:</label>
                <input type="text" class="form-control" id="ciudadnacimiento" name="ciudadnacimiento" required>
            </div>
            <div class="form-group">
                <label for="paisnacimiento">País de nacimiento:</label>
                <input type="text" class="form-control" id="paisnacimiento" name="paisnacimiento" required>
            </div>
            <!-- //aqui esta la foto  --> 
            <div class="form-group"> 
                <label for="foto">Foto:</label>
                <input type="file" class="form-control-file" id="foto" name="foto">
            </div>
            <div class="form-group">
                <label for="correoelectronico">Correo electrónico:</label>
                <input type="email" class="form-control" id="correoelectronico" name="correoelectronico" required>
            </div>

            <h2>Direcciones</h2>
            <div class="form-group">
                <label for="pais">País:</label>
                <input type="text" class="form-control" id="pais" name="pais" required>
            </div>
            <div class="form-group">
            <label for="departamento">Departamento:</label>
            <input type="text" class="form-control" id="departamento" name="departamento" required>
            </div>

            <div class="form-group">
                <label for="ciudad">Ciudad:</label>
                <input type="text" class="form-control" id="ciudad" name="ciudad" required>
            </div>
            <div class="form-group">
              <label for="calle">Calle:</label>
              <input type="text" class="form-control" id="calle" name="calle" required>
          </div>
        
          <div class="form-group">
            <label for="numero">Numero:</label>
            <input type="text" class="form-control" id="numero" name="numero" required>
        </div>
        <div class="form-group">
          <label for="barrio">Barrio</label>
          <input type="text" class="form-control" id="barrio" name="barrio" required>
      </div>
      
                <input type="submit"  value="Guardar" class="btn btn-primary">
                <input type="button" onclick="limpiarFormulario()"  value="Cancelar" class="btn btn-danger">
                
              <input type="button" value="Crear Usuario Para Inicio Sesion" class="btn btn-secondary" onclick="irCrearUsuario()">

            
    </form>
  </body>
</html>

    <script>

        function limpiarFormulario() {
            document.getElementById("formEstudiantes").reset();
        }
    </script>

    <script>


        $(document).ready(function() {
        $("#formEstudiantes").submit(function(event) {
            event.preventDefault();

            // Set the API endpoint URL
            var api_url = 'http://localhost/proyectoFinal/api/estudiantes.php';

            // Set the request headers
            // var headers = {
            //     'Content-Type': 'application/json'
            // };
         
            // Set the request body
            
            var formData = new FormData();

            formData.append('tipoIdentificacion', $("#tipoIdentificacion").val());
            formData.append('numeroIdentificacion', $("#numeroIdentificacion").val());
            formData.append('nombres', $("#nombres").val());
            formData.append('apellidos', $("#apellidos").val());
            formData.append('celular', $("#celular").val());
            formData.append('fechanacimiento', $("#fechanacimiento").val());
            formData.append('tiposagre', $("#tiposagre").val());
            formData.append('ciudadnacimiento', $("#ciudadnacimiento").val());
            formData.append('departamentonacimiento', $("#dapartamentoNacimiento").val());
            formData.append('paisnacimiento', $("#paisnacimiento").val());
            formData.append('correoelectronico', $("#correoelectronico").val());

            formData.append('foto', $("#foto")[0].files[0]);

            formData.append('direccion[pais]', $("#pais").val());
            formData.append('direccion[departamento]', $("#departamento").val());
            formData.append('direccion[ciudad]', $("#ciudad").val());
            formData.append('direccion[calle]', $("#calle").val());
            formData.append('direccion[numero]', $("#numero").val());
            formData.append('direccion[barrio]', $("#barrio").val());

        // Make the AJAX request
        $.ajax({
            url: api_url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
                
                limpiarFormulario()

            },
            error: function(error) {
                console.error(error);
            }
            });
        });
        });

    </script>


    <script>
        function irCrearUsuario(){
            window.location.href = 'gestion-usuarios.php';
        }
    </script>

   <div class="container">
        <h2>Estudiantes</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>titulo</th>
                    <th>descripcion</th>
            
                </tr>
            </thead>
            <tbody id="inscripcionesTableBody">
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            // Cargar todas las inscripciones al cargar la página
            cargarInscripciones();

            function cargarInscripciones() {
                $.ajax({
                    url: 'http://localhost/proyectoFinal/api/estudiantes.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var estudiantes = data;
                        var tableBody = $('#inscripcionesTableBody');
                        tableBody.empty();

                        // Recorrer cada inscripción y agregar una fila a la tabla
                        $.each(estudiantes, function(index, estudiantes) {
                            var row = '<tr>' +
                                '<td>' + estudiantes.id + '</td>' +
                                '<td>' + estudiantes.numeroIdentificacion + '</td>' +
                                '<td>' + estudiantes.nombres + '</td>' +
                                '<td>' + estudiantes.apellidos + '</td>' +
                                '<td>' + estudiantes.celular + '</td>' +
                                '<td>' + estudiantes.fechanacimiento + '</td>' +
                                '<td>' + estudiantes.tiposagre + '</td>' +
                                '<td>' + estudiantes.paisnacimiento + '</td>' +
                                
                                '<td><button class="btn btn-danger btn-sm" onclick="borrarInscripcion(' + inscripcion.id + ')">Borrar</button></td>' +

                                '</tr>';
                            tableBody.append(row);
                        });
                    }
                });
            }

        
        

        });
        
    </script>
     <script>
        function borrarInscripcion(id) {
            if (confirm("¿Estás seguro de que deseas borrar esta inscripción?")) {
                $.ajax({
                    url: 'http://localhost/proyectoFinal/api/carreras.php?id=' + id,
                    type: 'DELETE',
                    success: function(response) {
                        alert(response.message);
                        cargarInscripciones(); // Actualizar la tabla de inscripciones
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error al borrar la inscripción');
                    }
                });
            }
        }

    </script>






      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>