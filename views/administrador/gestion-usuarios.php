<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">

    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <title>Gestion de usuarios</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
  <div class="container mt-5">
    <h1>Rellenar tabla usuarios</h1>
    <form method="post" id="formUsuarios">
        <div class="mb-3">
            <label for="numeroIdentificacion" class="form-label">Usuario </label>
            <input type="number" class="form-control" id="numeroIdentificacion" name="numeroIdentificacion" required>
        </div>
        <div class="mb-3">
            <label for="contrasena" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="contrasena" name="contrasena" required>
        </div>
        <div class="mb-3">
            <label for="tipousuario" class="form-label">Tipo de Usuario</label>
            <select class="form-select" id="tipousuario" name="tipousuario" required>
                <option value="">Seleccione una opción</option>
                <option value="b">Bibliotecario</option>
                <option value="a">Administrador</option>
                <option value="e">Estudiante</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" id="btnCrearTabla">Crear tabla</button>
        <button type="button" class="btn btn-danger" id="btnLimpiar">Limpiar</button>
    </form>
</div>




    
    <script>
        function limpiarCampos() {
          document.getElementById("numeroIdentificacion").value = "";
          document.getElementById("contrasena").value = "";
          document.getElementById("tipousuario").selectedIndex = 0;
        }
      
        document.getElementById("btnLimpiar").addEventListener("click", limpiarCampos);



      </script>

      <script>
        
        $(document).ready(function() {
                $('#formUsuarios').submit(function(event) {
                // Prevenir el comportamiento predeterminado del formulario
                event.preventDefault();

                // Obtener los datos del formulario
                var numeroIdentificacion = $('#numeroIdentificacion').val();
                var contrasena = $('#contrasena').val();
                var tipousuario = $('#tipousuario').val();

                // Enviar los datos a la API con AJAX
                $.ajax({
                url: 'http://localhost/proyectoFinal/api/usuarios.php',
                type: 'POST',
                data: {
                    numeroIdentificacion: numeroIdentificacion,
                    contrasena: contrasena,
                    tipousuario: tipousuario
                },
                success: function(response) {
                    // Si la petición fue exitosa, mostrar un mensaje de éxito
                    alert(response.message);
                
                    limpiarCampos()
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Si la petición falló, mostrar un mensaje de error
                    alert('Error al guardar los datos en la base de datos');
                }
                });
            });
            });
            

      </script>

<div class="container">
        <h2>Carreras Disponibles </h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Tipo Usuario</th>
            
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
                    url: 'http://localhost/proyectoFinal/api/usuarios.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var usuarios = data;
                        var tableBody = $('#inscripcionesTableBody');
                        tableBody.empty();

                        // Recorrer cada inscripción y agregar una fila a la tabla
                        $.each(usuarios, function(index, usuarios) {
                            var row = '<tr>' +
                                '<td>' + usuarios.numeroIdentificacion + '</td>' +
                                '<td>' + btoa(usuarios.contrasena) + '</td>' +  
                               

                                '<td>' + usuarios.tipousuario + '</td>' +                               

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