
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">

    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Gestion de semestres</title>
</head>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
  </head>
  <body>
    <div class="container">
        <form  method="POST">
        
          <div class="form-group">
            <label for="numero">Numero del semestre </label>
            <input type="number" class="form-control" id="numero" name="numero" required>
          </div>
          
          <div class="d-grid gap-2">
            <input type="submit" value="Guardar" class="btn btn-primary">
            <input type="button" value="Eliminar" class="btn btn-danger">
            </div>
        </form>
      </div>
      
           

  </body>
</html>
      <script>

        $(document).ready(function() {
          $('form').submit(function(event) {
            // Evita que se envíe el formulario de manera convencional
            event.preventDefault();
            
            // Obtiene los datos del formulario
            var formData = {
              'numero': $('input[name=numero]').val()
            };
            
            // Envía los datos del formulario a la API a través de AJAX
            $.ajax({
              type: 'POST',
              url: 'http://localhost/proyectoFinal/api/semestres.php',
              data: formData,
              dataType: 'json',
              encode: true
            })
            .done(function(data) {
              console.log(data);
              alert('Semestre guardado exitosamente.');
            })
            .fail(function(data) {
              console.log(data);
              alert('Error al guardar el semestre.');
            });
          });
        });

      </script>
<div class="container">
        <h2>listado semestres </h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Numero</th>
                
            
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
                    url: 'http://localhost/proyectoFinal/api/semestres.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var semestres = data;
                        var tableBody = $('#inscripcionesTableBody');
                        tableBody.empty();

                        // Recorrer cada inscripción y agregar una fila a la tabla
                        $.each(semestres, function(index, semestres) {
                            var row = '<tr>' +
                                '<td>' + semestres.numero + '</td>' +
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

