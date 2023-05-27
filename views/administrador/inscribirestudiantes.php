<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <title>Gestion de Inscripcion</title>
</head>
<body>
    <h1>Inscripcion</h1>

    <div class="container">
        <form  method="POST" id="formulario">
          <div class="form-group" >
            <label for="descripcion">Descripción:</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
          </div>
          <div class="form-group">
            <label for="semestre">Semestre:</label>
            <select class="form-control" id="semestre" name="semestre" required>
            
            </select>
          </div>
          <div class="form-group">
            <label for="carrera">Carrera:</label>
            <select class="form-control" id="carrera" name="carrera" required>
             
            </select>
          </div>
          <div class="form-group">
            <label for="estudiante">Estudiante:</label>
            <input type="number" class="form-control" name="estudiante" id="estudiante" required>
          </div>

          <br>
          
          <button type="submit" class="btn btn-primary">Guardar</button>
          <button type="button" class="btn btn-danger">Cancelar</button>
        </form>
      </div>

      <script>
        $(document).ready(function() {
          // Obtener datos de la tabla semestres desde la API
          $.ajax({
            url: "http://localhost/proyectoFinal/api/semestres.php",
            dataType: "json",
            success: function(response) {
              // Agregar las opciones al select
              response.forEach(function(semestre) {
                $("#semestre").append("<option value='"+semestre.numero+"'>"+semestre.numero+"</option>");
              });
            },
            error: function(xhr, status, error) {
              console.log(xhr.responseText);
              // Handle error response
            }
          });
      
          // Obtener datos de la tabla carreras desde la API
          $.ajax({
            url: "http://localhost/proyectoFinal/api/carreras.php",
            dataType: "json",
            success: function(response) {
              // Agregar las opciones al select
              response.forEach(function(carrera) {
                $("#carrera").append("<option value='" + carrera.id + "'>" + carrera.titulo + "</option>");
              });
            },
            error: function(xhr, status, error) {
              console.log(xhr.responseText);
              // Handle error response
            }
          });
      
          // Registrar evento submit en el formulario
          $("#formulario").submit(function(event) {
            // Evitar la acción predeterminada del formulario
            event.preventDefault();
      
            // Recopilar los datos del formulario
            var descripcion = $("#descripcion").val();
            var fecha = new Date();

              var anio = fecha.getFullYear();
              var mes = fecha.getMonth() + 1; // Sumamos 1 porque los meses empiezan en 0
              if (mes < 10) {
                mes = "0" + mes;
              }
              var dia = fecha.getDate();
              if (dia < 10) {
                dia = "0" + dia;
              }

              var hora = fecha.getHours();
              if (hora < 10) {
                hora = "0" + hora;
              }
              var minutos = fecha.getMinutes();
              if (minutos < 10) {
                minutos = "0" + minutos;
              }
              var segundos = fecha.getSeconds();
              if (segundos < 10) {
                segundos = "0" + segundos;
              }

              var datetime = anio + "-" + mes + "-" + dia + "T" + hora + ":" + minutos + ":" + segundos;
              console.log(datetime); // Imprime la fecha y hora actual en formato datetime


            var semestreId = $("#semestre").val();     
            var carreraId = $("#carrera").val();
            var estudianteId = $("#estudiante").val();
      
            // Enviar los datos a través de una solicitud Ajax
            $.ajax({
                url: "http://localhost/proyectoFinal/api/inscripcion.php",
                method: "POST",
                dataType: "json",
                data: JSON.stringify({
                      descripcion: descripcion,
                      fecha: datetime,
                      Semestre_numero: semestreId,
                      Carrera_id: carreraId,
                      estudiantes_id: estudianteId
                }),
                success: function(response) {
                  // Handle success response
                  console.log(response);
                },
                error: function(xhr, status, error) {
                  var errorMessage = xhr.status + ': ' + xhr.statusText;
                  if (xhr.responseText) {
                    var responseError = JSON.parse(xhr.responseText).error;
                    errorMessage = responseError || errorMessage;
                  }
                  console.log("Error al registrar la inscripción: " + errorMessage);
                  $("#mensaje-error").text("Error al registrar la inscripción: " + errorMessage);
                }
              });
          });
        });
      </script>


<div class="container">
        <h2>Inscripciones</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>descripcion</th>
                    <th>fecha</th>
                    <th>Semestre</th>
                    <th>Carrera</th>
                    <th>Id estudiantes</th>
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
                    url: 'http://localhost/proyectoFinal/api/inscripcion.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var inscripciones = data;
                        var tableBody = $('#inscripcionesTableBody');
                        tableBody.empty();

                        // Recorrer cada inscripción y agregar una fila a la tabla
                        $.each(inscripciones, function(index, inscripcion) {
                            var row = '<tr>' +
                                '<td>' + inscripcion.id + '</td>' +
                                '<td>' + inscripcion.descripcion + '</td>' +
                                '<td>' + inscripcion.fecha + '</td>' +
                                '<td>' + inscripcion.Semestre_numero + '</td>' +
                                '<td>' + inscripcion.Carrera_id + '</td>' +
                                '<td>' + inscripcion.estudiantes_id + '</td>' +
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
                url: 'http://localhost/proyectoFinal/api/inscripcion.php?id=' + id,
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